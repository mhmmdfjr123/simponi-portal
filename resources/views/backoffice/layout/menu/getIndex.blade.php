@extends('template.backoffice')

@section('headscript')
    <link rel="stylesheet" type="text/css" href="<?php echo asset('theme/backoffice/js/plugins/nestable/jquery.nestable.min.css')?>" />
@endsection

@section('content')
    <ul class="breadcrumb breadcrumb-page">
        <!-- Auto Breadcrumbs -->
    </ul>

    <div class="page-header">
        <div class="row">
            <!-- Page header, center on small screens -->
            <h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa fa-sort-amount-asc page-header-icon"></i>&nbsp;&nbsp;{{ $pageTitle }}</h1>

            <div class="col-xs-12 col-sm-8">
                <div class="row">
                    <hr class="visible-xs no-grid-gutter-h" />
                    <!-- Add Menu Category
                    <div class="pull-right col-xs-12 col-sm-auto"><a href="{{ url('backoffice/layout/menu/add-cat') }}" class="btn btn-primary btn-labeled btn-load-popup" style="width: 100%;"><span class="btn-label icon fa fa-plus"></span> Tambah Kategori Menu</a></div>
                    -->
                </div>
            </div>
        </div>
    </div> <!-- / .page-header -->

    <div class="row">
        <div class="col-md-3" style="margin-bottom: 10px;">
            <a href="javascript:void(0)" onclick="loadToMenuForm('URL')" title="Tambah Menu" class="btn btn-md btn-block btn-default btn-labeled"><i class="btn-label icon fa fa-plus-square"></i> Tambah Menu Hyperlink</a>
            <a href="javascript:void(0)" onclick="loadToMenuForm('PA')" title="Tambah Menu" class="btn btn-md btn-block btn-default btn-labeled"><i class="btn-label icon fa fa-plus-square"></i> Tambah Menu Halaman</a>
            <a href="javascript:void(0)" onclick="loadToMenuForm('PO')" title="Tambah Menu" class="btn btn-md btn-block btn-default btn-labeled"><i class="btn-label icon fa fa-plus-square"></i> Tambah Menu Kategori</a>
            <a href="javascript:void(0)" onclick="loadToMenuForm('S')" title="Tambah Menu" class="btn btn-md btn-block btn-default btn-labeled"><i class="btn-label icon fa fa-plus-square"></i> Tambah Menu Spesial</a>
        </div>
        <div class="col-md-9">
            <!-- Tabs -->
            <ul class="nav nav-tabs bs-tabdrop-menu-builder">
                @foreach($listMenuCategory as $mcNav)
                    <li id="mm-navtab-{{ $mcNav->id }}" data-id="{{ $mcNav->id }}"><a href="#bs-tabdrop-tab-{{ $mcNav->id }}" data-toggle="tab">{{ $mcNav->name }}</a></li>
                @endforeach
            </ul>
            <div class="tab-content tab-content-bordered" id="bs-content-menu-builder">
                @foreach($listMenuCategory as $mcNav)
                    <div class="tab-pane" id="bs-tabdrop-tab-{{ $mcNav->id }}">
                        <a href="javascript:void(0)" onclick="loadIntoBox('{{ url('backoffice/layout/menu/edit-cat/'.$mcNav->id) }}')" title="Ubah" class="btn btn-xs btn-default btn-labeled"><i class="btn-label icon fa fa-edit"></i> Ubah</a>
                        @if($mcNav->id > 0)
                            <a href="javascript:void(0)" onclick="confirmDirectPopUp('{{ url('backoffice/layout/menu/delete-cat/'.$mcNav->id) }}', 'Konfirmasi', 'Apakah anda yakin ingin menghapus?', 'Ya, Hapus Data', 'Tidak');" title="Hapus" class="btn btn-xs btn-default btn-labeled"><i class="btn-label icon fa fa-trash"></i> Hapus</a>
                        @endif

                        <p>
                            <div class="well well-sm" id="mc-desc-{{ $mcNav->id }}">{{ $mcNav->desc }}</div>
                        </p>

                        <div id="list-menu-container-{{ $mcNav->id }}"></div>
                    </div>
                @endforeach
            </div>

            <div class="note note-info" style="margin-top: 30px">
                <h4 class="note-title">
                    <i class="fa fa-info-circle"></i> Informasi
                </h4>
                Menu dapat di 'Drag &amp; Drop' untuk mengganti urutan.
            </div>
        </div>
    </div>


@endsection

@section('jsscript')
    <script src="{{ asset('theme/backoffice/js/plugins/nestable/jquery.nestable.min.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        init.push(function () {
            menuTabEvent('ul.bs-tabdrop-menu-builder li a[data-toggle="tab"]');

            $('ul.bs-tabdrop-menu-builder a:first').tab('show');
            $('ul.bs-tabdrop-menu-builder').tabdrop();
        });

        function menuTabEvent(selector){
            $(selector).on('shown.bs.tab', function (e) {
                // e.target // newly activated tab
                // e.relatedTarget // previous active tab
                loadListMenu();
            });
        }

        function deleteMenu(){
            $.ajax({
                url: '{{ url('backoffice/layout/menu/delete') }}',
                data: {
                    'id': $(this).data('id')
                },
                beforeSend: function(){
                    jQuery.facebox('<div class="loader">Loading...</div>');
                },
                success: function(response, statusText, xhr, $form){
                    if (statusText == "success") {
                        if(response.status == 'ok'){
                            $.growl.notice({ message: response.message });
                        }else{
                            $.growl.error({ message: response.message });
                        }

                        loadListMenu();
                        jQuery.facebox.close();
                    } else {
                        alertError();
                    }
                },
                type:"get",
                dataType:"json"
            });
        }

        function loadListMenu(){
            var catId = $('.bs-tabdrop-menu-builder li.active').data('id');
            var div = '#list-menu-container-' + catId;

            $.ajax({
                url: '{{ url('backoffice/layout/menu/list-menu') }}',
                data: {
                    'menu_category_id': catId
                },
                beforeSend: function(){
                    jQuery(div).html('<div class="loader">Loading...</div>');
                },
                success: function(response){
                    jQuery(div).html(response);
                },
                type:"get",
                dataType:"html"
            });
        }

        function loadListMenuCat(state, data){
            if(state == 'add'){
                var obj = $('.bs-tabdrop-menu-builder').append('<li id="mm-navtab-'+data.id+'" data-id="'+data.id+'"><a href="#bs-tabdrop-tab-'+data.id+'" data-toggle="tab">'+data.name+'</a></li>');

                var content = '<div class="tab-pane" id="bs-tabdrop-tab-'+data.id+'">' +
                        '<a href="javascript:void(0)" onclick="loadIntoBox(\''+data.url_edit+'\')" title="Ubah" class="btn btn-xs btn-default btn-labeled"><i class="btn-label icon fa fa-edit"></i> Ubah</a> ' +
                        '<a href="javascript:void(0)" onclick="confirmDirectPopUp(\''+data.url_delete+'\', \'Konfirmasi\', \'Apakah anda yakin ingin menghapus?\', \'Ya, Hapus Data\', \'Tidak\');" title="Hapus" class="btn btn-xs btn-default btn-labeled"><i class="btn-label icon fa fa-trash"></i> Hapus</a>' +
                        '<p><div class="well well-sm" id="mc-desc-'+data.id+'">'+data.desc+'</div></p>' +
                        '<div id="list-menu-container-'+data.id+'"></div>' +
                        '</div>';

                $('#bs-content-menu-builder').append(content);

                menuTabEvent(obj);
            }else{
                $('#mm-navtab-'+data.id+' a').text(data.name);
                $('#mc-desc-'+data.id).text(data.desc);
            }

            $('ul.bs-tabdrop-menu-builder').tabdrop();
        }

        function loadToMenuForm(type){
            $.ajax({
                url: '{{ url('backoffice/layout/menu/add') }}',
                data: {
                    'menu_category_id': $('.bs-tabdrop-menu-builder li.active').data('id'),
                    'menu_type': type
                },
                beforeSend: function(){
                    jQuery.facebox('<div class="loader">Loading...</div>');
                },
                success: function(response){
                    jQuery.facebox(response);
                },
                type:"get",
                dataType:"html"
            });

            return false;
        }
    </script>
@endsection