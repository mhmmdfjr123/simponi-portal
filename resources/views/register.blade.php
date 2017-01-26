@extends('layouts.front', ['navbar' => 'navbar-bg'])

@section('content')
    <section id="content">
        <div class="container">
            <div class="row">
                <img class="contentimage" src="{{ asset('theme/front/images/BP_Simponi.jpg') }}" alt="Content" />
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
                    <button class="btn btn-primary">Login</button>
                </form>
                <form class="col-sm-6 text-justify">
                    <h2>Buat Akun</h2>
                    <div class="form-group">
                        <label>Nomor Rekening DPLK</label>
                        <input class="form-control" type="text" placeholder="Masukkan Nomor Rekening DPLK" />
                    </div>
                    <div class="form-group">
                        <label>Alamat Email</label>
                        <input class="form-control" type="email" placeholder="Masukkan Alamat Email" />
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input class="form-control" type="text" placeholder="Masukkan Username" />
                    </div>
                    <div class="form-group">
                        <label>Kata Sandi</label>
                        <input class="form-control" type="password" placeholder="Masukkan Kata Sandi" />
                    </div>
                    <div class="form-group">
                        <label>Konfirmasi Kata Sandi</label>
                        <input class="form-control" type="password" placeholder="Masukkan Kata Sandi" />
                    </div>
                    <button class="btn btn-primary">Daftar</button>
                </form>
            </div>
        </div>
    </section>
@endsection