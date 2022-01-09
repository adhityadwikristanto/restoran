@extends('template')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-2">
            <h5>Login menggunakan akun Google Anda!</h5>
            <a href="/auth/redirect" class="btn btn-primary btn-block">Google OAuth</a>   
        </div>
    </div>
</div>
@endsection