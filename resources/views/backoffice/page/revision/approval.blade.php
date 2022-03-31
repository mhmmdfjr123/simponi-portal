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

            <!-- Spacer -->
            <div class="m-b-2 visible-xs visible-sm clearfix"></div>
        </div>
    </div>

    <div class="alert alert-warning">
        <h4 class="alert-heading">Informasi</h4>
        <p>Berikut adalah daftar halaman yang dibuat oleh pengguna (Bukan Super Administrator) untuk diverifikasi sebelum di publish</p>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title">Daftar Persetujuan Revisi Halaman</span>
                </div>
                <div class="panel-body">
                    <div class="table-light table-responsive">
                        <table class="table table-striped table-hover table-bordered" id="jq-datatable">
                            <thead>
                            <tr>
                                <th style="width: 30px">No.</th>
                                <th>Judul</th>
                                <th style="width: 200px">Dibuat Oleh</th>
                                <th style="width: 150px">Dibuat Pada</th>
                                <th style="width: 90px;">Aksi</th>
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
        require(['jquery', 'px/extensions/datatables', 'px-bootstrap/tab'], function($) {
            var oTable = $('#jq-datatable').DataTable( {
                "processing": true,
                "serverSide": true,
                "paginationType": "full_numbers",
                "ajax": {
                    "url": "{{ route('backoffice.page.revision.approval-list') }}"
                },
                "language": {
                    "processing": "Mohon Tunggu.."
                },
                "columns": [
                    {data: 'rownum', name: 'rownum', "searchable": false, className: "text-center", orderable: false},
                    {data: 'title', name: 'title', "searchable": true, className: "text-left", orderable: false},
                    {data: 'created_by', name: 'created_by', "searchable": false, className: "text-center", orderable: false},
                    {data: 'created_at', name: 'created_at', "searchable": false, className: "text-center", orderable: false},
                    {data: 'action', name: 'action', "searchable": false, className: "text-center", orderable: false}
                ]
            });

            $('#jq-datatable_wrapper .dataTables_filter input').attr('placeholder', 'Pencarian...');
        });
    </script>
@endsection