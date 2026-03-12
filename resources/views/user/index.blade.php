@extends('layouts.app')

@section('title', 'Dashboard Logbook')

@section('content')



    <div class="row">

        <label class="fw-bold mb-4">Dashboard Logbook {{ $users->name }}</label>



        <div class="col col-md-4 mb-2">
            <div class="card rounded">
                <img src="{{ asset('img/' . $users->name . '.png') }}" style="height: 170px; contain" alt="">
            </div>
        </div>

    </div>

    {{-- Notifikasi sukses --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (Auth::user()->role != 'admin')
        <div class="mb-3">
            <a href="{{ route('logbook.create') }}" class="btn btn-primary">
                + Tambah Logbook
            </a>
        </div>
    @endif
    {{-- Tombol tambah --}}


    {{-- Tabel Logbook --}}
    <div class="card shadow-sm">
        <div class="card-body">

            @if ($logbooks->count() > 0)

                <div class="table-responsive">

                    @foreach ($logbooks as $index => $logbook)
                        <div class="card border-secondary mb-2">
                            <div class="card-header d-flex align-items-center">

                                <h4 class="mb-0">
                                    {{ \Carbon\Carbon::parse($logbook->tanggal)->translatedFormat('l, d F Y') }}
                                </h4>

                                <div class="ms-auto d-flex gap-2">

                                    <a href="{{ route('logbook.show', $logbook->id) }}" class="btn btn-icon btn-md">
                                        <i class="ti ti-arrow-right"></i>
                                    </a>

                                    @if (Auth::user()->role != 'admin')
                                        <a href="{{ route('logbook.edit', $logbook->id) }}" class="btn btn-icon btn-md">
                                            <i class="ti ti-pencil"></i>
                                        </a>

                                        <form action="#" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-icon btn-md text-danger"
                                                onclick="return confirm('Yakin hapus?')">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>

                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center py-4">
                        <p class="text-muted">Belum ada data logbook.</p>
                    </div>
            @endif

        </div>
    </div>



@endsection
