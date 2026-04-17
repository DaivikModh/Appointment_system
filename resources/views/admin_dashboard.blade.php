@extends('master')
@section('content')

@if(auth()->user()->role == 'admin')

<div class="container mt-4">

    <!-- Header -->
    <div class="dashboard-header d-flex justify-content-between align-items-center mb-4 p-3 rounded">
        <h2 class="mb-0 text-black">Admin Dashboard</h2>

        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button class="btn btn-light">Logout</button>
        </form>
    </div>

    <!-- Appointments -->
    <div class="table-container p-4 rounded">
        <h4 class="mb-3">Appointments</h4>
        <div id="appointments"></div>
    </div>

</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        fetch('/appointments')
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('appointments');
            
            if (data.length === 0) {
                container.innerHTML = "<p class='no-data'>No appointments found.</p>";
                return;
            }
            
            let html = `
            <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Reason</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
            `;
                    
            data.forEach(appointment => {
                html += `
                <tr>
                    <td>${appointment.name}</td>
                    <td>${appointment.email}</td>
                    <td>${appointment.phone}</td>
                    <td>${appointment.preferred_date}</td>
                    <td>${appointment.preferred_time}</td>
                    <td>${appointment.reason}</td>
                    <td>
                        <span class="badge bg-${appointment.status === 'approved' ? 'success' : appointment.status === 'pending' ? 'warning text-dark' : 'secondary'}">
                            ${appointment.status}
                        </span>
                    </td>
                    <td>
                        <form action='/edit_note/${appointment.id}' method='GET'>
                            @csrf
                            <button class="btn btn-sm btn-primary">Edit</button>
                        </form>
                    </td>
                </tr>
                `;
            });
                                
            html += `
                </tbody>
                </table>
                </div>
            `;
            container.innerHTML = html;
        })
        .catch(error => console.error('Error:', error));
    });
</script>

@else

<div class="container mt-5">
    <div class="alert alert-danger text-center">
        <h4>You are not authorized to access this page.</h4>
    </div>
</div>

@endif

@endsection