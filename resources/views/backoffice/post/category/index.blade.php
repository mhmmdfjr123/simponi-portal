@extends('layouts.backoffice')

@section('content')
    <ol class="breadcrumb page-breadcrumb">
        <!-- Auto Breadcrumbs -->
    </ol>

    <div class="page-header">
        <div class="row">
            <div class="col-md-4 text-xs-center text-md-left text-nowrap">
                <h1><i class="page-header-icon fa fa-align-left"></i> {{ $pageTitle }}</h1>
            </div>

            <hr class="page-wide-block visible-xs visible-sm">

            <div class="col-xs-12 width-md-auto width-lg-auto width-xl-auto pull-md-right">
                <a href="{{ url('backoffice/post/category/add') }}" class="btn btn-primary btn-block btn-load-popup" style="width: 100%;"><span class="btn-label-icon left fa fa-plus"></span>Buat Kategori Baru</a>
            </div>

            <!-- Spacer -->
            <div class="m-b-2 visible-xs visible-sm clearfix"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title">Daftar Kategori</span>
                </div>
                <div class="panel-body table-responsive" id="categories-container">
                    <div class="loader">Loading...</div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footScript')
    <script type="text/javascript">
        require(['jquery'], function($) {
            loadList();
        });

        function loadList(){
            $.ajax({
                url: '{{ url('backoffice/post/category/list-data') }}',
                beforeSend: function(){
                    //popUpLoader();
                },
                success: function(response){
                    //$.facebox.close();
                    $('#categories-container').html(response);
                },
                type: "get",
                dataType: "html"
            });
        }
    </script>
@endsection