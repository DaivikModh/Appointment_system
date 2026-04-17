@extends('master')
@section('content')

<div class="container mt-5">
    <div class="alert alert-danger text-center shadow-sm">
        {{ session('error') }}
    </div>
</div>

@endsection