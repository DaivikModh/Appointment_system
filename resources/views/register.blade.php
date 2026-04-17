@extends('master')
@section('content')

<div class="container">
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-md-5">
            <div class="card form-card shadow-lg">
                <div class="card-header text-black text-center py-3">
                    <h3 class="mb-0">Create Account</h3>
                    <p class="small mb-0 opacity-75">Join us to start booking appointments</p>
                </div>
                <div class="card-body p-4">

                    @if ($errors->any())
                    <div class="alert alert-danger pb-0">
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('create_user') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" id="username" class="form-control"
                                placeholder="johndoe123" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control"
                                placeholder="name@example.com" required>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="••••••••" required>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success btn-lg shadow-sm">Register</button>
                        </div>
                    </form>

                    <div class="text-center mt-4">
                        <p class="text-muted mb-0">Already have an account?</p>
                        <a href="{{ route('login') }}" class="btn btn-link text-decoration-none fw-bold">Login here</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection