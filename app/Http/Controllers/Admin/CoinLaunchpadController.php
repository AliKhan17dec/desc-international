<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Coin;
use App\Models\CoinLaunchpad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CoinLaunchpadController extends Controller
{
    public function index()
    {
        $launchpads = CoinLaunchpad::with(['coin', 'category'])
            ->latest()
            ->paginate(20);

        return view('admin.pages.coin_launchpads.index', compact('launchpads'));
    }

    public function create()
    {
        $coins = Coin::query()->orderBy('id', 'desc')->get();
        $categories = Category::query()->orderBy('name')->get();

        $launchpad = new CoinLaunchpad([
            'status' => 'live',
            'phase_steps' => [
                ['step_name' => 'Curating', 'done' => false],
                ['step_name' => 'Fundraising', 'done' => false],
                ['step_name' => 'Bonding Curve', 'done' => false],
                ['step_name' => 'AMM', 'done' => false],
            ],
            'highlight_stats' => [],
        ]);

        return view('admin.pages.coin_launchpads.create', compact('coins', 'categories', 'launchpad'));
    }

    public function store(Request $request)
    {
        $data = $this->validatePayload($request);

        DB::transaction(function () use ($data) {
            // If slug not provided, generate from coin name/symbol
            if (empty($data['slug'])) {
                $coin = Coin::find($data['coin_id']);
                $base = $coin?->name ?? $coin?->symbol ?? ('coin-'.$data['coin_id']);
                $data['slug'] = Str::slug($base);
            }

            // Ensure unique slug
            $data['slug'] = $this->ensureUniqueSlug($data['slug']);

            $launchpad = CoinLaunchpad::create([
                'coin_id' => $data['coin_id'],
                'category_id' => $data['category_id'] ?? null,
                'slug' => $data['slug'],
                'status' => $data['status'],
                'summary_text' => $data['summary_text'] ?? null,
                'phase_steps' => $this->normalizePhaseSteps($data['phase_steps'] ?? []),
                'highlight_stats' => $this->normalizeHighlightStats($data['highlight_stats'] ?? []),
                'value_capture_text' => $data['value_capture_text'] ?? null,
            ]);

            // Related repeaters (simple: delete/recreate pattern not needed on create)
            $launchpad->blocks()->createMany($this->normalizeBlocks($data['blocks'] ?? []));
            $launchpad->teamMembers()->createMany($this->normalizeTeam($data['team_members'] ?? []));
            $launchpad->externalLinks()->createMany($this->normalizeLinks($data['external_links'] ?? []));
        });

        return redirect()->route('admin.coin-launchpads.index')
            ->with('success', 'Launchpad created successfully.');
    }

    public function edit(CoinLaunchpad $coin_launchpad)
    {
        $launchpad = $coin_launchpad->load(['coin', 'category', 'blocks', 'teamMembers', 'externalLinks']);
        $coins = Coin::query()->orderBy('id', 'desc')->get();
        $categories = Category::query()->orderBy('name')->get();

        return view('admin.pages.coin_launchpads.edit', compact('launchpad', 'coins', 'categories'));
    }

    public function update(Request $request, CoinLaunchpad $coin_launchpad)
    {
        $data = $this->validatePayload($request, $coin_launchpad->id);

        DB::transaction(function () use ($coin_launchpad, $data) {
            $slug = $data['slug'] ?? $coin_launchpad->slug;
            $slug = $this->ensureUniqueSlug($slug, $coin_launchpad->id);

            $coin_launchpad->update([
                'coin_id' => $data['coin_id'],
                'category_id' => $data['category_id'] ?? null,
                'slug' => $slug,
                'status' => $data['status'],
                'summary_text' => $data['summary_text'] ?? null,
                'phase_steps' => $this->normalizePhaseSteps($data['phase_steps'] ?? []),
                'highlight_stats' => $this->normalizeHighlightStats($data['highlight_stats'] ?? []),
                'value_capture_text' => $data['value_capture_text'] ?? null,
            ]);

            // Re-sync related tables (simple & reliable)
            $coin_launchpad->blocks()->delete();
            $coin_launchpad->teamMembers()->delete();
            $coin_launchpad->externalLinks()->delete();

            $coin_launchpad->blocks()->createMany($this->normalizeBlocks($data['blocks'] ?? []));
            $coin_launchpad->teamMembers()->createMany($this->normalizeTeam($data['team_members'] ?? []));
            $coin_launchpad->externalLinks()->createMany($this->normalizeLinks($data['external_links'] ?? []));
        });

        return redirect()->route('admin.coin-launchpads.edit', $coin_launchpad->id)
            ->with('success', 'Launchpad updated successfully.');
    }

    public function destroy(CoinLaunchpad $coin_launchpad)
    {
        $coin_launchpad->delete();

        return redirect()->route('admin.coin-launchpads.index')
            ->with('success', 'Launchpad deleted.');
    }

    private function validatePayload(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'coin_id' => ['required', 'integer', 'exists:coins,id'],
            'category_id' => ['nullable', 'integer', 'exists:categories,id'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:coin_launchpads,slug'.($ignoreId ? ','.$ignoreId : '')],
            'status' => ['required', 'in:live,upcoming'],
            'summary_text' => ['nullable', 'string'],
            'value_capture_text' => ['nullable', 'string'],

            'phase_steps' => ['nullable', 'array'],
            'phase_steps.*.step_name' => ['nullable', 'string', 'max:120'],
            'phase_steps.*.done' => ['nullable'],

            'highlight_stats' => ['nullable', 'array'],
            'highlight_stats.*.label' => ['nullable', 'string', 'max:120'],
            'highlight_stats.*.value' => ['nullable', 'string', 'max:200'],

            'blocks' => ['nullable', 'array'],
            'blocks.*.type' => ['nullable', 'in:research_focus,recommended_read,value_model,custom'],
            'blocks.*.title' => ['nullable', 'string', 'max:255'],
            'blocks.*.body_text' => ['nullable', 'string'],
            'blocks.*.image_path' => ['nullable', 'string', 'max:2048'],
            'blocks.*.external_link' => ['nullable', 'string', 'max:2048'],

            'team_members' => ['nullable', 'array'],
            'team_members.*.name' => ['nullable', 'string', 'max:255'],
            'team_members.*.role' => ['nullable', 'string', 'max:255'],
            'team_members.*.external_url' => ['nullable', 'string', 'max:2048'],

            'external_links' => ['nullable', 'array'],
            'external_links.*.label' => ['nullable', 'string', 'max:255'],
            'external_links.*.url' => ['nullable', 'string', 'max:2048'],
        ]);
    }

    private function normalizePhaseSteps(array $rows): array
    {
        return collect($rows)
            ->filter(fn ($r) => ! blank($r['step_name'] ?? null))
            ->map(fn ($r) => [
                'step_name' => trim($r['step_name']),
                'done' => (bool) ($r['done'] ?? false),
            ])
            ->values()
            ->all();
    }

    private function normalizeHighlightStats(array $rows): array
    {
        return collect($rows)
            ->filter(fn ($r) => ! blank($r['label'] ?? null) || ! blank($r['value'] ?? null))
            ->map(fn ($r) => [
                'label' => trim((string) ($r['label'] ?? '')),
                'value' => trim((string) ($r['value'] ?? '')),
            ])
            ->values()
            ->all();
    }

    private function normalizeBlocks(array $rows): array
    {
        return collect($rows)
            ->filter(fn ($r) => ! blank($r['title'] ?? null) || ! blank($r['body_text'] ?? null))
            ->values()
            ->map(function ($r, $i) {
                return [
                    'sort_order' => $i,
                    'type' => $r['type'] ?? 'custom',
                    'title' => $r['title'] ?? null,
                    'body_text' => $r['body_text'] ?? null,
                    'image_path' => $r['image_path'] ?? null,
                    'external_link' => $r['external_link'] ?? null,
                ];
            })
            ->all();
    }

    private function normalizeTeam(array $rows): array
    {
        return collect($rows)
            ->filter(fn ($r) => ! blank($r['name'] ?? null))
            ->values()
            ->map(function ($r, $i) {
                return [
                    'sort_order' => $i,
                    'name' => $r['name'],
                    'role' => $r['role'] ?? null,
                    'external_url' => $r['external_url'] ?? null,
                ];
            })
            ->all();
    }

    private function normalizeLinks(array $rows): array
    {
        return collect($rows)
            ->filter(fn ($r) => ! blank($r['label'] ?? null) || ! blank($r['url'] ?? null))
            ->values()
            ->map(function ($r, $i) {
                return [
                    'sort_order' => $i,
                    'label' => $r['label'] ?? null,
                    'url' => $r['url'] ?? null,
                ];
            })
            ->all();
    }

    private function ensureUniqueSlug(string $slug, ?int $ignoreId = null): string
    {
        $base = Str::slug($slug);
        $candidate = $base;
        $i = 2;

        while (
            CoinLaunchpad::where('slug', $candidate)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $candidate = $base.'-'.$i;
            $i++;
        }

        return $candidate;
    }
}
