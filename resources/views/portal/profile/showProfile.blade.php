@extends('layouts.portal')

@section('portalContent')
    <h3>{{ $pageTitle }}</h3>

    <form class="form-horizontal" action="{{ route('portal-profile') }}" method="post" class="form-validate">
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



        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection

@push('portalFootScript')
    <script type="text/javascript">
        $(function () {

        });
    </script>
@endpush