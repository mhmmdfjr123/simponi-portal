@extends('layouts.front', ['pageTitle' => 'Page not found...'])

@section('headScript')
    <style>
        .illustration {
            max-width: 380px; width: 100%; margin-bottom: 40px
        }

        @media (max-width: 992px) {
            .content-404 {
                text-align: center;
            }
        }
    </style>
@endsection

@section('content')
    <div class="content-header">
        <h1>Oopps...!!</h1>
        <hr class="title">
    </div>

    <div class="container slim-content-container" style="margin-bottom: 20px">
        <div class="row">
            <div class="col-md-6 text-center">
                <img src="{{ asset('theme/front/images/dont-cry-staff.png') }}" class="illustration">
            </div>
            <div class="col-md-6 content-404">
                <div style="margin-top: 50px">
                    <h3>Maaf...</h3>
                    <h4>Kami tidak dapat menemukan halaman yang anda cari.</h4>
                    <div class="alert alert-warning text-left" role="alert" style="margin-top: 30px; margin-bottom: 50px">
                        Ini dapat disebabkan oleh:
                        <ul style="margin-bottom: 10px">
                            <li>Link yang anda akses salah</li>
                            <li>Link yang anda akses sudah tidak berlaku / dihapus</li>
                        </ul>

                        Anda dapat kembali ke <a href="{{ URL::previous() }}">halaman sebelumnya</a>
                    </div>

                    <a href="{{ route('home') }}" class="btn btn-primary btn-outline">Kembali ke beranda</a>
                </div>
            </div>
        </div>
    </div>
@endsection