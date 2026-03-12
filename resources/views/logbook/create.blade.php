@extends('layouts.app')

@section('title', 'Form')
@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h2 class="mb-2 fw-bold">Formulir Logboook</h2>
    <form action="{{ route('logbook.store') }}" method="POST">
        @csrf
        <div class="card border-secondary p-4 rounded-lg mb-4">
            <div class="row">
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <input type="hidden" name="hm" value="-">
                <label>Nama : {{ auth()->user()->name }}</label><br>
                <label>Unit : {{ auth()->user()->unit }}</label><br>

                <div class="col-md-4">
                    <input type="date" name="tanggal" class="input-group w-full border rounded p-1 my-2">
                </div>
            </div>
        </div>
        {{-- Detail --}}
        <div id="activityContainer">

            <div class="activity-card card p-2 mb-2 mt-2">
                <div class="card-body">
                    <span class="badge bg-secondary text-white row-number mb-2">No 1</span><br>
                    <div class="card border-secondary p-2 my-2">
                        <label for="" class="mb-1">Waktu :</label>
                        <input type="text" name="detail[0][waktu]" class="form-control mb-2">
                    </div>

                    <div class="card border-secondary p-2 mb-2">
                        <label for="" class="fw-bold mb-3">Aktivitas :</label>
                        @foreach ($aktivitasg7 as $option)
                            <label class="form-check">
                                <input class="form-check-input" type="radio" name="detail[0][aktivitas]"
                                    value="{{ $option }}" />
                                <span class="form-check-label mb-2">{{ $option }}</span>
                            </label>
                        @endforeach
                    </div>

                    <div class="card border-secondary p-2 mb-2">
                        <label class="form-label">Proyek</label>
                        <select class="form-select" name="detail[0][proyek]">
                            @foreach ($proyeks as $proyek)
                                <option value="{{ $proyek }}">{{ $proyek }}</option>
                            @endforeach
                        </select>
                    </div>



                    <div class="card border-secondary p-2 mb-2">
                        <label for="" class="fw-bold mb-3">Deskripsi :</label>
                        <input type="text" name="detail[0][deskripsi]" class="form-control">
                    </div>

                    <div class="card border-secondary p-2 mb-2">
                        <label for="" class="fw-bold mb-3">Pekerja :</label>
                        <input type="text" name="detail[0][pekerja]" class="form-control">
                    </div>

                    <div class="card border-secondary p-2 mb-2">
                        <label for="" class="fw-bold mb-3">Output :</label>
                        <input type="text" name="detail[0][output]" class="form-control">
                    </div>

                </div>
            </div>
        </div>
        <div class="p2"></div>
        <button type="button" class="btn btn-primary btn-sm addRow">+</button>





        <div class="mt-6 text-center mb-5 ">
            <button type="submit" class="btn btn-md btn-primary">Simpan Data</button>
        </div>
    </form>




    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const container = document.getElementById("activityContainer");
            const addBtn = document.querySelector(".addRow");

            addBtn.addEventListener("click", function() {

                let index = document.querySelectorAll(".activity-card").length;

                let newCard = `
         <div class="activity-card card p-2 mb-2 mt-2">
                <div class="card-body">
                    <span class="badge bg-secondary text-white row-number mb-2">No ${index + 1}</span><br>
                    <div class="card border-secondary p-2 my-2">
                        <label for="" class="mb-1">Waktu :</label>
                        <input type="text" name="detail[${index}][waktu]" class="form-control mb-2">
                    </div>

                    <div class="card border-secondary p-2 mb-2">
                        <label for="" class="fw-bold mb-3">Aktivitas :</label>
                        @foreach ($aktivitasg7 as $option)
                            <label class="form-check">
                                <input class="form-check-input" type="radio" name="detail[${index}][aktivitas]"
                                    value="{{ $option }}" />
                                <span class="form-check-label mb-2">{{ $option }}</span>
                            </label>
                        @endforeach
                    </div>

                    <div class="card border-secondary p-2 mb-2">
                        <label class="form-label">Proyek</label>
                        <select class="form-select" name="detail[${index}][proyek]">
                            @foreach ($proyeks as $proyek)
                                 <option value="{{ $proyek }}">{{ $proyek }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="card border-secondary p-2 mb-2">
                        <label for="" class="fw-bold mb-3">Deskripsi :</label>
                        <input type="text" name="detail[${index}][deskripsi]" class="form-control">
                    </div>

                    <div class="card border-secondary p-2 mb-2">
                        <label for="" class="fw-bold mb-3">Pekerja :</label>
                        <input type="text" name="detail[${index}][pekerja]" class="form-control">
                    </div>

                    <div class="card border-secondary p-2 mb-2">
                        <label for="" class="fw-bold mb-3">Output :</label>
                        <input type="text" name="detail[${index}][output]" class="form-control">
                    </div>
                    <button type="button" class="btn btn-danger btn-sm removeRow mt-2">-</button>
                </div>
            </div>
        `;

                container.insertAdjacentHTML("beforeend", newCard);
            });

            container.addEventListener("click", function(e) {

                if (e.target.classList.contains("removeRow")) {
                    e.target.closest(".activity-card").remove();
                    updateNumber();
                }

            });

            function updateNumber() {
                document.querySelectorAll(".activity-card").forEach((card, index) => {
                    card.querySelector(".row-number").textContent = "No " + (index + 1);
                });
            }

        });
    </script>
@endsection
