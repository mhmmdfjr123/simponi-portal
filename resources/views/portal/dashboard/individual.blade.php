@extends('layouts.portal')

@section('portalContent')
    <h3>Inquiry Saldo</h3>

    <p class="help-block">
        Saldo per tanggal: {{ date('d-m-Y H:i') }} WIB
    </p>

    <section class="section-box inquiry-box">
        <div class="row">
            <div class="{{ $user->accountPerson->accountCategory == 'KOLEKTIF' ? 'col-md-4' : 'col-md-6' }}">
                <div class="section-box-item">
                    <div class="box-header">
                        Akumulasi Iuran Anda
                    </div>
                    <div class="box-body">
                        {{ idr($user->accountPerson->totAmount) }}
                    </div>
                </div>
            </div>
            @if($user->accountPerson->accountCategory == 'KOLEKTIF')
                <div class="col-md-4">
                    <div class="section-box-item">
                        <div class="box-header">
                            Iuran Kolektif
                        </div>
                        <div class="box-body">
                            {{ idr($user->accountPerson->totAmountPersonal) }}
                            <p class="help-block" style="font-size: 10pt">
                                {{ $user->accountPerson->companyName }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif
            <div class="{{ $user->accountPerson->accountCategory == 'KOLEKTIF' ? 'col-md-4' : 'col-md-6' }}">
                <div class="section-box-item">
                    <div class="box-header">
                        Akumulasi Pengembangan
                    </div>
                    <div class="box-body">
                        {{ idr($user->accountPerson->totBunga) }}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="ending-balance-box-item">
                    <div class="box-header no-padding-top">
                        Saldo Akhir BNI Simponi
                    </div>
                    <div class="box-body">
                        {{ idr($user->accountPerson->balance) }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('portalFootScript')
<script type="text/javascript">
    $(function () {
        // Idn
    });
</script>
@endpush