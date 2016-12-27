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
                    <span class="panel-title">Alamat</span>
                </div>

                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <td width="30%">Alamat Lengkap</td>
                        <td width="70%"><a href="#" id="x-address" data-type="textarea" data-pk="address">{{ settings('address') }}</a></td>
                    </tr>
                    <tr>
                        <td>Telepon</td>
                        <td><a href="#" id="x-phone" data-type="text" data-pk="phone" data-placeholder="021 1234 xxx">{{ settings('phone') }}</a></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><a href="#" id="x-email" data-type="text" data-pk="email" data-placeholder="nama@domain.com">{{ settings('email') }}</a></td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title">Sosial Media</span>
                </div>

                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <td width="30%">Username Facebook</td>
                        <td width="70%"><a href="#" id="x-social-facebook" data-type="text" data-pk="social_facebook" data-placeholder="Contoh: efriandka.pratama">{{ settings('social_facebook') }}</a></td>
                    </tr>
                    <tr>
                        <td>Username Twitter</td>
                        <td><a href="#" id="x-social-twitter" data-type="text" data-pk="social_twitter" data-placeholder="Contoh: efriandka">{{ settings('social_twitter') }}</a></td>
                    </tr>
                    <tr>
                        <td>Username Instagram</td>
                        <td><a href="#" id="x-social-instagram" data-type="text" data-pk="social_instagram" data-placeholder="Contoh: efriandka">{{ settings('social_instagram') }}</a></td>
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
                if(response.status == 'error'){
                    return response.message.value.join(', ');
                }
            }

            $('#x-address').editable({
                url: '{{ url('backoffice/setting/contact/submit') }}',
                rows: 5
            });

            $('#x-phone').editable({
                url: '{{ url('backoffice/setting/contact/submit') }}'
            });

            $('#x-email').editable({
                url: '{{ url('backoffice/setting/contact/submit') }}',
                type: 'email'
            });

            $('#x-social-facebook').editable({
                url: '{{ url('backoffice/setting/contact/submit') }}'
            });

            $('#x-social-twitter').editable({
                url: '{{ url('backoffice/setting/contact/submit') }}'
            });

            $('#x-social-instagram').editable({
                url: '{{ url('backoffice/setting/contact/submit') }}'
            });
        });
    </script>
@endsection