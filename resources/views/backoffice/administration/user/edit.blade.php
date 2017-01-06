@extends('layouts.backoffice')

@section('content')
    <ol class="breadcrumb page-breadcrumb">
        <!-- Auto Breadcrumbs -->
        <li class="active" data-active-menu="#menu-user"><a href="#">Ubah Pengguna</a></li>
    </ol>

    <div class="page-header">
        <div class="row">
            <div class="col-md-4 text-xs-center text-md-left text-nowrap">
                <h1><i class="page-header-icon ion-person"></i> {{ $pageTitle }}</h1>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title">Ubah Pengguna</span>
                </div>
                <div class="panel-body">
                    <form action="{{ url('backoffice/administration/user/submit') }}" class="form-horizontal" id="form-validate" method="post">
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
                    <!--
                            <div class="form-group">
                                <label for="bio" class="col-sm-3 control-label">Bio</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="bio" id="bio" maxlength="500">{{ $obj->bio }}</textarea>
                                    <p class="help-block">Deskripsi profile singkat.</p>
                                </div>
                            </div>
                            -->
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
                            <label for="phone" class="col-sm-3 control-label">Role</label>
                            <div class="col-sm-9">
                                <?php $selectedRole = array(); ?>

                                @foreach($obj->getRoles() as $selectedRoleTemp)
                                    <?php $selectedRole[] = $selectedRoleTemp ?>
                                @endforeach

                                @foreach($roles as $role)
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="role[]" value="{{ $role->id }}" id="role-{{ $role->id }}" class="px" <?php if(in_array($role->slug, $selectedRole))echo 'checked="checked"' ?> />
                                            {{ $role->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="col-sm-3 control-label">Status</label>
                            <div class="col-sm-9">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="status" value="N" class="px" <?php if($obj->status == 'N')echo 'checked="checked"' ?> />
                                        <span class="lbl">Tidak Aktif</span>
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="status" value="Y" class="px" <?php if($obj->status == 'Y')echo 'checked="checked"' ?> />
                                        <span class="lbl">Aktif</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" name="save" value="save" class="btn btn-primary btn-save" data-loading-text="Saving...">Simpan</button>
                                <a class="btn btn-default" href="<?php echo url('backoffice/administration/user')?>">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footScript')
    <script type="text/javascript">
        require(['jquery', 'px/extensions/bootstrap-datepicker', 'px-bootstrap/button', 'px/plugins/px-validate'], function($) {
            var $formValidate = $("#form-validate");

            // Setup validation
            $formValidate.submit(function(e){
                if($(this).valid()){
                    $(".btn-save").button('loading');
                }
            });

            $formValidate.pxValidate({
                focusInvalid: false,
                rules: {
                    'username': {
                        required: true,
                        remote: "{{ url('backoffice/administration/user/check-username/'.$obj->id) }}"
                    },
                    'email': {
                        required: true,
                        email: true,
                        remote: "{{ url('backoffice/administration/user/check-email/'.$obj->id) }}"
                    },
                    'group': {
                        required: true
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

            $('#date_of_birth').datepicker({
                format: "dd-mm-yyyy",
                language: "id",
                autoclose: true
            });
        });
    </script>
@endsection