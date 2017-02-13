@extends('layouts.front')

@section('content')
    <section id="content">
        <div class="container">
            <div class="row">
                <form id="login-form" class="col-sm-6 text-justify">
                    <h2>Login</h2>
                    <div class="form-group">
                        <label>Username</label>
                        <input class="form-control" type="text" placeholder="Masukkan Username" required />
                    </div>
                    <div class="form-group">
                        <label>Kata Sandi</label>
                        <input class="form-control" type="email" placeholder="Masukkan Kata Sandi" required />
                    </div>
                    <div class="form-group">
                        <a href="/forgotpassword"><small>Lupa Kata Sandi?</small></a>
                    </div>
                    <button class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('footScript')
    <script src="{{ asset('theme/front/js/validator/simulation-validator.js') }}"></script>
    <script src="{{ asset('theme/front/js/pages/userlogin.js') }}"></script>
@endsection