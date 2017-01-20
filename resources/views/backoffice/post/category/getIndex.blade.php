@extends('template.backoffice')

@section('content')
    <ul class="breadcrumb breadcrumb-page">
        <!-- Auto Breadcrumbs -->
    </ul>

    <div class="page-header">
        <div class="row">
            <!-- Page header, center on small screens -->
            <h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa fa-align-left page-header-icon"></i>&nbsp;&nbsp;{{ $pageTitle }}</h1>

            <div class="col-xs-12 col-sm-8">
                <div class="row">
                    <hr class="visible-xs no-grid-gutter-h" />
                    <!-- "Create project" button, width=auto on desktops -->
                    <div class="pull-right col-xs-12 col-sm-auto"><a href="{{ url('backoffice/post/category/add') }}" class="btn btn-primary btn-labeled btn-load-popup" style="width: 100%;"><span class="btn-label icon fa fa-plus"></span> Tambah Kategori Artikel</a></div>

                </div>
            </div>
        </div>
    </div> <!-- / .page-header -->

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

@section('jsscript')
    <script type="text/javascript">
        $(document).ready(function () {
            loadList();
        });

        function loadList(){
            $.ajax({
                url: '{{ url('backoffice/post/category/ajax-list') }}',
                beforeSend: function(){
                    //popUpLoader();
                },
                success: function(response){
                    //$.facebox.close();
                    $('#categories-container').html(response);
                },
                type:"get",
                dataType:"html"
            });
        }
    </script>
@endsection