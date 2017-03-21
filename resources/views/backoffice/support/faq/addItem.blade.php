@extends('layouts.backoffice')

@section('content')
    <ol class="breadcrumb page-breadcrumb">
        <!-- Auto Breadcrumbs -->
    </ol>

    <div class="page-header">
        <div class="row">
            <div class="col-md-4 text-xs-center text-md-left text-nowrap">
                <h1><i class="page-header-icon fa fa-question-circle-o"></i> {{ $pageTitle }} - Kategori: {{ $faqCategory->name }}</h1>
            </div>

            <!-- Spacer -->
            <div class="m-b-2 visible-xs visible-sm clearfix"></div>
        </div>
    </div>

    <form action="{{ url('backoffice/support/faq/submit') }}" method="post" class="validate">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <input type="text" name="question" maxlength="300" class="form-control required input-lg" placeholder="Pertanyaan" />
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <input type="hidden" name="faq_category_id" value="{{ $faqCategory->id }}" />
                </div>
                <div class="form-group">
                    <label for="answer">Jawaban:</label>
                    <textarea class="form-control tinymce" name="answer" id="answer" rows="10"></textarea>
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
                                        <input id="switcher-success" checked type="checkbox" name="status" value="Y">
                                        <div class="switcher-indicator">
                                            <div class="switcher-yes">YES</div>
                                            <div class="switcher-no">NO</div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-primary btn-labeled btn-save" data-loading-text="Loading..."><span class="btn-label-icon left fa fa-floppy-o"></span> Simpan</button>
                        <a href="{{ url('backoffice/support/faq') }}" class="btn btn-default pull-right">Batal</a>
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

            tinymce.init(<?php echo json_encode(config('content.tinymce')) ?>);
        });

        function setAlias(obj){
            var text = $(obj).val().toLowerCase().replace(/([^0-9^A-z])/gi, '-');
            $("#alias").val(text);
            $("#alias-text").text(text);
        }
    </script>
@endsection