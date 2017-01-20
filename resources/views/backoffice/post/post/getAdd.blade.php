@extends('template.backoffice')

@section('content')
    <ul class="breadcrumb breadcrumb-page">
        <!-- Auto Breadcrumbs -->
    </ul>

    <div class="page-header">
        <div class="row">
            <!-- Page header, center on small screens -->
            <h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa fa-file-text page-header-icon"></i>&nbsp;&nbsp;{{ $pageTitle }}</h1>

            <div class="col-xs-12 col-sm-8">
                <div class="row">
                    <hr class="visible-xs no-grid-gutter-h" />
                    <!-- <div class="pull-right col-xs-12 col-sm-auto"><a href="#" class="btn btn-default btn-labeled" style="width: 100%;"><span class="btn-label icon fa fa-eye"></span>Lihat Preview</a></div> -->
                </div>
            </div>
        </div>
    </div> <!-- / .page-header -->

    <form action="{{ url('backoffice/posts/submit') }}" method="post" class="" id="validate">
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <input type="text" name="title" maxlength="250" onkeyup="setAlias(this);" onblur="setAlias(this);" class="form-control required input-lg" placeholder="Judul Halaman" />
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            </div>
            <div class="form-group">
                <strong>URL Halaman:</strong> {{ url('post') }}/<span id="alias-text" style="background: #FFFBCC"></span>
                <input type="text" name="alias" maxlength="300" placeholder="Alias" id="alias" onkeyup="setAlias(this);" onblur="setAlias(this);" class="form-control required" />
            </div>

            <div class="form-group">
                <textarea class="form-control tinymce" name="content" rows="10"></textarea>
            </div>

            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title">SEO Metadata</span>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="control-label">Kata Kunci</label>
                        <input type="text" name="meta_key" maxlength="100" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label class="control-label">Deskripsi</label>
                        <textarea name="meta_desc" rows="5" maxlength="300" class="form-control required"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title">Publikasi</span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="control-label">Publish</label>
                            <div><input type="checkbox" name="status" id="switcher-status" value="P" checked="checked" /></div>
                        </div>
                        <div class="form-group col-md-8">
                            <label class="control-label">Waktu Publish</label>
                            <input type="text" name="publish_date_start" id="publish-date-start" placeholder="Tanggal" value="{{ date('d-m-Y') }}" class="form-control" />
                            <input type="text" name="publish_time_start" id="publish-time-start" placeholder="Jam" class="form-control" />
                        </div>
                    </div>

                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-primary btn-labeled" id="btn-save" data-loading-text="Loading..."><span class="btn-label icon fa fa-floppy-o"></span>Simpan</button>
                    <a href="{{ url('backoffice/posts') }}" class="btn btn-default pull-right">Kembali</a>
                </div>
            </div>

            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title">Kategori</span>
                </div>
                <div class="panel-body">
                    @foreach($listCategory as $category)
                        <div class="checkbox">
                            <label style="margin-left: <?php echo (($category['level']-1)*20).'px' ?>;">
                                <input type="checkbox" name="categories[]" value="{{ $category['data']->id }}" /> {{ $category['data']->name }}
                            </label>
                        </div>
                    @endforeach

                    @if(count($listCategory) == 0)
                    Anda belum memiliki kategori artikel. <a href="{{ url('backoffice/post/category') }}">Klik disini</a> untuk menambah kategori baru
                    @endif
                </div>
            </div>
        </div>
    </div>
    </form>
@endsection

@section('jsscript')
    <script src="{{ asset('theme/backoffice/js/plugins/tinymce/tinymce.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        tinymce.init(<?php echo json_encode(config('content.tinymce')) ?>);

        function setAlias(obj){
            var text = $(obj).val().toLowerCase().replace(/([^0-9^A-z])/gi, '-');
            $("#alias").val(text);
            $("#alias-text").text(text);
        }

        init.push(function () {
            $('#switcher-status').switcher({
                theme: 'square',
                on_state_content: '<span class="fa fa-check"></span>',
                off_state_content: '<span class="fa fa-times"></span>'
            });

            $("#select2-parent").select2({
                allowClear: true,
                placeholder: "Pilih parent"
            });

            $('#publish-date-start').datepicker({
                format: "dd-mm-yyyy",
                language: "id",
                autoclose: true
            });

            $('#publish-time-start').timepicker({
                minuteStep: 1,
                showSeconds: true,
                showMeridian: false,
                showInputs: false
            });
        })
    </script>
@endsection