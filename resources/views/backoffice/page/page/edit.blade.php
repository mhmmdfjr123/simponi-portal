@extends('layouts.backoffice')

@section('content')
    <ol class="breadcrumb page-breadcrumb">
        <!-- Auto Breadcrumbs -->
        <li class="active" data-active-menu="#menu-page"><a href="#">Ubah Halaman</a></li>
    </ol>

    <div class="page-header">
        <div class="row">
            <div class="col-md-4 text-xs-center text-md-left text-nowrap">
                <h1><i class="page-header-icon fa fa-file"></i> {{ $pageTitle }}</h1>
            </div>

            <div class="col-xs-12 width-md-auto width-lg-auto width-xl-auto pull-md-right">
                <a href="{{ url('backoffice/pages') }}" class="btn btn-primary btn-block" style="width: 100%;"><span class="btn-label-icon left fa fa-arrow-left"></span>Kembali</a>
            </div>

            <!-- Spacer -->
            <div class="m-b-2 visible-xs visible-sm clearfix"></div>
        </div>
    </div>

    <form action="{{ url('backoffice/pages/submit') }}" method="post" class="validate">
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <input type="text" name="title" maxlength="250" value="{{ $obj->title }}" class="form-control required input-lg" placeholder="Judul Halaman" />
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input type="hidden" name="id" value="{{ $obj->id }}" />
            </div>
            <div class="form-group">
                <strong>URL Halaman:</strong> {{ url('/') }}/<span id="alias-text">{{ $obj->alias }}</span>
                <input type="text" name="alias" maxlength="300" value="{{ $obj->alias }}" placeholder="Alias" id="alias" onkeyup="setAlias(this);" onblur="setAlias(this);" class="form-control required" />
                <input type="hidden" name="alias_old" value="{{ $obj->alias }}" />
            </div>

            <div class="form-group">
                <textarea class="form-control tinymce" name="content" rows="10">{{ $obj->content }}</textarea>
            </div>

            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title">SEO Metadata</span>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="control-label">Kata Kunci</label>
                        <input type="text" name="meta_key" value="{{ $obj->meta_key }}" maxlength="100" class="form-control" data-role="tagsinput" />
                    </div>
                    <div class="form-group">
                        <label class="control-label">Deskripsi</label>
                        <textarea name="meta_desc" rows="5" maxlength="300" class="form-control">{{ $obj->meta_desc }}</textarea>
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
                            <div style="margin-top: 10px">
                                <label for="switcher-success" class="switcher switcher-success">
                                    <input id="switcher-success" <?php if($obj->status == 'P')echo 'checked="checked"' ?> type="checkbox" name="status" value="P">
                                    <div class="switcher-indicator">
                                        <div class="switcher-yes">YES</div>
                                        <div class="switcher-no">NO</div>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="form-group col-md-8">
                            <label class="control-label">Waktu Publish</label>
                            <input type="text" name="publish_date_start" id="publish-date-start" placeholder="Tanggal" value="{{ date('d-m-Y', strtotime($obj->publish_date_start)) }}" class="form-control" />
                            <input type="text" name="publish_time_start" id="publish-time-start" placeholder="Jam" value="{{ date('H:i:s', strtotime($obj->publish_date_start)) }}" class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-primary btn-labeled btn-save" data-loading-text="Loading..."><span class="btn-label-icon left fa fa-floppy-o"></span>Simpan</button>
                    <a href="{{ url('backoffice/pages/'.$obj->id.'/edit') }}" class="btn btn-default pull-right">Batal</a>
                </div>
            </div>

            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title">Atribut</span>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="control-label">Urutan</label>
                        <input type="text" name="order" maxlength="3" value="{{ $obj->order }}" class="form-control required number" />
                    </div>
                    <div class="form-group">
                        <label class="control-label">Parent</label>
                        <select name="parent" id="select2-parent" class="form-control">
                            <option value="" <?php if($obj->parent == '')echo 'selected="selected"' ?>>- Tidak ada Parent -</option>
                            @foreach($listParent as $parent)
                                <option value="{{ $parent->id }}" <?php if($obj->parent == $parent->id)echo 'selected="selected"' ?>>{{ $parent->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
@endsection

@section('footScript')
    <script src="{{ asset('theme/backoffice/ext/vendor/tinymce/tinymce.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        require(['jquery', 'px/extensions/bootstrap-datepicker', 'px/extensions/bootstrap-timepicker',
            'px-libs/select2.full', 'px/extensions/bootstrap-tagsinput', 'px/plugins/px-validate'], function($) {

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

            tinymce.init(<?php echo json_encode(config('content.tinymce')) ?>);
        });

        function setAlias(obj){
            var text = $(obj).val().toLowerCase().replace(/([^0-9^A-z])/gi, '-');
            $("#alias").val(text);
            $("#alias-text").text(text);
        }
    </script>
@endsection