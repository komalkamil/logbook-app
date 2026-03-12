<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Option;

class OptionController extends Controller
{
    public function index()
    {
        $options = Option::orderBy('type')
            ->orderBy('value')
            ->get();

        return view('admin.options.index', compact('options'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:50',
            'value' => 'required|string|max:100',
        ]);

        Option::create([
            'type' => strtolower($request->type),
            'value' => $request->value,
            'is_active' => true,
        ]);

        return back()->with('success', 'Opsi berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'value' => 'required|string|max:100',
        ]);

        $option = Option::findOrFail($id);

        $option->update([
            'value' => $request->value,
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Opsi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Option::findOrFail($id)->delete();

        return back()->with('success', 'Opsi berhasil dihapus.');
    }
}
