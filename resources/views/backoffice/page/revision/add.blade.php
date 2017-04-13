@extends('layouts.backoffice')

@section('content')
    <ol class="breadcrumb page-breadcrumb">
        <!-- Auto Breadcrumbs -->
        <li class="active" data-active-menu="#menu-page-new"><a href="#">Tambah Halaman</a></li>
    </ol>

    <div class="page-header">
        <div class="row">
            <div class="col-md-4 text-xs-center text-md-left text-nowrap">
                <h1><i class="page-header-icon fa fa-file"></i> {{ $pageTitle }}</h1>
            </div>

            <!-- Spacer -->
            <div class="m-b-2 visible-xs visible-sm clearfix"></div>
        </div>
    </div>

    <form action="{{ route('backoffice.page.revision.submit') }}" method="post" class="validate">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <input type="text" name="title" maxlength="250" onkeyup="setAlias(this);" onblur="setAlias(this);" class="form-control required input-lg" placeholder="Judul Halaman" />
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                </div>
                <div class="form-group">
                    <strong>URL Halaman:</strong> {{ url('/') }}/<span id="alias-text"></span>
                    <input type="text" name="alias" maxlength="300" placeholder="Alias" id="alias" onkeyup="setAlias(this);" onblur="setAlias(this);" class="form-control required" />
                </div>

                <div class="form-group">
                    <textarea class="form-control tinymce" name="content" id="summernote" rows="10"></textarea>
                </div>

                <div class="panel">
                    <div class="panel-heading">
                        <span class="panel-title">SEO Metadata</span>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="control-label">Kata Kunci</label>
                            <input type="text" name="meta_key" maxlength="100" class="form-control" data-role="tagsinput" />
                            <p class="help-block">(Dipisahkan oleh koma, contoh: keyword1, keyword2, keyword3)</p>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Deskripsi</label>
                            <textarea name="meta_desc" rows="5" maxlength="300" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <span class="panel-title">Approval</span>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="control-label">Alasan Pembuatan Halaman Baru:</label>
                            <textarea class="form-control required" name="reason" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Status</label>
                            <div class="radio">
                                <label>
                                    <input name="status" value="{{ config('enums.page_revision.status.pending') }}" checked type="radio"> Publish
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input name="status" value="{{ config('enums.page_revision.status.draft') }}" type="radio"> Draft
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-primary btn-labeled btn-save" data-loading-text="Loading..."><span class="btn-label-icon left fa fa-floppy-o"></span> Submit</button>
                        <a href="{{ url('backoffice/pages') }}" class="btn btn-default pull-right">Batal</a>
                    </div>
                </div>

                <div class="panel">
                    <div class="panel-heading">
                        <span class="panel-title">Publikasi</span>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="control-label">Waktu Publish</label>
                            <input type="text" name="publish_date_start" id="publish-date-start" placeholder="Tanggal" value="{{ date('d-m-Y') }}" class="form-control" />
                            <input type="text" name="publish_time_start" id="publish-time-start" placeholder="Jam" class="form-control" />
                        </div>
                    </div>
                </div>

                <div class="panel">
                    <div class="panel-heading">
                        <span class="panel-title">Atribut</span>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="control-label">Urutan</label>
                            <input type="text" name="order" maxlength="3" value="{{ $nextSequenceOrder }}" class="form-control required number" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Parent</label>
                            <select name="parent" id="select2-parent" class="form-control">
                                <option value="">- Tidak ada Parent -</option>
                                @foreach($listParent as $parent)
                                    <option value="{{ $parent->id }}">{{ $parent->title }}</option>
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
            'px-libs/select2.full', 'px/extensions/bootstrap-tagsinput'], function($) {

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

            tinymce.init(<?php echo json_encode(array_merge(config('content.tinymce'), ['content_css' => mix('theme/front/css/tinymce.css')->toHtml()])) ?>);
        });

        function setAlias(obj){
            var text = $(obj).val().toLowerCase().replace(/([^0-9^A-z])/gi, '-');
            $("#alias").val(text);
            $("#alias-text").text(text);
        }
    </script>
@endsection