@extends('layouts.app')

@section('title', 'Detail Logbook')

@section('content')

    <div class="container mt-4">

        <h2 class="fw-bold mb-4">Detail Logbook</h2>

        {{-- Header Info --}}
        <div class="card shadow-sm mb-4">
            <div class="card-body">

                <div class="row mb-2">
                    <div class="col-md-4">
                        <strong>Nama :</strong><br>
                        {{ $logbook->user->name }}
                    </div>
                    <div class="col-md-4">
                        <strong>Unit :</strong><br>
                        {{ $logbook->user->unit }}
                    </div>
                    <div class="col-md-4">
                        <strong>Tanggal :</strong><br>
                        {{ \Carbon\Carbon::parse($logbook->tanggal)->translatedFormat('l, d F Y') }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <strong>HM :</strong><br>
                        {{ $logbook->hm ?? '-' }}
                    </div>
                </div>

            </div>
        </div>

        {{-- Detail Aktivitas --}}
        <div class="card shadow-sm">
            <div class="card-body">

                @if ($logbook->details->count() > 0)

                    <div class="table-responsive">
                        <table class="table  align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>Proyek</th>
                                    <th>Aktivitas</th>
                                    <th>Deskripsi</th>
                                    <th>Pekerja</th>
                                    <th>Waktu</th>
                                    <th>Output</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($logbook->details as $detail)
                                    <tr>
                                        <td>{{ $detail->proyek }}</td>
                                        <td>{{ $detail->aktivitas }}</td>
                                        <td>{{ $detail->deskripsi }}</td>
                                        <td>
                                            <div class="badge bg-secondary text-white">
                                                <p>{{ $detail->pekerja }}</p>
                                            </div>
                                        </td>
                                        <td>{{ $detail->waktu }}</td>
                                        <td>{{ $detail->output }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted text-center">Tidak ada detail aktivitas.</p>
                @endif

            </div>
        </div>

        <div class="mt-4">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">
                ← Kembali
            </a>
        </div>

    </div>

@endsection
