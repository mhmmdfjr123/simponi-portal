@extends('layouts.backoffice')

@section('content')
    <ul class="breadcrumb breadcrumb-page">
        <!-- Auto Breadcrumbs -->
        <li class="active"><a href="#">Ubah Profil</a></li>
    </ul>

    <div class="page-header">
        <div class="row">
            <!-- Page header, center on small screens -->
            <h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa fa-user page-header-icon"></i>&nbsp;&nbsp;{{ $pageTitle }}</h1>

            <div class="col-xs-12 col-sm-8">
                <div class="row">
                    <hr class="visible-xs no-grid-gutter-h" />
                    <!-- "Create project" button, width=auto on desktops -->
                    <div class="pull-right col-xs-12 col-sm-auto"><a href="{{ url('backoffice/profile/change-password') }}" class="btn btn-primary btn-labeled btn-load-popup" style="width: 100%;"><span class="btn-label icon fa fa-lock"></span> Ubah Password</a></div>

                </div>
            </div>
        </div>
    </div> <!-- / .page-header -->

    <div class="row">
        <div class="col-sm-12">
            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title">Ubah Profile Pengguna</span>
                </div>
                <div class="panel-body">
                    <form action="<?php echo url('backoffice/profile/edit'); ?>" class="form-horizontal" id="form-validate" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" name="id" value="{{ $obj->id }}" />

                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">Nama Lengkap</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control required" id="name" name="name" maxlength="100" placeholder="Nama lengkap" value="{{ $obj->name }}" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-sm-3 control-label">Username</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="username" name="username" maxlength="100" placeholder="Username" value="{{ $obj->username }}" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="email" name="email" maxlength="100" placeholder="Email" value="{{ $obj->email }}" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="phone" class="col-sm-3 control-label">Tgl. Lahir</label>
                            <div class="col-sm-3 col-md-2">
                                <input type="text" class="form-control required" id="date_of_birth" name="date_of_birth" value="{{ date('d-m-Y', strtotime($obj->date_of_birth)) }}" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="gender" class="col-sm-3 control-label">Jenis Kelamin</label>
                            <div class="col-sm-9">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="gender" value="{{ config('enums.user.gender.male') }}" class="px" <?php if($obj->gender == config('enums.user.gender.male'))echo 'checked="checked"' ?>>
                                        <span class="lbl">Pria</span>
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="gender" value="{{ config('enums.user.gender.female') }}" class="px" <?php if($obj->gender == config('enums.user.gender.female'))echo 'checked="checked"' ?>>
                                        <span class="lbl">Wanita</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="bio" class="col-sm-3 control-label">Alamat</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="address" id="address" maxlength="300">{{ $obj->address }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="col-sm-3 control-label">Telp</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control required" id="phone_mobile" name="phone_mobile" maxlength="20" placeholder="Phone: 0812 345 67890" value="{{ $obj->phone_mobile }}" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" name="save" value="save" class="btn btn-primary btn-save" data-loading-text="Saving...">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('jsscript')
    <script type="text/javascript">
        $(document).ready(function() {
            // Setup validation
            $("#form-validate").validate({
                focusInvalid: false,
                rules: {
                    'username': {
                        required: true,
                        remote: "<?php echo url('backoffice/administration/user/check-username/'.$obj->id)?>"
                    },
                    'email': {
                        required: true,
                        email: true,
                        remote: "<?php echo url('backoffice/administration/user/check-email/'.$obj->id)?>"
                    }
                },
                messages: {
                    'username': {
                        remote: $.validator.format("Username '{0}' is already in use")
                    },
                    'email': {
                        remote: $.validator.format("Email '{0}' is already in use")
                    }
                }
            });

            $("#form-validate").submit(function(e){
                if($(this).valid()){
                    $(".btn-save").button('loading');
                }
            });

            $('#date_of_birth').datepicker({
                format: "dd-mm-yyyy",
                language: "id",
                autoclose: true
            });
        });
    </script>
@endsection