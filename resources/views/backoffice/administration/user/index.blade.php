@extends('layouts.backoffice')

@section('content')
    <ol class="breadcrumb page-breadcrumb">
        <!-- Auto Breadcrumbs -->
        <li class="active"><a href="#">Daftar Pengguna</a></li>
    </ol>

    <div class="page-header">
        <div class="row">
            <div class="col-md-4 text-xs-center text-md-left text-nowrap">
                <h1><i class="page-header-icon fa fa-user"></i> {{ $pageTitle }}</h1>
            </div>

            <hr class="page-wide-block visible-xs visible-sm">

            <div class="col-xs-12 width-md-auto width-lg-auto width-xl-auto pull-md-right">
                <a href="{{ url('backoffice/administration/user/add') }}" class="btn btn-primary btn-block" style="width: 100%;"><span class="btn-label-icon left fa fa-plus"></span>Tambah Pengguna</a>
            </div>

            <!-- Spacer -->
            <div class="m-b-2 visible-xs visible-sm clearfix"></div>
        </div>
    </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="panel">
					<div class="panel-heading">
						<span class="panel-title">Daftar Pengguna</span>

                        <ul class="nav nav-tabs nav-tabs-xs" id="navtab-status">
                            <li class="active" data-status="">
                                <a href="#all" data-toggle="tab">Semua ({{ $countListAll }})</a>
                            </li>
                            @foreach($listStatus as $statusRow)
                                <li data-status="{{ $statusRow->status }}">
                                    <a href="#status-{{$statusRow->status}}" data-toggle="tab">{{ userStatusText($statusRow->status) }} ({{ $statusRow->status_count }})</a>
                                </li>
                            @endforeach
                            <li data-status="deleted">
                                <a href="#trash" data-toggle="tab">Trash ({{ $countListTrash }})</a>
                            </li>
                        </ul>
					</div>
					<div class="panel-body table-responsive">
                        <!-- Filter -->
                        <form action="" class="form-inline" style="margin-bottom: 30px">
                            <div class="form-group">
                                <label for="filter-by-role">Filter: </label>
                                <select class="form-control" id="filter-by-role">
                                    <option value="">- Semua Role -</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                    <option value="none">- Tidak memiliki Role -</option>
                                </select>
                            </div>

                            <div class="form-group input-group no-margin">
                                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                <input type="text" id="search-user" placeholder="Cari.. nama / username / email" class="form-control" style="width: 250px" />
                            </div>
                        </form>
                        <!-- ./filter -->

                        <div class="table-light">
                            <table class="table table-striped table-hover table-bordered" id="jq-datatable">
                                <thead>
                                <tr>
                                    <th style="width: 30px">No.</th>
                                    <th style="width: 200px;">Nama</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th style="width: 120px;">Role</th>
                                    <th style="width: 120px;">Status</th>
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
        var status = '';
        var role = '';

        require(['jquery', 'px/extensions/datatables', 'px-bootstrap/tab'], function($) {
            resetAllFilter();

            var oTable = $('#jq-datatable').DataTable({
                "processing": true,
                "serverSide": true,
                "paginationType": "full_numbers",
                "ajax": {
                    "url": "<?php echo url('backoffice/administration/user/list-data')?>",
                    "data": function (d) {
                        d.userStatus = status;
                        d.userRole = role;
                    }
                },
                "language": {
                    "processing": "Mohon Tunggu.."
                },
                "columns": [
                    {data: 'rownum', name: 'rownum', "searchable": false, className: "text-center", orderable: false},
                    {data: 'name', name: 'name'},
                    {data: 'username', name: 'username'},
                    {data: 'email', name: 'users.email'},
                    {data: 'role', name: 'role', "searchable": false, className: "text-left", orderable: false},
                    {data: 'status', name: 'status', "searchable": false, className: "text-center", orderable: false},
                    {data: 'action', name: 'action', "searchable": false, className: "text-center", orderable: false}
                ],
                "order": [[ 1, "asc" ]]
            } );

            $('#jq-datatable_wrapper .dataTables_filter input').hide();

            $('#search-user').on('keyup', function (){
                oTable.search($(this).val()).draw();
            });

            $('#filter-by-role').on('change', function (){
                role = $(this).val();
                oTable.draw();
            });


            $('#navtab-status li a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                status = $(this).parent().data('status');
                oTable.draw();
            });
        });

        function resetAllFilter(){
            $('#filter-by-role').val('');
            $('#search-user').val('');
        }
    </script>
@endsection
