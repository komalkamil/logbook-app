@extends('layouts.app')

@section('title', 'Kelola Opsi Dropdown')

@section('content')

    <div class="container mt-4">

        <h2 class="fw-bold mb-4">Kelola Opsi Dropdown</h2>

        {{-- Notifikasi --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Form Tambah --}}
        <div class="card mb-4">
            <div class="card-body">

                <form action="{{ route('options.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-4">
                            <label>Tipe</label>
                            <select name="type" class="form-control">
                                <option value="aktivitas G7">Aktivitas G7</option>
                                <option value="aktivitas o/u">Aktivitas O/U</option>
                                <option value="proyek">Proyek</option>
                                <option value="deskripsi g7">Deskripsi G7</option>
                                <option value="deskripsi o/u">Deskripsi O/U</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>Value</label>
                            <input type="text" name="value" class="form-control">
                        </div>

                        <div class="col-md-2 d-flex align-items-end">
                            <button class="btn btn-primary w-100">
                                Tambah
                            </button>
                        </div>
                    </div>

                </form>

            </div>
        </div>

        {{-- Tabel Opsi --}}
        <div class="card">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Tipe</th>
                                <th>Value</th>
                                <th>Status</th>
                                <th width="200">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse($options as $option)
                                <tr>
                                    <form action="{{ route('options.update', $option->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <td>
                                            {{ ucfirst($option->type) }}
                                        </td>

                                        <td>
                                            <input type="text" name="value" value="{{ $option->value }}"
                                                class="form-control">
                                        </td>

                                        <td class="text-center">
                                            <input type="checkbox" name="is_active"
                                                {{ $option->is_active ? 'checked' : '' }}>
                                        </td>

                                        <td>
                                            <button class="btn btn-sm btn-warning">
                                                Update
                                            </button>
                                    </form>

                                    <form action="{{ route('options.destroy', $option->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">
                                            Hapus
                                        </button>
                                    </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">
                                        Belum ada opsi.
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>

@endsection
