@extends('master')
@section('content')

<div class="container mt-4">
    <div class="dashboard-header d-flex justify-content-between align-items-center mb-4 p-3 rounded shadow-sm">
        <h2 class="mb-0 text-black">Book Your Appointment</h2>

        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button class="btn btn-light btn-sm">Logout</button>
        </form>
    </div>

    @if(session('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="card form-card shadow-sm">
                <div class="card-header text-black">
                    <h5 class="mb-0">Appointment Details</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('create_appointment') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="John Doe"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control"
                                placeholder="name@example.com" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="number" name="phone" id="phone" class="form-control" placeholder="0123456789"
                                required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Date</label>
                                <input type="date" name="preferred_date" id="preferred_date" class="form-control"
                                    required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Time</label>
                                <input type="time" name="preferred_time" id="preferred_time" class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Reason for Visit</label>
                            <textarea name="reason" id="reason" class="form-control" rows="3"
                                placeholder="Briefly describe your issue..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Confirm Booking</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="table-container p-4 rounded border">
                <h4 class="mb-4">My Appointments</h4>
                <div id="appointments">
                    <div class="text-center p-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        fetch('/user_appointments')
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('appointments');
            
            if (data.length === 0) {
                container.innerHTML = "<p class='no-data'>You haven't booked any appointments yet.</p>";
                return;
            }
            
            let html = `
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Date & Time</th>
                            <th>Reason</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
            `;
            
            data.forEach(appointment => {
                const statusClass = appointment.status === 'approved' ? 'success' : 
                                    appointment.status === 'pending' ? 'warning text-dark' : 'secondary';
                
                html += `
                <tr>
                    <td>
                        <div class="fw-bold">${appointment.preferred_date}</div>
                        <small class="text-muted">${appointment.preferred_time}</small>
                    </td>
                    <td>${appointment.reason}</td>
                    <td>
                        <span class="badge bg-${statusClass} text-uppercase" style="font-size: 0.75rem;">
                            ${appointment.status}
                        </span>
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
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('appointments').innerHTML = "<p class='text-danger text-center'>Failed to load appointments.</p>";
        });
    });
</script>
@endsection