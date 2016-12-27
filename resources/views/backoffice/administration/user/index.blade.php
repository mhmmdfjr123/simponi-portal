@extends('layouts.backoffice')

@section('content')
        <ul class="breadcrumb breadcrumb-page">
			<!-- Auto breadcrumbs -->
		</ul>
		<div class="page-header">
			
			<div class="row">
				<!-- Page header, center on small screens -->
				<h1 class="col-xs-12 col-sm-3 text-center text-left-sm"><i class="fa fa-user page-header-icon"></i>&nbsp;&nbsp;<?php echo $pageTitle?></h1>

				<div class="col-xs-12 col-sm-9">
					<div class="row">
						<hr class="visible-xs no-grid-gutter-h">
						<!-- "Create project" button, width=auto on desktops -->
						<div class="pull-right col-xs-12 col-sm-auto"><a href="<?php echo url('backoffice/administration/user/add')?>" class="btn btn-primary btn-labeled" style="width: 100%;"><span class="btn-label icon fa fa-plus"></span>Tambah Pengguna</a></div>

						<!-- Margin -->
						<div class="visible-xs clearfix form-group-margin"></div>
					</div>
				</div>
			</div>
		</div> <!-- / .page-header -->

        <div class="row">
            <div class="col-sm-12">
                <div class="panel">
					<div class="panel-heading">
						<span class="panel-title">Daftar Pengguna</span>

                        <ul class="nav nav-tabs nav-tabs-xs" id="navtab-status">
                            <li class="active" data-status="">
                                <a href="#" data-toggle="tab">Semua ({{ $countListAll }})</a>
                            </li>
                            @foreach($listStatus as $statusRow)
                                <li data-status="{{ $statusRow->status }}">
                                    <a href="#" data-toggle="tab">{{ userStatusText($statusRow->status) }} ({{ $statusRow->status_count }})</a>
                                </li>
                            @endforeach
                            <li data-status="deleted">
                                <a href="#" data-toggle="tab">Trash ({{ $countListTrash }})</a>
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

						<table class="table table-striped table-hover table-bordered" id="jq-datatable">
							<thead>
								<tr>
									<th style="width: 30px">No.</th>
									<th style="width: 200px;">Nama</th>
									<th>Username</th>
									<th>Email</th>
                                    <th style="width: 120px;">Role</th>
                                    <th style="width: 120px;">Status</th>
									<th style="width: 60px;">Aksi</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
		
		<script type="text/javascript">
            var status = '';
            var role = '';

    		init.push(function () {
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
    		            "processing": "<div style='padding-top: 6px;'>Mohon Tunggu.. Sedang memproses data..</div>"
    		        },
    		        "columns": [
                        {data: 'rownum', name: 'rownum', "searchable": false, className: "text-center", orderable: false},
						{data: 'name', name: 'name'},
                        {data: 'username', name: 'username'},
                        {data: 'email', name: 'users.email'},
                        {data: 'role', name: 'role', "searchable": false, className: "text-left", orderable: false},
                        {data: 'status', name: 'status', "searchable": false, className: "text-center", orderable: false},
                        {data: 'action', name: 'action', "searchable": false, className: "text-center", orderable: false}
    		    	]
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
