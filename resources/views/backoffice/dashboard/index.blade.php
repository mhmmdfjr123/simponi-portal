@extends('layouts.backoffice')

@section('headScript')
    <script>
        requirejs.config({
            paths: { demo: '../../demo/demo' }
        });
    </script>
    <script>require(['demo']);</script>
@endsection

@section('content')
    <div class="page-header m-b-0">
        <div class="row">
            <div class="col-md-4">
                <h1><i class="page-header-icon ion-arrow-graph-up-right"></i>Portal <span class="text-muted font-weight-light">Dashboard</span></h1>
            </div>
        </div>
    </div>

    <!-- Balance -->
    <div class="page-wide-block">
        <div class="box m-b-0 valign-middle bg-white">

            <div class="box-cell col-md-7 p-a-4">
                <div>
                    <span class="font-size-18 font-weight-light">Dashboard is Under Construction</span>
                </div>
            </div>
        </div>
    </div>
    <!-- / Balance -->
@endsection

@section('footScript')

@endsection