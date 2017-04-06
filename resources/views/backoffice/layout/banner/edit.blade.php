@extends('layouts.backoffice')

@section('headScript')
    <link href="{{ asset('theme/backoffice/ext/vendor/ezdz/jquery.ezdz.css') }}" rel="stylesheet" type="text/css" />
    <script>
        requirejs.config({
            paths:{
                "ezdz":"{{ asset('theme/backoffice/ext/vendor/ezdz/jquery.ezdz.min') }}"
            },
            shim:{
                'ezdz': {
                    deps: ['jquery']
                }
            }
        });
    </script>
@endsection

@section('content')
    <ol class="breadcrumb page-breadcrumb">
        <!-- Auto Breadcrumbs -->
        <li class="active" data-active-menu="#menu-layout-banner"><a href="#">Tambah Banner</a></li>
    </ol>

    <div class="page-header">
        <div class="row">
            <div class="col-md-4 text-xs-center text-md-left text-nowrap">
                <h1><i class="page-header-icon fa fa-file-picture-o"></i> {{ $pageTitle }}</h1>
            </div>

            <!-- Spacer -->
            <div class="m-b-2 visible-xs visible-sm clearfix"></div>
        </div>
    </div>

    <form action="{{ url('backoffice/layout/banner/submit') }}" method="post" class="validate" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <input type="text" name="name" maxlength="300" class="form-control required input-lg" placeholder="Nama Banner" value="{{ $obj->name }}" />
                <input type="hidden" name="id" value="{{ $obj->id }}" />
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            </div>

            <div class="form-group">
                <input type="text" name="hyperlink" maxlength="500" class="form-control url" placeholder="Hyperlink (Optional)" value="{{ $obj->hyperlink }}" />
                <p class="help-block">Setiap banner yang di klik akan diarahkan sesuai dengan hyperlink ini.</p>
            </div>

            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title">Banner Saat Ini</span>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <input type="hidden" name="image_filename_old" value="{{ $obj->image_filename }}" />
                        <img src="{{ asset('file/banner/'.$obj->image_filename) }}" class="img-responsive" >
                    </div>
                </div>
            </div>

            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title">Perbarui Banner</span>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <input type="file" name="image" accept="image/*" />
                        <p class="help-block">Ukuran gambar minimal {{ $imageSize['minWidth'] }}px * {{ $imageSize['minHeight'] }}px (Recommended) dan kurang dari {{ ($imageSize['maxSize'] / 1000) }}kb.</p>
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
                                    <input id="switcher-success" type="checkbox" name="status" value="P" {!! $obj->status == 'P' ? 'checked="true"' : '' !!}>
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
                            <input type="text" name="publish_time_start" id="publish-time-start" placeholder="Jam" class="form-control" value="{{ date('H:i:s', strtotime($obj->publish_date_start)) }}" />
                        </div>
                    </div>

                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-primary btn-labeled btn-save" data-loading-text="Loading..."><span class="btn-label-icon left fa fa-floppy-o"></span> Simpan</button>
                    <a href="{{ url('backoffice/layout/banner') }}" class="btn btn-default pull-right">Kembali</a>
                </div>
            </div>
        </div>
    </div>
    </form>
@endsection

@section('footScript')
    <script type="text/javascript">
        require(['jquery', 'ezdz', 'px/extensions/bootstrap-datepicker', 'px/extensions/bootstrap-timepicker',], function($) {
            $('input[type="file"]').ezdz({
                className: "dropzone-box",
                text: '<div class="dz-default dz-message"><i class="fa fa-cloud-upload"></i> Drop image here<br><span class="dz-text-small">or click to pick manually</span></div>',
                validators: {
                    minWidth:  '{{ $imageSize['minWidth'] }}',
                    minHeight: '{{ $imageSize['minHeight'] }}',
                    maxSize: '{{ $imageSize['maxSize'] }}'
                },
                reject: function(file, errors) {
                    if (errors.minWidth || errors.minHeight) {
                        alertPopUp('Perhatian!', 'Ukuran panjang atau lebar dari "' + file.name + '" tidak diizinkan. Ukuran gambar minimal adalah: <?php echo $imageSize['minWidth'].'px * '.$imageSize['minHeight'].'px' ?>', 'Close');
                    }else if(errors.maxSize){
                        alertPopUp('Perhatian!', 'Ukuran file "' + file.name + '" tidak diizinkan. Max: <?php echo ($imageSize['maxSize'] / 1000).'kb' ?>', 'Close');
                    }
                }
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
        });
    </script>
@endsection