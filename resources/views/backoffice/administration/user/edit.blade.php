@extends('layouts.backoffice')

@section('content')
        <ul class="breadcrumb breadcrumb-page">
			<li><a href="<?php echo url('backoffice')?>">Beranda</a></li>
			<li><a href="#">Administrasi</a></li>
			<li><a href="<?php echo url('backoffice/administration/user')?>">Pengguna</a></li>
			<li class="active"><a href="#">Ubah Pengguna</a></li>
		</ul>
		<div class="page-header">
			<div class="row">
				<!-- Page header, center on small screens -->
				<h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa fa-user page-header-icon"></i>&nbsp;&nbsp;<?php echo $pageTitle?></h1>
			</div>
		</div> <!-- / .page-header -->

        <div class="row">
			<div class="col-sm-12">
				<div class="panel">
					<div class="panel-heading">
						<span class="panel-title">Ubah Pengguna</span>
					</div>
					<div class="panel-body">
						<form action="<?php echo url('backoffice/administration/user/submit'); ?>" class="form-horizontal" id="form-validate" method="post">
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
                                    <div class="radio">
                                        <label>
                                            <input type="checkbox" name="role[]" value="{{ $role->id }}" id="role-{{ $role->id }}" class="px" <?php if(in_array($role->slug, $selectedRole))echo 'checked="checked"' ?> />
                                            <span class="lbl">{{ $role->name }}</span>
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

@section('jsscript')
    <script type="text/javascript">
        var tempAuthorityId = '{{ $obj->authority_id }}';

        $(document).ready(function() {
            // Setup validation
            $("#form-validate").submit(function(e){
                if($(this).valid()){
                    $(".btn-save").button('loading');
                }
            });

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

            unitToggle('#role--3', '#role--5');
            $('#role--3').click(function(){
                unitToggle('#role--3', '#role--5');
            });

            $('#role--5').click(function(){
                unitToggle('#role--3', '#role--5');
            });

            $("#authority-id").select2({
                allowClear: true,
                placeholder: "- Pilih Unit -"
            });
        });

        function unitToggle(obj1, obj2){
            if($(obj1).is(":checked") || $(obj2).is(":checked")) {
                $('#authority-id-input-container').show();
                $('#authority-id').val(tempAuthorityId);
            }else{
                $('#authority-id-input-container').hide();
                tempAuthorityId = $('#authority-id').val();
                $('#authority-id').val('');
            }
        }

        init.push(function () {
            // Set state of menu
            $('#menu-administration').addClass('open').addClass('active');
            $('#submenu-users-list').addClass('active');
        });
    </script>
@endsection