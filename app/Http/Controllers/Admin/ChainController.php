<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ChainController extends Controller
{
    public function index()
    {
        $chains = Chain::orderBy('name')->paginate(20);
        return view('admin.pages.chains.index', compact('chains'));
    }

    public function create()
    {
        return view('admin.pages.chains.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255','unique:chains,name'],
            'symbol' => ['required','string','max:20','unique:chains,symbol'],
            'icon' => ['nullable','image','max:2048'],
            'is_active' => ['nullable','boolean'],
        ]);

        $iconPath = null;
        if ($request->hasFile('icon')) {
            $iconPath = $request->file('icon')->store('chains/icons', 'public');
        }

        Chain::create([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
            'symbol' => strtoupper(trim($data['symbol'])),
            'icon' => $iconPath,
            'is_active' => (bool) $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.chains.index')->with('success','Chain created.');
    }

    public function edit(Chain $chain)
    {
        return view('admin.pages.chains.edit', compact('chain'));
    }

    public function update(Request $request, Chain $chain)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255','unique:chains,name,'.$chain->id],
            'symbol' => ['required','string','max:20','unique:chains,symbol,'.$chain->id],
            'icon' => ['nullable','image','max:2048'],
            'is_active' => ['nullable','boolean'],
        ]);

        if ($request->hasFile('icon')) {
            if ($chain->icon) {
                Storage::disk('public')->delete($chain->icon);
            }
            $chain->icon = $request->file('icon')->store('chains/icons', 'public');
        }

        $chain->update([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
            'symbol' => strtoupper(trim($data['symbol'])),
            'icon' => $chain->icon,
            'is_active' => (bool) $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.chains.index')->with('success','Chain updated.');
    }

    public function destroy(Chain $chain)
    {
        if ($chain->icon) {
            Storage::disk('public')->delete($chain->icon);
        }
        $chain->delete();
        return back()->with('success','Chain deleted.');
    }
}

