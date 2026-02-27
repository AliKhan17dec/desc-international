<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCoinRequest;
use App\Http\Requests\Admin\UpdateCoinRequest;
use App\Models\Category;
use App\Models\Chain;
use App\Models\Coin;
use App\Models\CoinType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CoinController extends Controller
{
    public function index(Request $request)
    {
        $q = Coin::query()->with(['type', 'category', 'chains']);

        if ($search = $request->get('search')) {
            $q->where(function ($qq) use ($search) {
                $qq->where('name', 'like', "%{$search}%")
                    ->orWhere('symbol', 'like', "%{$search}%");
            });
        }

        $coins = $q->latest()->paginate(20)->withQueryString();

        return view('admin.pages.coins.index', compact('coins'));
    }

    public function create()
    {
        $types = CoinType::where('is_active', true)->orderBy('name')->get();
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        $chains = Chain::where('is_active', true)->orderBy('name')->get();

        return view('admin.pages.coins.create', compact('types', 'categories', 'chains'));
    }

    public function store(StoreCoinRequest $request)
    {
        $symbol = strtoupper(trim($request->symbol));

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('coins/logos', 'public');
        }

        $coin = Coin::create([
            // Core identity
            'name'        => $request->name,
            'symbol'      => $symbol,
            'slug'        => Str::slug($request->name . '-' . $symbol),

            // Relations
            'coin_type_id' => $request->coin_type_id,
            'category_id'  => $request->category_id,

            // Media & text
            'description' => $request->description,
            'logo'        => $logoPath,

            // Visibility flags
            'is_active'        => $request->boolean('is_active'),
            'show_in_trending' => $request->boolean('show_in_trending'),
            'trending_rank'    => $request->trending_rank,
            'show_in_gainers'  => $request->boolean('show_in_gainers'),

            // Market data (new fields)
            'mindshare'              => $request->mindshare,
            'volume_percentage_24h'  => $request->volume_percentage_24h,

            'marketcap'     => $request->marketcap,
            'price'         => $request->price,
            'price_change'  => $request->price_change,
            'volume_24h'    => $request->volume_24h,
            'holders'       => $request->holders,

            // Optional / derived
            'marketcap_trend' => $request->marketcap_trend ?? 'up' ,
        ]);

        // Chains (many-to-many)
        if ($request->filled('chains')) {
            $coin->chains()->sync($request->chains);
        }

        return redirect()
            ->route('admin.coins.index')
            ->with('success', 'Coin created successfully.');
    }


    public function edit(Coin $coin)
    {
        $coin->load('chains');

        $types = CoinType::where('is_active', true)->orderBy('name')->get();
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        $chains = Chain::where('is_active', true)->orderBy('name')->get();

        return view('admin.pages.coins.edit', compact('coin', 'types', 'categories', 'chains'));
    }

    public function update(UpdateCoinRequest $request, Coin $coin)
    {
        $symbol = strtoupper(trim($request->symbol));

        if ($request->hasFile('logo')) {
            if ($coin->logo) {
                Storage::disk('public')->delete($coin->logo);
            }
            $coin->logo = $request->file('logo')->store('coins/logos', 'public');
        }

        $coin->fill([
            'name' => $request->name,
            'symbol' => $symbol,
            'slug' => Str::slug($request->name . '-' . $symbol),

            'coin_type_id' => $request->coin_type_id,
            'category_id' => $request->category_id,

            'description' => $request->description,

            'is_active' => (bool) $request->boolean('is_active'),
            'show_in_trending' => (bool) $request->boolean('show_in_trending'),
            'trending_rank' => $request->trending_rank,
            'show_in_gainers' => (bool) $request->boolean('show_in_gainers'),
        ])->save();

        $coin->chains()->sync($request->chains);

        return redirect()->route('admin.coins.index')->with('success', 'Coin updated successfully.');
    }

    public function destroy(Coin $coin)
    {
        if ($coin->logo) {
            Storage::disk('public')->delete($coin->logo);
        }
        $coin->delete();

        return back()->with('success', 'Coin deleted successfully.');
    }
}
