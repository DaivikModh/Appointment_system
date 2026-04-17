@extends('master')
@section('content')

@auth
<script>
    window.location.href = "{{ route('homepage') }}";
</script>
@else

<div class="container">
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-md-5">
            <div class="card form-card shadow-lg">
                <div class="card-header text-black text-center py-3">
                    <h3 class="mb-0">Welcome Back</h3>
                    <p class="small mb-0 opacity-100">Please enter your credentials</p>
                </div>
                <div class="card-body p-4">

                    @if ($errors->any())
                    <div class="alert alert-danger pb-0">
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error)
                            <li><i class="bi bi-exclamation-circle me-2"></i>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('validate') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control form-control-lg"
                                placeholder="name@example.com" required>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control form-control-lg"
                                placeholder="••••••••" required>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg shadow-sm">Login</button>
                        </div>
                    </form>

                    <div class="text-center mt-4">
                        <p class="text-muted mb-0">Don't have an account?</p>
                        <a href="{{ route('register') }}" class="btn btn-link text-decoration-none fw-bold">Create an
                            Account</a>
                    </div>
                </div>
            </div>

            <div class="text-center mt-3">
                <small class="text-muted">&copy; {{ date('Y') }} Appointment System</small>
            </div>
        </div>
    </div>
</div>

@endauth
@endsection