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
                    <div class="pull-right col-xs-12 col-sm-auto"><a href="{{ url('backoffice/posts/add') }}" class="btn btn-primary btn-labeled" style="width: 100%;"><span class="btn-label icon fa fa-plus"></span>Tambah Artikel</a></div>
                </div>
            </div>
        </div>
    </div> <!-- / .page-header -->

    <div class="row">
        <div class="col-sm-12">
            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title">Daftar Artikel</span>

                    <ul class="nav nav-tabs nav-tabs-xs" id="navtab-status">
                        <li class="active" data-status="">
                            <a href="#" data-toggle="tab">Semua ({{ $countListAllPage }})</a>
                        </li>
                        @foreach($listStatus as $statusRow)
                            <li data-status="{{ $statusRow->status }}">
                                <a href="#" data-toggle="tab">{{ pageStatusText($statusRow->status) }} ({{ $statusRow->status_count }})</a>
                            </li>
                        @endforeach
                        <li data-status="deleted">
                            <a href="#" data-toggle="tab">Trash ({{ $countListTrashPage }})</a>
                        </li>
                    </ul>
                </div>
                <div class="panel-body table-responsive">
                    <table class="table table-striped table-hover table-bordered" id="jq-datatable">
                        <thead>
                        <tr>
                            <th style="width: 30px">No.</th>
                            <th>Judul</th>
                            <th style="width: 150px">Tgl Buat</th>
                            <th style="width: 100px">Status</th>
                            <th style="width: 60px;">Aksi</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        init.push(function () {
            var status = "";

            var oTable = $('#jq-datatable').DataTable( {
                "processing": true,
                "serverSide": true,
                "paginationType": "full_numbers",
                "ajax": {
                    "url": "<?php echo url('backoffice/posts/ajax-list')?>",
                    "data": function (d) {
                        d.pageStatus = status;
                    }
                },
                "language": {
                    "processing": "<div style='padding-top: 6px;'>Mohon Tunggu.. Sedang memproses data..</div>"
                },
                "columns": [
                    {"searchable": false, className: "text-center", orderable: false},
                    {"searchable": true, className: "text-left", orderable: false},
                    {"searchable": false, className: "text-center", orderable: false},
                    {"searchable": false, className: "text-center", orderable: false},
                    {"searchable": false, className: "text-center", orderable: false}
                ]
            });

            $('#jq-datatable_wrapper .dataTables_filter input').attr('placeholder', 'Pencarian...');

            $('#navtab-status li a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                // e.target // newly activated tab
                // e.relatedTarget // previous active tab
                status = $(this).parent().data('status');
                oTable.draw();
            });
        });
    </script>
@endsection