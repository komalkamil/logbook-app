<?php

namespace App\Http\Controllers;

use App\Models\Detail_logbook;
use App\Models\Logbook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Option;
use App\Models\User;


class LogbookController extends Controller
{

    public function create()
    {
        $aktivitas = Option::where('type', 'aktivitas o/u')
            ->where('is_active', true)
            ->pluck('value');

        $deskripsi = Option::where('type', 'deskripsi o/u')
            ->where('is_active', true)
            ->pluck('value');

        $aktivitasg7 = Option::where('type', 'aktivitas g7')
            ->where('is_active', true)
            ->pluck('value');

        $deskripsig7 = Option::where('type', 'deskripsi g7')
            ->where('is_active', true)
            ->pluck('value');

        $proyeks = Option::where('type', 'proyek')
            ->where('is_active', true)
            ->pluck('value');

        if (Auth::user()->role == 'pic') {
            return view('logbook.create', compact(['aktivitasg7', 'proyeks', 'deskripsig7']));
        }
        if (Auth::user()->role == 'op') {
            return view('logbook.op-create', compact(['aktivitas', 'proyeks', 'deskripsi']));
        }

        abort(403);
    }

    public function store(Request $request)
    {
        // dd($request)->all();
        $validated = $request->validate([
            'user_id' => 'required',
            'tanggal' => 'required|date',
            'hm' => 'nullable|string',
            'detail' => 'required|array|min:1',
        ]);

        DB::beginTransaction();

        try {

            // Simpan header
            $record = Logbook::create([
                'user_id' => $validated['user_id'],
                'hm' => $validated['hm'] ?? null,
                'tanggal' => $validated['tanggal'],
            ]);

            // Simpan detail
            foreach ($validated['detail'] as $index => $row) {

                Detail_logbook::create([
                    'logbook_id' => $record->id,
                    'no' => $index + 1,
                    'waktu' => $row['waktu'] ?? '-',
                    'aktivitas' => $row['aktivitas'] ?? '-',
                    'proyek' => $row['proyek'] ?? '-',
                    'deskripsi' => $row['deskripsi'] ?? '-',
                    'pekerja' => $row['pekerja'] ?? '-',
                    'output' => $row['output'] ?? '-',
                ]);
            }

            DB::commit();

            return redirect()
                ->route('user.index')
                ->with('success', 'Logbook berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }

    public function edit($id)
    {
        $logbook = Logbook::with('details')->findOrFail($id);

        $aktivitas = Option::where('type', 'aktivitas o/u')
            ->where('is_active', true)
            ->pluck('value');

        $deskripsi = Option::where('type', 'deskripsi o/u')
            ->where('is_active', true)
            ->pluck('value');

        $aktivitasg7 = Option::where('type', 'aktivitas g7')
            ->where('is_active', true)
            ->pluck('value');

        $deskripsig7 = Option::where('type', 'deskripsi g7')
            ->where('is_active', true)
            ->pluck('value');

        $proyeks = Option::where('type', 'proyek')
            ->where('is_active', true)
            ->pluck('value');

        if (Auth::user()->role == 'pic') {
            return view('logbook.edit', compact(
                'logbook',
                'aktivitasg7',
                'deskripsig7',
                'proyeks'
            ));
        }

        if (Auth::user()->role == 'op') {
            return view('logbook.op-edit', compact(
                'logbook',
                'aktivitas',
                'deskripsi',
                'proyeks'
            ));
        }

        abort(403);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'tanggal' => 'required|date',
            'hm' => 'nullable|string',
            'detail' => 'required|array|min:1',
        ]);

        DB::beginTransaction();

        try {

            $logbook = Logbook::findOrFail($id);

            // update header
            $logbook->update([
                'user_id' => $validated['user_id'],
                'hm' => $validated['hm'] ?? null,
                'tanggal' => $validated['tanggal'],
            ]);

            // hapus detail lama
            Detail_logbook::where('logbook_id', $logbook->id)->delete();

            // insert ulang detail
            foreach ($validated['detail'] as $index => $row) {

                Detail_logbook::create([
                    'logbook_id' => $logbook->id,
                    'no' => $index + 1,
                    'waktu' => $row['waktu'] ?? '-',
                    'aktivitas' => $row['aktivitas'] ?? '-',
                    'proyek' => $row['proyek'] ?? '-',
                    'deskripsi' => $row['deskripsi'] ?? '-',
                    'pekerja' => $row['pekerja'] ?? '-',
                    'output' => $row['output'] ?? '-',
                ]);
            }

            DB::commit();

            return redirect()
                ->route('user.index')
                ->with('success', 'Logbook berhasil diupdate');
        } catch (\Exception $e) {

            DB::rollBack();
            dd($e->getMessage());
        }
    }

    public function show($id)
    {

        $logbook = Logbook::with('details', 'user')->findOrFail($id);

        return view('logbook.show', compact('logbook'));
    }
}
