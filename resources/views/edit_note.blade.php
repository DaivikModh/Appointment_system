@extends('master')
@section('content')

@if ($data)

<div class="container mt-5">

    <h2 class="mb-4 text-center fw-semibold">Admin Approval Page</h2>

    <div class="card shadow-sm mb-4 info-card">
        <div class="card-header text-black">
            Appointment Details
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <p><strong>Name:</strong> {{ $data->name }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Email:</strong> {{ $data->email }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Phone Number:</strong> {{ $data->phone }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Reason:</strong> {{ $data->reason }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Date:</strong> {{ $data->preferred_date }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Time:</strong> {{ $data->preferred_time }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm form-card">
        <div class="card-header text-black">
            Update Status
        </div>
        <div class="card-body">

            <form action="/change_note" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $data->id }}">

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select">
                        @php
                        $statuses = ['Pending', 'Approved', 'Rejected', 'Rescheduled'];
                        @endphp

                        <option value="{{ $data->status }}">{{ $data->status }}</option>

                        @foreach($statuses as $status)
                        @if($status != $data->status)
                        <option value="{{ $status }}">{{ $status }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="admin_note" class="form-label">Admin Note</label>
                    <input type="text" name="admin_note" id="admin_note" class="form-control">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="suggested_date" class="form-label">Suggested Date</label>
                        <input type="date" name="suggested_date" id="suggested_date" value="{{ $data->preferred_date }}"
                            class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="suggested_time" class="form-label">Suggested Time</label>
                        <input type="time" name="suggested_time" id="suggested_time" value="{{ $data->preferred_time }}"
                            class="form-control">
                    </div>
                </div>

                <button class="btn btn-success w-100 py-2">Save</button>

            </form>

        </div>
    </div>

</div>

@endif

@endsection