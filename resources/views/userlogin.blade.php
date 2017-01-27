@extends('layouts.front', ['navbar' => 'navbar-bg'])

@section('content')
    <section id="content">
        <div class="container">
            <div class="row">
                <form class="col-sm-6 text-justify">
                    <h2>Login</h2>
                    <div class="form-group">
                        <label>Username</label>
                        <input class="form-control" type="text" placeholder="Masukkan Username" />
                    </div>
                    <div class="form-group">
                        <label>Kata Sandi</label>
                        <input class="form-control" type="email" placeholder="Masukkan Kata Sandi" />
                    </div>
                    <div class="form-group">
                        <a href="/forgotpassword"><small>Lupa Kata Sandi?<small></a>
                    </div>
                    <button class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </section>
@endsection