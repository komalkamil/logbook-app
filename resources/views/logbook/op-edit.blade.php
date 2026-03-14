@extends('layouts.app')

@section('title', 'Edit Logbook')

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

    <h2 class="mb-2 fw-bold">Edit Logbook</h2>

    <form action="{{ route('logbook.update', $logbook->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card border-secondary p-4 rounded-lg mb-4">
            <div class="row">

                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <label for="hm">Hour Meter :</label>
                <input type="text" name="hm" id="hm" value="{{ $logbook->hm }}">

                <label>Nama : {{ auth()->user()->name }}</label><br>
                <label>Unit : {{ auth()->user()->unit }}</label><br>

                <div class="col-md-4">
                    <input type="date" name="tanggal" value="{{ $logbook->tanggal }}"
                        class="input-group w-full border rounded p-1 my-2">
                </div>

            </div>
        </div>


        {{-- DETAIL --}}
        <div id="activityContainer">

            @foreach ($logbook->details as $index => $detail)
                <div class="activity-card card p-2 mb-2 mt-2">
                    <div class="card-body">

                        <span class="badge bg-secondary text-white row-number mb-2">
                            No {{ $index + 1 }}
                        </span><br>

                        <div class="card border-secondary p-2 my-2">
                            <label>Waktu :</label>
                            <input type="text" name="detail[{{ $index }}][waktu]" value="{{ $detail->waktu }}"
                                class="form-control">
                        </div>


                        <div class="card border-secondary p-2 mb-2">

                            <label class="fw-bold mb-3">Aktivitas :</label>

                            @foreach ($aktivitas as $option)
                                <label class="form-check">
                                    <input class="form-check-input" type="radio"
                                        name="detail[{{ $index }}][aktivitas]" value="{{ $option }}"
                                        {{ $detail->aktivitas == $option ? 'checked' : '' }}>

                                    <span class="form-check-label mb-2">
                                        {{ $option }}
                                    </span>

                                </label>
                            @endforeach

                        </div>


                        <div class="card border-secondary p-2 mb-2">

                            <label>Proyek</label>

                            <select class="form-select" name="detail[{{ $index }}][proyek]">

                                @foreach ($proyeks as $p)
                                    <option value="{{ $p }}" {{ $detail->proyek == $p ? 'selected' : '' }}>
                                        {{ $p }}
                                    </option>
                                @endforeach

                            </select>

                        </div>


                        <div class="card border-secondary p-2 mb-2">

                            <label class="fw-bold mb-3">Deskripsi :</label>

                            <input type="text" name="detail[{{ $index }}][deskripsi]"
                                value="{{ $detail->deskripsi }}" class="form-control">

                        </div>


                        <div class="card border-secondary p-2 mb-2">

                            <label class="fw-bold mb-3">Pekerja :</label>

                            <input type="hidden" name="detail[{{ $index }}][pekerja]"
                                value="{{ $detail->pekerja }}" class="form-control">

                        </div>




                        <button type="button" class="btn btn-danger btn-sm removeRow mt-2">
                            -
                        </button>

                    </div>
                </div>
            @endforeach

        </div>


        <button type="button" class="btn btn-primary btn-sm addRow">+</button>


        <div class="mt-4 text-center mb-5">
            <button type="submit" class="btn btn-md btn-primary">
                Update Data
            </button>
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

<span class="badge bg-secondary text-white row-number mb-2">
No ${index+1}
</span><br>

<div class="card border-secondary p-2 my-2">

<label>Waktu :</label>

<input type="text"
name="detail[${index}][waktu]"
class="form-control">

</div>


<div class="card border-secondary p-2 mb-2">

<label class="fw-bold mb-3">Aktivitas :</label>

@foreach ($aktivitas as $option)

<label class="form-check">

<input
class="form-check-input"
type="radio"
name="detail[${index}][aktivitas]"
value="{{ $option }}">

<span class="form-check-label mb-2">
{{ $option }}
</span>

</label>

@endforeach

</div>


<div class="card border-secondary p-2 mb-2">

<label>Proyek</label>

<select class="form-select"
name="detail[${index}][proyek]">

@foreach ($proyeks as $p)

<option value="{{ $p }}">
{{ $p }}
</option>

@endforeach

</select>

</div>


<div class="card border-secondary p-2 mb-2">

<label>Deskripsi :</label>

<input
type="text"
name="detail[${index}][deskripsi]"
class="form-control">

</div>


<div class="card border-secondary p-2 mb-2">

<input type="hidden" name="detail[{{ $index }}][pekerja]" value="{{ $detail->pekerja }}" class="form-control">


<div class="card border-secondary p-2 mb-2">

<label>Output :</label>

<input
type="text"
name="detail[${index}][output]"
class="form-control">

</div>


<button type="button"
class="btn btn-danger btn-sm removeRow mt-2">
-
</button>

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

                document.querySelectorAll(".activity-card")
                    .forEach((card, index) => {

                        card.querySelector(".row-number")
                            .textContent = "No " + (index + 1);

                    });

            }

        });
    </script>

@endsection
