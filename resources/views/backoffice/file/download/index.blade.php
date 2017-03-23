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
                <a href="{{ url('backoffice/file/download/add') }}" class="btn btn-primary btn-block" style="width: 100%;"><span class="btn-label-icon left fa fa-plus"></span>Tambah File</a>
            </div>

            <!-- Spacer -->
            <div class="m-b-2 visible-xs visible-sm clearfix"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title">Daftar File Download</span>
                </div>
                <div class="panel-body">
                    <div class="form-group" style="width: 50%; margin-bottom: 50px">
                        <label class="control-label">Filter Kategori</label>
                        <select name="download_category_id" class="form-control required" id="filter-category">
                            <option value="">- Tampilkan Semua Kategori -</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }} {!! $category->status != 'Y' ? '(Tidak Aktif)' : '' !!}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="table-light table-responsive">
                        <table class="table table-striped table-hover table-bordered" id="jq-datatable">
                            <thead>
                            <tr>
                                <th style="width: 30px">No.</th>
                                <th>Judul</th>
                                <th style="width: 200px">Kategori</th>
                                <th style="width: 150px">Tgl Buat</th>
                                <th style="width: 110px">Status</th>
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
            var categoryId = "";

            var oTable = $('#jq-datatable').DataTable( {
                "processing": true,
                "serverSide": true,
                "paginationType": "full_numbers",
                "ajax": {
                    "url": "{{ url('backoffice/file/download/list-data') }}",
                    "data": function (d) {
                        d.categoryId = categoryId;
                    }
                },
                "language": {
                    "processing": "Mohon Tunggu.. Sedang memproses data.."
                },
                "order": [[ 3, "desc" ]],
                "columns": [
                    {data: 'rownum', name: 'rownum', "searchable": false, className: "text-center", orderable: false},
                    {data: 'name', name: 'name', "searchable": true, className: "text-left", orderable: true},
                    {data: 'category.name', name: 'category', "searchable": false, className: "text-left", orderable: false},
                    {data: 'created_date', name: 'created_at', "searchable": false, className: "text-center", orderable: true},
                    {data: 'status', name: 'status', "searchable": false, className: "text-center", orderable: false},
                    {data: 'action', name: 'action', "searchable": false, className: "text-center", orderable: false}
                ]
            });

            $('#jq-datatable_wrapper .dataTables_filter input').attr('placeholder', 'Pencarian...');

            $('#filter-category').on('change', function (e) {
                categoryId = $(this).val();
                oTable.draw();
            });
        });
    </script>
@endsection