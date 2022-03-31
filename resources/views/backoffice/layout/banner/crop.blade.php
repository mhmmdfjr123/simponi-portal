@extends('layouts.backoffice')

@section('headScript')
    <link href="{{ asset('theme/backoffice/ext/vendor/cropper/cropper.min.css') }}" rel="stylesheet" type="text/css" />
    <script>
        requirejs.config({
            paths:{
                "cropper":"{{ asset('theme/backoffice/ext/vendor/cropper/cropper.min') }}"
            },
            shim:{
                'cropper': {
                    deps: ['jquery']
                }
            }
        });
    </script>
@endsection

@section('content')
    <ol class="breadcrumb page-breadcrumb">
        <!-- Auto Breadcrumbs -->
        <li class="active" data-active-menu="#menu-layout-banner"><a href="#">Crop Banner</a></li>
    </ol>

    <div class="page-header">
        <div class="row">
            <div class="col-md-4 text-xs-center text-md-left text-nowrap">
                <h1><i class="page-header-icon fa fa-crop"></i> {{ $pageTitle }}</h1>
            </div>

            <hr class="page-wide-block visible-xs visible-sm">

            <div class="col-xs-12 width-md-auto width-lg-auto width-xl-auto pull-md-right">
                <a href="{{ url('backoffice/layout/banner/'.$id.'/crop') }}" class="btn btn-primary btn-block" style="width: 100%;"><span class="btn-label-icon left fa fa-refresh"></span>Reset</a>
            </div>

            <!-- Spacer -->
            <div class="m-b-2 visible-xs visible-sm clearfix"></div>
        </div>
    </div>

    <form action="{{ url('backoffice/layout/banner/'.$id.'/crop') }}" method="post" class="validate" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

        <?php $i = 0 ?>
        <div class="row">
            @foreach($originalImages as $originalImage)
                <div class="col-md-10">
                    <div class="panel">
                        <div class="panel-heading">
                            <span class="panel-title">Gambar #{{ $i+1 }}</span>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <img id="image-{{ $i }}" src="{{ asset($originalImage['image_path'].'/'.$originalImage['image_filename']) }}" style="max-width: 100%; padding: 3px; border: 1px solid #cccccc">

                                <input type="hidden" name="metadata[{{ $i }}][x]" id="metadata-{{ $i }}-x" />
                                <input type="hidden" name="metadata[{{ $i }}][y]" id="metadata-{{ $i }}-y" />
                                <input type="hidden" name="metadata[{{ $i }}][width]" id="metadata-{{ $i }}-width" />
                                <input type="hidden" name="metadata[{{ $i }}][height]" id="metadata-{{ $i }}-height" />
                                <input type="hidden" name="metadata[{{ $i }}][rotate]" id="metadata-{{ $i }}-rotate" />
                                <input type="hidden" name="metadata[{{ $i }}][filename]" value="{{ $originalImage['image_filename'] }}" />
                            </div>
                        </div>
                    </div>
                </div>

                <script type="text/javascript">
                    require(['jquery', 'cropper'], function($) {
                        $('#image-{{ $i }}').cropper({
                            aspectRatio: '{{ $originalImage['crop_to_width'] / $originalImage['crop_to_height'] }}',
                            minCropBoxWidth: '{{ $originalImage['crop_to_width'] - 200 }}',
                            crop: function(e) {
                                // Output the result data for cropping image.
                                $('#metadata-{{ $i }}-x').val(e.x);
                                $('#metadata-{{ $i }}-y').val(e.y);
                                $('#metadata-{{ $i }}-width').val(e.width);
                                $('#metadata-{{ $i }}-height').val(e.height);
                                $('#metadata-{{ $i }}-rotate').val(e.rotate);

                                // console.log(e.scaleX);
                                // console.log(e.scaleY);
                            }
                        });
                    });
                </script>

                <?php $i++; ?>
            @endforeach

            <div class="col-md-2 text-center">
                <button type="submit" class="btn btn-primary btn-labeled btn-save" data-loading-text="Loading..."><span class="btn-label-icon left fa fa-floppy-o"></span> Simpan</button>
            </div>
        </div>
    </form>
@endsection