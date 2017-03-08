@extends('layouts.portal')

@section('portalContent')
    <h3>{{ $pageTitle }}</h3>

    <form class="form-horizontal form-validate" action="{{ route('portal-profile') }}" method="post">
        {{ csrf_field() }}

        <div class="panel panel-default">
            <div class="panel-heading">Detail</div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Nomor Akun</label>
                    <div class="col-sm-9">
                        <p class="form-control-static">{{ $account->accountNumber }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Nomor Kartu Identitas</label>
                    <div class="col-sm-9">
                        <p class="form-control-static">{{ $account->idNumber }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Name Lengkap</label>
                    <div class="col-sm-9">
                        <p class="form-control-static">{{ $account->accountName }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Jenis Kelamin</label>
                    <div class="col-sm-9">
                        <p class="form-control-static">{{ $account->jenisKelamin }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Tanggal Lahir</label>
                    <div class="col-sm-9">
                        <p class="form-control-static">{{ $account->kotaLahir }} / {{ $account->tglLahir ? date('d-m-Y', strtotime($account->tglLahir)) : '-' }}</p>
                        @if($age)
                            <p class="help-block">
                                Umur anda saat ini adalah: {{ $age }}
                            </p>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Usia Pensiun</label>
                    <div class="col-sm-9">
                        <p class="form-control-static">{{ $account->usiaPensiun }} Tahun</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Tanggal Pembukaan</label>
                    <div class="col-sm-9">
                        <p class="form-control-static">{{ $account->openDate ? date('d-m-Y', strtotime($account->openDate)) : '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Akun</div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="input-username" class="col-sm-3 control-label">Username</label>
                    <div class="col-sm-9">
                        <input type="text" name="username" class="form-control notNumericOnly" id="input-username" placeholder="Silahkan masukan username" value="{{ $user->username }}" required minlength="6" maxlength="12">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="col-sm-3 control-label">Password</label>
                    <div class="col-sm-9">
                        <p class="form-control-static">
                            <a href="javascript:void(0)" onclick="loadIntoBox('{{ route('portal-change-password') }}')" class="btn btn-sm btn-primary btn-outline"><i class="fa fa-fw fa-lock"></i> Ubah Password</a>
                        </p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="input-email" class="col-sm-3 control-label">Email</label>
                    <div class="col-sm-9">
                        <input type="email" name="email" class="form-control" id="input-email" placeholder="Silahkan masukan alamat email anda" value="{{ $user->email }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="input-phone" class="col-sm-3 control-label">Nomor Handphone</label>
                    <div class="col-sm-3">
                        <input type="text" name="mobilePhone" class="form-control" id="input-phone" placeholder="Nomor handphone anda" value="{{ $user->mobilePhone }}" required>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-submit" data-loading-text="Menyimpan...">Simpan</button>
    </form>
@endsection

@push('portalFootScript')
    <script type="text/javascript">
        $(function () {
            var $formValidate = $('.form-validate');

            $formValidate.submit(function(e){
                if($(this).valid()){
                    $('input.form-control').attr('readonly', true);
                }
            });
        });
    </script>
@endpush