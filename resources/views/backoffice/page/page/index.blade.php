@extends('layouts.backoffice')

@section('content')
    <ol class="breadcrumb page-breadcrumb">
        <!-- Auto Breadcrumbs -->
    </ol>

    <div class="page-header">
        <div class="row">
            <div class="col-md-4 text-xs-center text-md-left text-nowrap">
                <h1><i class="page-header-icon fa fa-file"></i> {{ $pageTitle }}</h1>
            </div>

            <hr class="page-wide-block visible-xs visible-sm">

            <div class="col-xs-12 width-md-auto width-lg-auto width-xl-auto pull-md-right">
                <a href="{{ url('backoffice/pages/add') }}" class="btn btn-primary btn-block" style="width: 100%;"><span class="btn-label-icon left fa fa-plus"></span>Buat Halaman Baru</a>
            </div>

            <!-- Spacer -->
            <div class="m-b-2 visible-xs visible-sm clearfix"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title">Daftar Halaman</span>

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
                <div class="panel-body">
                    <div class="table-light table-responsive">
                        <table class="table table-striped table-hover table-bordered" id="jq-datatable">
                            <thead>
                            <tr>
                                <th style="width: 30px">No.</th>
                                <th>Judul</th>
                                <th style="width: 150px">Status</th>
                                <th style="width: 150px">Waktu Publish</th>
                                <th style="width: 80px;">Aksi</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footScript')
    <script type="text/javascript">
        require(['jquery', 'px/extensions/datatables', 'px/custom/extensions/datatables', 'px-bootstrap/tab'], function($) {
            var status = "";

            var oTable = $('#jq-datatable').DataTable( {
                "processing": true,
                "serverSide": true,
                "paginationType": "full_numbers",
                "ajax": {
                    "url": "{{ url('backoffice/pages/list-data') }}",
                    "data": function (d) {
                        d.pageStatus = status;
                    }
                },
                "language": {
                    "processing": "Mohon Tunggu.. Sedang memproses data.."
                },
                "columns": [
                    {data: 'rownum', name: 'rownum', "searchable": false, className: "text-center", orderable: false},
                    {data: 'title', name: 'title', "searchable": true, className: "text-left", orderable: false},
                    {data: 'status', name: 'status', "searchable": false, className: "text-center", orderable: false},
                    {data: 'publish_date', name: 'publish_date', "searchable": false, className: "text-center", orderable: false},
                    {data: 'action', name: 'action', "searchable": false, className: "text-center", orderable: false}
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