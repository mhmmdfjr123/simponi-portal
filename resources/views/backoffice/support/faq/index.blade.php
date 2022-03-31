@extends('layouts.backoffice')

@section('content')
    <ol class="breadcrumb page-breadcrumb">
        <!-- Auto Breadcrumbs -->
    </ol>

    <div class="page-header">
        <div class="row">
            <div class="col-md-4 text-xs-center text-md-left text-nowrap">
                <h1><i class="page-header-icon fa fa-question-circle-o"></i> {{ $pageTitle }}</h1>
            </div>

            <hr class="page-wide-block visible-xs visible-sm">

            <div class="col-xs-12 width-md-auto width-lg-auto width-xl-auto pull-md-right">
                <a href="{{ url('backoffice/support/faq/category/add') }}" class="btn btn-primary btn-block btn-load-popup" style="width: 100%;"><span class="btn-label-icon left fa fa-plus"></span>Tambah Kategori FAQ</a>
            </div>

            <!-- Spacer -->
            <div class="m-b-2 visible-xs visible-sm clearfix"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12" id="faq-container">
            <div class="loader" style="margin-top: 100px">Loading...</div>
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
                url: '{{ url('backoffice/support/faq/show') }}',
                beforeSend: function(){
                    // popUpLoader();
                },
                success: function(response){
                    // $.facebox.close();
                    $('#faq-container').html(response);
                },
                type: "get",
                dataType: "html"
            });
        }
    </script>
@endsection