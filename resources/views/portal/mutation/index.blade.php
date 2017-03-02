@extends('layouts.portal', ['activeMenu' => 'mutation'])

@section('portalContent')
    <h3>{{ $pageTitle }}</h3>

    <form id="form-mutation" class="form-inline" method="post" action="{{ route('portal-mutation') }}">
        {{ csrf_field() }}

        <div class="form-group">
            <div class="input-daterange input-group" id="input-daterange" style="max-width: 400px">
                <input type="text" class="form-control" name="dateStart" placeholder="Tanggal awal" autocomplete="off" required value="{{ !is_null($accountTrxList) ? $accountTrxList['dateStart'] : '' }}" />
                <span class="input-group-addon">hingga</span>
                <input type="text" class="form-control" name="dateEnd" placeholder="Tanggal akhir" autocomplete="off" required value="{{ !is_null($accountTrxList) ? $accountTrxList['dateEnd'] : '' }}" />
            </div>
        </div>

        <button type="submit" class="btn btn-primary" id="btn-mutation" title="Lihat Mutasi" data-loading-text="Loading...">
            <small><strong>LIHAT</strong></small>
        </button>

        <div class="form-group">
            <p class="help-block">Mutasi yang dapat dilihat adalah mutasi dalam rentang waktu maksimal 30 hari</p>
        </div>
    </form>

    @if(!is_null($accountTrxList))
        @if(count($accountTrxList['trxList']) > 0)
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Uraian</th>
                    <th>Tipe</th>
                    <th>Jumlah Pembayaran</th>
                    <th>Saldo</th>
                </tr>
                </thead>
                <tbody>
                @foreach($accountTrxList['trxList'] as $trx)
                <tr>
                    <td>{{ date('d-m-Y', strtotime($trx->trxDate)) }}</td>
                    <td>{{ $trx->description }}</td>
                    <td>{{ $trx->debetKredit }}</td>
                    <td>{{ idr($trx->amount) }}</td>
                    <td>{{ idr($trx->balance) }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-warning">
                Tidak ada transaksi pada tanggal <strong>{{ $accountTrxList['dateStart'] }}</strong> hingga <strong>{{ $accountTrxList['dateEnd'] }}</strong>
            </div>
        @endif
    @endif
@endsection

@push('portalFootScript')
    <script type="text/javascript">
        $(function () {
            var $formMutation   = $('#form-mutation');

            $formMutation.validate({
                errorPlacement: function(error, element) {}
            });

            $formMutation.submit(function(e){
                if($(this).valid()){
                    $('input.form-control').attr('readonly', true);
                    $('#btn-mutation').button('loading');
                }
            });

            $('.input-daterange').datepicker({
                format: "dd-mm-yyyy",
                autoclose: true,
                language: 'id'
            });
        });
    </script>
@endpush