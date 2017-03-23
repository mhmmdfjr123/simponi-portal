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

            <!-- Spacer -->
            <div class="m-b-2 visible-xs visible-sm clearfix"></div>
        </div>
    </div>

    <form action="{{ url('backoffice/file/download/submit') }}" method="post" class="validate" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

        <div class="row">
            <div class="col-md-8">
                <div class="panel">
                    <div class="panel-heading">
                        <span class="panel-title">Informasi File</span>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="control-label">Nama File</label>
                            <input type="text" name="name" maxlength="50" class="form-control required" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Deskripsi</label>
                            <textarea name="desc" rows="4" maxlength="300" class="form-control required"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Kategori</label>
                            <select name="download_category_id" class="form-control required">
                                <option value="">- Pilih Kategori -</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }} {!! $category->status != 'Y' ? '(Tidak Aktif)' : '' !!}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Upload File</label>
                            <label id="px-file-custom-1" class="custom-file px-file" for="px-file-custom-input-1">
                                <input id="px-file-custom-input-1" class="custom-file-input required" type="file" name="file">
                                <span class="custom-file-control form-control">Pilih File...</span>
                                <div class="px-file-buttons">
                                    <button type="button" class="btn px-file-clear">Batal</button>
                                    <button type="button" class="btn btn-primary px-file-browse">Cari File</button>
                                </div>
                            </label>
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
                                        <input id="switcher-success" checked type="checkbox" name="status" value="P">
                                        <div class="switcher-indicator">
                                            <div class="switcher-yes">YES</div>
                                            <div class="switcher-no">NO</div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group col-md-8">
                                <label class="control-label">Waktu Publish</label>
                                <input type="text" name="publish_date_start" id="publish-date-start" placeholder="Tanggal" value="{{ date('d-m-Y') }}" class="form-control" />
                                <input type="text" name="publish_time_start" id="publish-time-start" placeholder="Jam" class="form-control" />
                            </div>
                        </div>

                    </div>
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-primary btn-labeled btn-save" data-loading-text="Loading..."><span class="btn-label-icon left fa fa-floppy-o"></span> Simpan</button>
                        <a href="{{ url('backoffice/file/download') }}" class="btn btn-default pull-right">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('footScript')
    <script type="text/javascript">
        require(['jquery', 'px/extensions/bootstrap-datepicker', 'px/extensions/bootstrap-timepicker', 'px/plugins/px-file'], function($) {
            $('.custom-file').pxFile();

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
        });
    </script>
@endsection
