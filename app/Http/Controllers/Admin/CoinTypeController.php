<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CoinType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CoinTypeController extends Controller
{
    public function index()
    {
        $types = CoinType::orderBy('name')->paginate(20);
        return view('admin.pages.coin-types.index', compact('types'));
    }

    public function create()
    {
        return view('admin.pages.coin-types.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255','unique:coin_types,name'],
            'is_active' => ['nullable','boolean'],
        ]);

        CoinType::create([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
            'is_active' => (bool) $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.coin-types.index')->with('success','Type created.');
    }

    public function edit(CoinType $coin_type)
    {
        return view('admin.pages.coin-types.edit', ['type' => $coin_type]);
    }

    public function update(Request $request, CoinType $coin_type)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255','unique:coin_types,name,'.$coin_type->id],
            'is_active' => ['nullable','boolean'],
        ]);

        $coin_type->update([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
            'is_active' => (bool) $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.coin-types.index')->with('success','Type updated.');
    }

    public function destroy(CoinType $coin_type)
    {
        $coin_type->delete();
        return back()->with('success','Type deleted.');
    }
}

