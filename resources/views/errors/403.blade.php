@extends('layouts.front', ['pageTitle' => 'Forbidden Access'])

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
        <h1>Forbidden...!!</h1>
        <hr class="title">
    </div>

    <div class="container slim-content-container" style="margin-bottom: 20px">
        <div class="row">
            <div class="col-md-6 text-center">
                <div style="font-size: 130px">
                    <span class="fa-stack fa-lg">
                    <i class="fa fa-hand-stop-o fa-stack-1x"></i>
                    <i class="fa fa-ban fa-stack-2x text-danger"></i>
                </span>
                </div>
            </div>
            <div class="col-md-6 content-404">
                <div style="margin-top: 50px">
                    <h3>Maaf...</h3>
                    <h4>Anda tidak mempunyai hak akses untuk halaman ini.</h4>
                    <div class="panel panel-default text-center" role="alert" style="margin-top: 30px; margin-bottom: 50px">
                        <div class="panel-body">
                            Anda dapat kembali ke <a href="{{ URL::previous() }}">halaman sebelumnya</a>

                            <div class="line-text">
                                <hr />
                                <span class="w-60">atau</span>
                            </div>

                            <a href="{{ route('home') }}" class="btn btn-primary btn-outline">Kembali ke beranda</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection