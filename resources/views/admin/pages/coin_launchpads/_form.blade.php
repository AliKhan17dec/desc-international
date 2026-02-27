@php
    // normalize variables for create/edit
    $lp = $launchpad ?? $launchpad ?? null;
@endphp

@if ($errors->any())
    <div class="mb-4 p-3 rounded bg-red-600/20 border border-red-600 text-red-200">
        <div class="font-semibold mb-2">Please fix the errors:</div>
        <ul class="list-disc ml-5">
            @foreach ($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Basic --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">

    <div class="mb-2">
        <label class="block mb-1 text-sm font-medium text-white">Coin</label>
        <select name="coin_id" required
            class="w-full p-2.5 rounded-lg bg-zinc-800 border border-gray-600 text-white focus:ring-crypto-primary focus:border-crypto-primary">
            <option disabled {{ old('coin_id', $launchpad->coin_id ?? '') ? '' : 'selected' }}>Choose coin</option>
            @foreach ($coins as $coin)
                <option value="{{ $coin->id }}" @selected(old('coin_id', $launchpad->coin_id ?? '') == $coin->id)>
                    {{ $coin->name ?? $coin->symbol ?? ('Coin #' . $coin->id) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-2">
        <label class="block mb-1 text-sm font-medium text-white">Category</label>
        <select name="category_id"
            class="w-full p-2.5 rounded-lg bg-zinc-800 border border-gray-600 text-white focus:ring-crypto-primary focus:border-crypto-primary">
            <option value="">— None —</option>
            @foreach ($categories as $cat)
                <option value="{{ $cat->id }}" @selected(old('category_id', $launchpad->category_id ?? '') == $cat->id)>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-2">
        <label class="block mb-1 text-sm font-medium text-white">Slug</label>
        <input name="slug" value="{{ old('slug', $launchpad->slug ?? '') }}" placeholder="hairdao"
            class="w-full p-2.5 rounded-lg bg-zinc-800 border border-gray-600 text-white focus:ring-crypto-primary focus:border-crypto-primary" />
        <p class="text-xs text-gray-400 mt-1">Used for public URL: /launchpad/{slug}</p>
    </div>

    <div class="mb-2">
        <label class="block mb-1 text-sm font-medium text-white">Status</label>
        <select name="status" required
            class="w-full p-2.5 rounded-lg bg-zinc-800 border border-gray-600 text-white focus:ring-crypto-primary focus:border-crypto-primary">
            <option value="live" @selected(old('status', $launchpad->status ?? 'live') === 'live')>Live</option>
            <option value="upcoming" @selected(old('status', $launchpad->status ?? 'live') === 'upcoming')>Upcoming
            </option>
        </select>
    </div>
</div>

<div class="mt-4 mb-4">
    <label class="block mb-1 text-sm font-medium text-white">Summary Text (Hero)</label>
    <textarea name="summary_text" rows="4"
        class="w-full p-2.5 rounded-lg bg-zinc-800 border border-gray-600 text-white focus:ring-crypto-primary focus:border-crypto-primary">{{ old('summary_text', $launchpad->summary_text ?? '') }}</textarea>
</div>

<div class="mb-6">
    <label class="block mb-1 text-sm font-medium text-white">Value Capture Text (Markdown)</label>
    <textarea name="value_capture_text" rows="5"
        class="w-full p-2.5 rounded-lg bg-zinc-800 border border-gray-600 text-white focus:ring-crypto-primary focus:border-crypto-primary">{{ old('value_capture_text', $launchpad->value_capture_text ?? '') }}</textarea>
</div>

<hr class="border-zinc-700/60 my-6">

{{-- Phase Steps --}}
<div class="flex items-center justify-between mb-3">
    <h3 class="text-lg font-semibold text-crypto-primary">Phase Steps</h3>
    <button type="button" onclick="addRepeaterRow('phaseStepsBody', 'phaseStepTpl')"
        class="px-3 py-2 rounded bg-zinc-800 border border-zinc-600 hover:border-crypto-primary transition">
        + Add Step
    </button>
</div>

<div class="overflow-x-auto mb-6">
    <table class="w-full text-sm">
        <thead class="bg-zinc-900/60 text-gray-300">
            <tr>
                <th class="px-3 py-2 text-left">Step Name</th>
                <th class="px-3 py-2 text-left">Done</th>
                <th class="px-3 py-2 text-right">Remove</th>
            </tr>
        </thead>
        <tbody id="phaseStepsBody" class="divide-y divide-zinc-700/50">
            @php $phase = old('phase_steps', $launchpad->phase_steps ?? []); @endphp
            @forelse($phase as $i => $row)
                <tr class="align-top">
                    <td class="px-3 py-2">
                        <input name="phase_steps[{{ $i }}][step_name]" value="{{ $row['step_name'] ?? '' }}"
                            class="w-full p-2 rounded bg-zinc-800 border border-gray-600 text-white" />
                    </td>
                    <td class="px-3 py-2">
                        <input type="hidden" name="phase_steps[{{ $i }}][done]" value="0">
                        <input type="checkbox" name="phase_steps[{{ $i }}][done]" value="1"
                            class="w-4 h-4 rounded bg-zinc-800 border-gray-600" @checked(!empty($row['done'])) />
                    </td>
                    <td class="px-3 py-2 text-right">
                        <button type="button" onclick="removeRow(this)"
                            class="px-3 py-1 rounded bg-red-600/20 border border-red-600 text-red-200">
                            X
                        </button>
                    </td>
                </tr>
            @empty
                <tr class="align-top">
                    <td class="px-3 py-2">
                        <input name="phase_steps[0][step_name]" value=""
                            class="w-full p-2 rounded bg-zinc-800 border border-gray-600 text-white" />
                    </td>
                    <td class="px-3 py-2">
                        <input type="hidden" name="phase_steps[0][done]" value="0">
                        <input type="checkbox" name="phase_steps[0][done]" value="1"
                            class="w-4 h-4 rounded bg-zinc-800 border-gray-600" />
                    </td>
                    <td class="px-3 py-2 text-right">
                        <button type="button" onclick="removeRow(this)"
                            class="px-3 py-1 rounded bg-red-600/20 border border-red-600 text-red-200">
                            X
                        </button>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<template id="phaseStepTpl">
    <tr class="align-top">
        <td class="px-3 py-2">
            <input name="phase_steps[__INDEX__][step_name]" value=""
                class="w-full p-2 rounded bg-zinc-800 border border-gray-600 text-white" />
        </td>
        <td class="px-3 py-2">
            <input type="hidden" name="phase_steps[__INDEX__][done]" value="0">
            <input type="checkbox" name="phase_steps[__INDEX__][done]" value="1"
                class="w-4 h-4 rounded bg-zinc-800 border-gray-600" />
        </td>
        <td class="px-3 py-2 text-right">
            <button type="button" onclick="removeRow(this)"
                class="px-3 py-1 rounded bg-red-600/20 border border-red-600 text-red-200">
                X
            </button>
        </td>
    </tr>
</template>

<hr class="border-zinc-700/60 my-6">

{{-- Highlight Stats --}}
<div class="flex items-center justify-between mb-3">
    <h3 class="text-lg font-semibold text-crypto-primary">Highlight Stats</h3>
    <button type="button" onclick="addRepeaterRow('statsBody', 'statTpl')"
        class="px-3 py-2 rounded bg-zinc-800 border border-zinc-600 hover:border-crypto-primary transition">
        + Add Stat
    </button>
</div>

<div class="overflow-x-auto mb-6">
    <table class="w-full text-sm">
        <thead class="bg-zinc-900/60 text-gray-300">
            <tr>
                <th class="px-3 py-2 text-left">Label</th>
                <th class="px-3 py-2 text-left">Value</th>
                <th class="px-3 py-2 text-right">Remove</th>
            </tr>
        </thead>
        <tbody id="statsBody" class="divide-y divide-zinc-700/50">
            @php $stats = old('highlight_stats', $launchpad->highlight_stats ?? []); @endphp
            @forelse($stats as $i => $row)
                <tr class="align-top">
                    <td class="px-3 py-2">
                        <input name="highlight_stats[{{ $i }}][label]" value="{{ $row['label'] ?? '' }}"
                            class="w-full p-2 rounded bg-zinc-800 border border-gray-600 text-white" />
                    </td>
                    <td class="px-3 py-2">
                        <input name="highlight_stats[{{ $i }}][value]" value="{{ $row['value'] ?? '' }}"
                            class="w-full p-2 rounded bg-zinc-800 border border-gray-600 text-white" />
                    </td>
                    <td class="px-3 py-2 text-right">
                        <button type="button" onclick="removeRow(this)"
                            class="px-3 py-1 rounded bg-red-600/20 border border-red-600 text-red-200">
                            X
                        </button>
                    </td>
                </tr>
            @empty
                <tr class="align-top">
                    <td class="px-3 py-2">
                        <input name="highlight_stats[0][label]" value=""
                            class="w-full p-2 rounded bg-zinc-800 border border-gray-600 text-white" />
                    </td>
                    <td class="px-3 py-2">
                        <input name="highlight_stats[0][value]" value=""
                            class="w-full p-2 rounded bg-zinc-800 border border-gray-600 text-white" />
                    </td>
                    <td class="px-3 py-2 text-right">
                        <button type="button" onclick="removeRow(this)"
                            class="px-3 py-1 rounded bg-red-600/20 border border-red-600 text-red-200">
                            X
                        </button>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<template id="statTpl">
    <tr class="align-top">
        <td class="px-3 py-2">
            <input name="highlight_stats[__INDEX__][label]" value=""
                class="w-full p-2 rounded bg-zinc-800 border border-gray-600 text-white" />
        </td>
        <td class="px-3 py-2">
            <input name="highlight_stats[__INDEX__][value]" value=""
                class="w-full p-2 rounded bg-zinc-800 border border-gray-600 text-white" />
        </td>
        <td class="px-3 py-2 text-right">
            <button type="button" onclick="removeRow(this)"
                class="px-3 py-1 rounded bg-red-600/20 border border-red-600 text-red-200">
                X
            </button>
        </td>
    </tr>
</template>

<hr class="border-zinc-700/60 my-6">

{{-- Blocks --}}
<div class="flex items-center justify-between mb-3">
    <h3 class="text-lg font-semibold text-crypto-primary">Content Blocks</h3>
    <button type="button" onclick="addRepeaterRow('blocksBody', 'blockTpl')"
        class="px-3 py-2 rounded bg-zinc-800 border border-zinc-600 hover:border-crypto-primary transition">
        + Add Block
    </button>
</div>

<div class="space-y-3 mb-6" id="blocksBody">
    @php
        $blocks = old('blocks', isset($launchpad) ? $launchpad->blocks->map(fn($b) => $b->toArray())->toArray() : []);
    @endphp

    @forelse($blocks as $i => $row)
        <div class="p-3 rounded border border-zinc-700 bg-zinc-900/40">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <div>
                    <label class="block mb-1 text-xs text-gray-300">Type</label>
                    <select name="blocks[{{ $i }}][type]"
                        class="w-full p-2 rounded bg-zinc-800 border border-gray-600 text-white">
                        @foreach(['research_focus' => 'Research Focus', 'recommended_read' => 'Recommended Read', 'value_model' => 'Value Model', 'custom' => 'Custom'] as $val => $label)
                            <option value="{{ $val }}" @selected(($row['type'] ?? 'custom') === $val)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block mb-1 text-xs text-gray-300">Title</label>
                    <input name="blocks[{{ $i }}][title]" value="{{ $row['title'] ?? '' }}"
                        class="w-full p-2 rounded bg-zinc-800 border border-gray-600 text-white" />
                </div>

                <div class="md:col-span-2">
                    <label class="block mb-1 text-xs text-gray-300">Body Text (Markdown)</label>
                    <textarea name="blocks[{{ $i }}][body_text]" rows="3"
                        class="w-full p-2 rounded bg-zinc-800 border border-gray-600 text-white">{{ $row['body_text'] ?? '' }}</textarea>
                </div>

                <div>
                    <label class="block mb-1 text-xs text-gray-300">Image Path/URL</label>
                    <input name="blocks[{{ $i }}][image_path]" value="{{ $row['image_path'] ?? '' }}"
                        class="w-full p-2 rounded bg-zinc-800 border border-gray-600 text-white" />
                </div>

                <div>
                    <label class="block mb-1 text-xs text-gray-300">External Link</label>
                    <input name="blocks[{{ $i }}][external_link]" value="{{ $row['external_link'] ?? '' }}"
                        class="w-full p-2 rounded bg-zinc-800 border border-gray-600 text-white" />
                </div>
            </div>

            <div class="text-right mt-3">
                <button type="button" onclick="removeBlock(this)"
                    class="px-3 py-1 rounded bg-red-600/20 border border-red-600 text-red-200">
                    Remove Block
                </button>
            </div>
        </div>
    @empty
        <div class="p-3 rounded border border-zinc-700 bg-zinc-900/40">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <div>
                    <label class="block mb-1 text-xs text-gray-300">Type</label>
                    <select name="blocks[0][type]" class="w-full p-2 rounded bg-zinc-800 border border-gray-600 text-white">
                        <option value="research_focus">Research Focus</option>
                        <option value="recommended_read">Recommended Read</option>
                        <option value="value_model">Value Model</option>
                        <option value="custom" selected>Custom</option>
                    </select>
                </div>
                <div>
                    <label class="block mb-1 text-xs text-gray-300">Title</label>
                    <input name="blocks[0][title]" value=""
                        class="w-full p-2 rounded bg-zinc-800 border border-gray-600 text-white" />
                </div>
                <div class="md:col-span-2">
                    <label class="block mb-1 text-xs text-gray-300">Body Text (Markdown)</label>
                    <textarea name="blocks[0][body_text]" rows="3"
                        class="w-full p-2 rounded bg-zinc-800 border border-gray-600 text-white"></textarea>
                </div>
                <div>
                    <label class="block mb-1 text-xs text-gray-300">Image Path/URL</label>
                    <input name="blocks[0][image_path]" value=""
                        class="w-full p-2 rounded bg-zinc-800 border border-gray-600 text-white" />
                </div>
                <div>
                    <label class="block mb-1 text-xs text-gray-300">External Link</label>
                    <input name="blocks[0][external_link]" value=""
                        class="w-full p-2 rounded bg-zinc-800 border border-gray-600 text-white" />
                </div>
            </div>
        </div>
    @endforelse
</div>

<template id="blockTpl">
    <div class="p-3 rounded border border-zinc-700 bg-zinc-900/40">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            <div>
                <label class="block mb-1 text-xs text-gray-300">Type</label>
                <select name="blocks[__INDEX__][type]"
                    class="w-full p-2 rounded bg-zinc-800 border border-gray-600 text-white">
                    <option value="research_focus">Research Focus</option>
                    <option value="recommended_read">Recommended Read</option>
                    <option value="value_model">Value Model</option>
                    <option value="custom" selected>Custom</option>
                </select>
            </div>
            <div>
                <label class="block mb-1 text-xs text-gray-300">Title</label>
                <input name="blocks[__INDEX__][title]" value=""
                    class="w-full p-2 rounded bg-zinc-800 border border-gray-600 text-white" />
            </div>

            <div class="md:col-span-2">
                <label class="block mb-1 text-xs text-gray-300">Body Text (Markdown)</label>
                <textarea name="blocks[__INDEX__][body_text]" rows="3"
                    class="w-full p-2 rounded bg-zinc-800 border border-gray-600 text-white"></textarea>
            </div>

            <div>
                <label class="block mb-1 text-xs text-gray-300">Image Path/URL</label>
                <input name="blocks[__INDEX__][image_path]" value=""
                    class="w-full p-2 rounded bg-zinc-800 border border-gray-600 text-white" />
            </div>

            <div>
                <label class="block mb-1 text-xs text-gray-300">External Link</label>
                <input name="blocks[__INDEX__][external_link]" value=""
                    class="w-full p-2 rounded bg-zinc-800 border border-gray-600 text-white" />
            </div>
        </div>

        <div class="text-right mt-3">
            <button type="button" onclick="removeBlock(this)"
                class="px-3 py-1 rounded bg-red-600/20 border border-red-600 text-red-200">
                Remove Block
            </button>
        </div>
    </div>
</template>

<hr class="border-zinc-700/60 my-6">

{{-- Team --}}
<div class="flex items-center justify-between mb-3">
    <h3 class="text-lg font-semibold text-crypto-primary">Team Members</h3>
    <button type="button" onclick="addRepeaterRow('teamBody', 'teamTpl')"
        class="px-3 py-2 rounded bg-zinc-800 border border-zinc-600 hover:border-crypto-primary transition">
        + Add Member
    </button>
</div>

<div class="overflow-x-auto mb-6">
    <table class="w-full text-sm">
        <thead class="bg-zinc-900/60 text-gray-300">
            <tr>
                <th class="px-3 py-2 text-left">Name</th>
                <th class="px-3 py-2 text-left">Role</th>
                <th class="px-3 py-2 text-left">External URL</th>
                <th class="px-3 py-2 text-right">Remove</th>
            </tr>
        </thead>
        <tbody id="teamBody" class="divide-y divide-zinc-700/50">
            @php
                $team = old('team_members', isset($launchpad) ? $launchpad->teamMembers->map(fn($m) => $m->toArray())->toArray() : []);
            @endphp

            @forelse($team as $i => $row)
                <tr class="align-top">
                    <td class="px-3 py-2">
                        <input name="team_members[{{ $i }}][name]" value="{{ $row['name'] ?? '' }}"
                            class="w-full p-2 rounded bg-zinc-800 border border-gray-600 text-white" />
                    </td>
                    <td class="px-3 py-2">
                        <input name="team_members[{{ $i }}][role]" value="{{ $row['role'] ?? '' }}"
                            class="w-full p-2 rounded bg-zinc-800 border border-gray-600 text-white" />
                    </td>
                    <td class="px-3 py-2">
                        <input name="team_members[{{ $i }}][external_url]" value="{{ $row['external_url'] ?? '' }}"
                            class="w-full p-2 rounded bg-zinc-800 border border-gray-600 text-white" />
                    </td>
                    <td class="px-3 py-2 text-right">
                        <button type="button" onclick="removeRow(this)"
                            class="px-3 py-1 rounded bg-red-600/20 border border-red-600 text-red-200">
                            X
                        </button>
                    </td>
                </tr>
            @empty
                <tr class="align-top">
                    <td class="px-3 py-2">
                        <input name="team_members[0][name]" value=""
                            class="w-full p-2 rounded bg-zinc-800 border border-gray-600 text-white" />
                    </td>
                    <td class="px-3 py-2">
                        <input name="team_members[0][role]" value=""
                            class="w-full p-2 rounded bg-zinc-800 border border-gray-600 text-white" />
                    </td>
                    <td class="px-3 py-2">
                        <input name="team_members[0][external_url]" value=""
                            class="w-full p-2 rounded bg-zinc-800 border border-gray-600 text-white" />
                    </td>
                    <td class="px-3 py-2 text-right">
                        <button type="button" onclick="removeRow(this)"
                            class="px-3 py-1 rounded bg-red-600/20 border border-red-600 text-red-200">
                            X
                        </button>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<template id="teamTpl">
    <tr class="align-top">
        <td class="px-3 py-2">
            <input name="team_members[__INDEX__][name]" value=""
                class="w-full p-2 rounded bg-zinc-800 border border-gray-600 text-white" />
        </td>
        <td class="px-3 py-2">
            <input name="team_members[__INDEX__][role]" value=""
                class="w-full p-2 rounded bg-zinc-800 border border-gray-600 text-white" />
        </td>
        <td class="px-3 py-2">
            <input name="team_members[__INDEX__][external_url]" value=""
                class="w-full p-2 rounded bg-zinc-800 border border-gray-600 text-white" />
        </td>
        <td class="px-3 py-2 text-right">
            <button type="button" onclick="removeRow(this)"
                class="px-3 py-1 rounded bg-red-600/20 border border-red-600 text-red-200">
                X
            </button>
        </td>
    </tr>
</template>

<hr class="border-zinc-700/60 my-6">

{{-- External Links --}}
<div class="flex items-center justify-between mb-3">
    <h3 class="text-lg font-semibold text-crypto-primary">External Links</h3>
    <button type="button" onclick="addRepeaterRow('linksBody', 'linkTpl')"
        class="px-3 py-2 rounded bg-zinc-800 border border-zinc-600 hover:border-crypto-primary transition">
        + Add Link
    </button>
</div>

<div class="overflow-x-auto mb-6">
    <table class="w-full text-sm">
        <thead class="bg-zinc-900/60 text-gray-300">
            <tr>
                <th class="px-3 py-2 text-left">Label</th>
                <th class="px-3 py-2 text-left">URL</th>
                <th class="px-3 py-2 text-right">Remove</th>
            </tr>
        </thead>
        <tbody id="linksBody" class="divide-y divide-zinc-700/50">
            @php
                $links = old('external_links', isset($launchpad) ? $launchpad->externalLinks->map(fn($l) => $l->toArray())->toArray() : []);
            @endphp

            @forelse($links as $i => $row)
                <tr class="align-top">
                    <td class="px-3 py-2">
                        <input name="external_links[{{ $i }}][label]" value="{{ $row['label'] ?? '' }}"
                            class="w-full p-2 rounded bg-zinc-800 border border-gray-600 text-white" />
                    </td>
                    <td class="px-3 py-2">
                        <input name="external_links[{{ $i }}][url]" value="{{ $row['url'] ?? '' }}"
                            class="w-full p-2 rounded bg-zinc-800 border border-gray-600 text-white" />
                    </td>
                    <td class="px-3 py-2 text-right">
                        <button type="button" onclick="removeRow(this)"
                            class="px-3 py-1 rounded bg-red-600/20 border border-red-600 text-red-200">
                            X
                        </button>
                    </td>
                </tr>
            @empty
                <tr class="align-top">
                    <td class="px-3 py-2">
                        <input name="external_links[0][label]" value=""
                            class="w-full p-2 rounded bg-zinc-800 border border-gray-600 text-white" />
                    </td>
                    <td class="px-3 py-2">
                        <input name="external_links[0][url]" value=""
                            class="w-full p-2 rounded bg-zinc-800 border border-gray-600 text-white" />
                    </td>
                    <td class="px-3 py-2 text-right">
                        <button type="button" onclick="removeRow(this)"
                            class="px-3 py-1 rounded bg-red-600/20 border border-red-600 text-red-200">
                            X
                        </button>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<template id="linkTpl">
    <tr class="align-top">
        <td class="px-3 py-2">
            <input name="external_links[__INDEX__][label]" value=""
                class="w-full p-2 rounded bg-zinc-800 border border-gray-600 text-white" />
        </td>
        <td class="px-3 py-2">
            <input name="external_links[__INDEX__][url]" value=""
                class="w-full p-2 rounded bg-zinc-800 border border-gray-600 text-white" />
        </td>
        <td class="px-3 py-2 text-right">
            <button type="button" onclick="removeRow(this)"
                class="px-3 py-1 rounded bg-red-600/20 border border-red-600 text-red-200">
                X
            </button>
        </td>
    </tr>
</template>

{{-- Submit --}}
<div class="text-end mt-6">
    <button type="submit"
        class="bg-crypto-primary text-black font-medium py-2 px-6 rounded hover:brightness-110 transition">
        {{ ($mode ?? 'create') === 'edit' ? 'Update Launchpad' : 'Create Launchpad' }}
    </button>
</div>

<script>
    function removeRow(btn) {
        const tr = btn.closest('tr');
        if (tr) tr.remove();
    }

    function removeBlock(btn) {
        const card = btn.closest('div.p-3');
        if (card) card.remove();
    }

    function getNextIndex(containerEl, namePrefix) {
        // finds max index currently used in inputs like namePrefix[3][field]
        const inputs = containerEl.querySelectorAll('input[name^="' + namePrefix + '["], textarea[name^="' + namePrefix + '["], select[name^="' + namePrefix + '["]');
        let max = -1;
        inputs.forEach(inp => {
            const m = inp.name.match(new RegExp('^' + namePrefix.replace(/[.*+?^${}()|[\]\\]/g, '\\$&') + '\\[(\\d+)\\]'));
            if (m) max = Math.max(max, parseInt(m[1], 10));
        });
        return max + 1;
    }

    function addRepeaterRow(containerId, templateId) {
        const container = document.getElementById(containerId);
        const tpl = document.getElementById(templateId);
        if (!container || !tpl) return;

        // name prefix depends on the template
        let prefix = 'items';
        if (templateId === 'phaseStepTpl') prefix = 'phase_steps';
        if (templateId === 'statTpl') prefix = 'highlight_stats';
        if (templateId === 'teamTpl') prefix = 'team_members';
        if (templateId === 'linkTpl') prefix = 'external_links';

        const idx = getNextIndex(container, prefix);

        const html = tpl.innerHTML.replaceAll('__INDEX__', idx);
        const temp = document.createElement('tbody');
        temp.innerHTML = html.trim();
        // template is TR; append first child
        container.appendChild(temp.firstElementChild);
    }

    // Blocks container is DIV-based
    function addRepeaterRow(containerId, templateId) {
        const container = document.getElementById(containerId);
        const tpl = document.getElementById(templateId);
        if (!container || !tpl) return;

        let prefix = 'blocks';
        if (templateId !== 'blockTpl') {
            // fallback for table-based repeaters
            return addRepeaterRowTable(containerId, templateId);
        }

        const idx = getNextIndex(container, prefix);
        const html = tpl.innerHTML.replaceAll('__INDEX__', idx);

        const temp = document.createElement('div');
        temp.innerHTML = html.trim();
        container.appendChild(temp.firstElementChild);
    }

    function addRepeaterRowTable(containerId, templateId) {
        const container = document.getElementById(containerId);
        const tpl = document.getElementById(templateId);
        if (!container || !tpl) return;

        let prefix = 'items';
        if (templateId === 'phaseStepTpl') prefix = 'phase_steps';
        if (templateId === 'statTpl') prefix = 'highlight_stats';
        if (templateId === 'teamTpl') prefix = 'team_members';
        if (templateId === 'linkTpl') prefix = 'external_links';

        const idx = getNextIndex(container, prefix);
        const html = tpl.innerHTML.replaceAll('__INDEX__', idx);

        const temp = document.createElement('tbody');
        temp.innerHTML = html.trim();
        container.appendChild(temp.firstElementChild);
    }
</script>