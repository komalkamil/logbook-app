<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Logbook;


class DashboardController extends Controller
{
    public function index()
    {
        $users = User::where('role', '!=', 'admin')->get();
        $reports = Logbook::with('user')
            ->whereDate('tanggal', Carbon::today())
            ->get();
        $today = Logbook::whereDate('tanggal', Carbon::today())->count();
        $belumIsi = User::where('role', '!=', 'admin')->whereDoesntHave('logbooks', function ($query) {
            $query->whereDate('tanggal', today());
        })->get();
        $start = Carbon::now()->startOfWeek(Carbon::WEDNESDAY);
        $end   = Carbon::now()->endOfWeek(Carbon::TUESDAY);

        $week = Logbook::whereBetween('tanggal', [$start, $end])->count();

        $month = Logbook::whereMonth('tanggal', Carbon::now()->month)
            ->whereYear('tanggal', Carbon::now()->year)
            ->count();

        return view('admin.index', compact(
            'users',
            'week',
            'month',
            'today',
            'start',
            'end',
            'reports',
            'belumIsi'
        ));
    }

    public function report($id)
    {
        $users = User::get()->findOrFail($id);

        $logbooks = Logbook::where('user_id', $id)
            ->latest()
            ->get();
        return view('user.index', compact('logbooks', 'users'));
    }
}
