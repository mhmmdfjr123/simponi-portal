@extends('template.backoffice')

@section('content')
    <ul class="breadcrumb breadcrumb-page">
        <!-- Auto Breadcrumbs -->
    </ul>

    <div class="page-header">
        <div class="row">
            <!-- Page header, center on small screens -->
            <h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa fa-align-left page-header-icon"></i>&nbsp;&nbsp;{{ $pageTitle }}</h1>

            <div class="col-xs-12 col-sm-8">
                <div class="row">
                    <hr class="visible-xs no-grid-gutter-h" />
                    <!-- "Create project" button, width=auto on desktops -->
                    <div class="pull-right col-xs-12 col-sm-auto"><a href="javascript:void(0)" onclick="alertPopUp('Pusat Bantuan', 'Butuh bantuan? <br /> hubungi <strong>efriandika@gmail.com</strong>', 'Tutup')" class="btn btn-primary btn-labeled" style="width: 100%;"><span class="btn-label icon fa fa-question-circle"></span> Bantuan</a></div>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">

            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title">SEO Friendly</span>
                </div>

                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <td width="30%">Meta Keyword</td>
                            <td width="70%"><a href="#" id="x-meta-key" data-type="text" data-pk="meta_key">{{ settings('meta_key') }}</a></td>
                        </tr>
                        <tr>
                            <td>Meta Description</td>
                            <td><a href="#" id="x-meta-desc" data-type="textarea" data-pk="meta_desc">{{ settings('meta_desc') }}</a></td>
                        </tr>
                        <tr>
                            <td>Google Analitycs</td>
                            <td><a href="#" id="x-google-analytics" data-type="textarea" data-pk="google_analytics">{{ settings('google_analytics') }}</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('jsscript')
    <script type="text/javascript">
        $(document).ready(function () {
            var csrfToken = '{{ csrf_token() }}';

            $.fn.editable.defaults.mode = 'inline';
            $.fn.editable.defaults.emptytext = 'Kosong';
            $.fn.editable.defaults.ajaxOptions = {
                type: 'post',
                dataType: 'json'
            };
            $.fn.editable.defaults.params = function (params) {
                params._token = csrfToken;

                return params;
            };
            $.fn.editable.defaults.error = function(response, newValue) {
                if(response.status === 500) {
                    return 'Layanan tidak tersedia. Ulangi beberapa saat lagi';
                } else {
                    return 'Telah terjadi kesalahan. Hubungi Administrator';
                }
            };
            $.fn.editable.defaults.success = function(response, newValue) {
                console.dir(response);
            };

            $('#x-meta-key').editable({
                url: '{{ url('backoffice/setting/general/submit') }}'
            });

            $('#x-meta-desc').editable({
                url: '{{ url('backoffice/setting/general/submit') }}',
                rows: 5
            });

            $('#x-google-analytics').editable({
                url: '{{ url('backoffice/setting/general/submit') }}',
                rows: 5
            });
        });
    </script>
@endsection