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
                <a href="{{ url('backoffice/layout/banner/add') }}" class="btn btn-primary btn-block" style="width: 100%;"><span class="btn-label-icon left fa fa-plus"></span>Tambah Banner</a>
            </div>

            <!-- Spacer -->
            <div class="m-b-2 visible-xs visible-sm clearfix"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">

            <div class="panel panel-faq">
                <div class="panel-heading">
                    <span class="panel-title">Daftar Banner</span>
                </div>
                <div class="panel-body" id="banner-container">
                    @if(count($banners) > 0)
                        @foreach($banners as $banner)
                            <div class="faq-list-item" data-id="{{ $banner->id }}">
                                {!! pageStatusTextWithStyle($banner->status, $banner->publish_date_start, $banner->publish_date_end) !!}
                                {{ $banner->name }}

                                <div class="pull-right">
                                    <a href="{{ url('backoffice/layout/banner/'.$banner->id.'/edit') }}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> Ubah</a>
                                    <a href="javascript:void(0)" onclick="confirmDirectPopUp('{{ url('backoffice/layout/banner/'.$banner->id.'/delete') }}', 'Hapus Banner', 'Anda yakin akan menghapus item ini?', 'Hapus', 'Batal')" class="btn btn-xs btn-default"><i class="fa fa-close"></i> Hapus</a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center ignore-dragging">
                            Belum ada banner.<br>
                            Silahkan <a href="{{ url('backoffice/layout/banner/add') }}" class="btn btn-xs btn-success"><i class="fa fa-plus"></i>  Tambah Banner</a>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection

@section('footScript')
    <script type="text/javascript">
        require(['jquery', 'px-libs/Sortable', 'px-libs/toastr', 'px-libs/jquery.facebox'], function($, Sortable, toastr) {
            var container = document.getElementById('banner-container');
            var csrfToken = '{{ csrf_token() }}';

            Sortable.create(container, {
                group: 'banner',
                animation: 150,
                ghostClass: 'faq-zone-target',
                filter: ".ignore-dragging",
                onAdd: function (evt) {
                    onItemChanged(evt);
                },
                onUpdate: function (evt) {
                    onItemChanged(evt);
                },
            });

            function onItemChanged(evt) {
                var bannerID = [];

                [].forEach.call(evt.to.children, function (el){
                    if($(el).data('id'))
                        bannerID.push($(el).data('id'));
                });
                reOrdering('{{ url('backoffice/layout/banner/re-order') }}', bannerID);
            }

            function reOrdering(url, items) {
                var requestBody = {
                    '_token' : csrfToken,
                    'items'  : items
                };

                $.ajax({
                    url: url,
                    data: requestBody,
                    beforeSend: function(){
                        popUpLoader();
                    },
                    success: function(response){
                        if(response.status == 'ok'){
                            toastr.success(response.message, 'Sukses.');
                        }else{
                            toastr.error(response.message, 'Oppss.');
                        }

                        jQuery.facebox.close();
                    },
                    type: "post",
                    dataType: "json"
                });
            }
        });
    </script>
@endsection