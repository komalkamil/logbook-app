@extends('layouts.app')

@section('title', 'Dashboard Logbook')

@section('content')

    <h2 class="fw-bold mb-4">Dashboard Admin</h2>
    <div class="row row-deck mt-3 mb-2">
        <div class="col-md-6">
            <div class="card p-4 h-100">
                <div class="row align-items-center">

                    <!-- TEXT AREA -->
                    <div class="col-md-7">
                        <h2 class="fw-bold">
                            Welcome back, {{ Auth::user()->name }}
                        </h2>

                        <p class="text-muted">
                            {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                        </p>

                        <div class="row mt-4">

                            <div class="col-md-6">
                                <small class="text-muted text-uppercase">Laporan Hari Ini :</small>
                                <h3 class="fw-bold">
                                    {{ $today . ' dari 4' }} <span
                                        class="text-success fs-6">{{ ($today * 100) / 4 }}%</span>
                                </h3>

                                <div class="progress">
                                    <div class="progress-bar bg-success" style="width:{{ ($today * 100) / 4 }}%"></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <small class="text-muted text-uppercase">Periode {{ $start->translatedFormat('d') }}
                                    -
                                    {{ $end->translatedFormat('d M Y') }}</small>
                                <h3 class="fw-bold">
                                    {{ $week }} <span
                                        class="text-danger fs-6">{{ round(($week * 100) / 28) }}%</span>
                                </h3>

                                <div class="progress">
                                    <div class="progress-bar bg-danger" style="width:{{ round(($week * 100) / 28) }}%">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                    <!-- IMAGE AREA -->
                    <div class="col-md-5 text-end">
                        <img src="{{ asset('img/dashboard.png') }}" class="img-fluid" style="max-height:180px;">
                    </div>

                </div>
            </div>
        </div>

        <div class="col col-md-3">
            <div class="card p-4 h-100">
                <div class="row align-items-center">

                    <!-- TEXT AREA -->

                    <h4 class="text-muted text-uppercase">Total Karyawan :</h4>
                    <h2 class="mt-3  " style="font-size: 48px">4 <ti class="ti ti-users"></ti>
                    </h2><span class="text-muted">Karyawan</span>



                    <div class="row-deck d-flex mt-4">
                        @foreach ($users as $user)
                            <a href="{{ route('dashboard.report', $user->id) }}"
                                class="badge badge-sm bg-purple text-white me-2 p-2">{{ $user->name }}</a>
                        @endforeach
                    </div>


                </div>
            </div>
        </div>

        <div class="col col-md-3">
            <div class="card p-4 h-100">
                <div class="row align-items-center">
                    <h3>Karyawan yang sudah mengisi : </h3>
                    <div class="row-deck d-flex">
                        @foreach ($reports->unique('user_id') as $report)
                            <span class="badge bg-primary text-white">
                                {{ $report->user->name }}
                            </span>
                        @endforeach
                    </div>
                    <h3 class="mt-3">Karyawan yang belum mengisi : </h3>
                    <div class="d-flex flex-wrap gap-2">

                        @foreach ($belumIsi as $user)
                            <a href="{{$user->link}}">
                                <span class="badge bg-danger text-white">
                                    {{ $user->name }} | <ti class="ti ti-bell"></ti>
                                </span>
                            </a>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
