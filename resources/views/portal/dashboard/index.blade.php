@extends('layouts.portal', ['activeMenu' => 'dashboard'])

@section('portalContent')
    <h3>Inquiry Saldo</h3>

    Kategori Akun: {{ $user->accountPerson->accountCategory }}

    <section class="section-box inquiry-box">
        <div class="row">
            <div class="col-md-4">
                <div class="section-box-item">
                    <div class="box-header">
                        Total Setoran Anda
                    </div>
                    <div class="box-body">
                        {{ idr($user->accountPerson->totAmount) }}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="section-box-item">
                    <div class="box-header">
                        Total Pengembagan Dana
                    </div>
                    <div class="box-body">
                        {{ idr($user->accountPerson->totBunga) }}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="section-box-item">
                    <div class="box-header">
                        Total Dana BNI Simponi Anda
                    </div>
                    <div class="box-body">
                        {{ idr($user->accountPerson->balance) }}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <p class="help-block">
        Saldo per tanggal: {{ date('d-m-Y H:i') }} WIB
    </p>
@endsection

@push('portalFootScript')
    <script type="text/javascript">
        $(function () {
            // Idn
        });
    </script>
@endpush