@extends('layouts.portal')

@section('portalContent')
    <h3>{{ $pageTitle }}</h3>

    <form id="form-mutation" class="form-inline" method="post" action="{{ route('portal-mutation') }}">
        {{ csrf_field() }}

        <div class="form-group">
            <div class="input-daterange input-group" id="input-daterange" style="max-width: 400px">
                <input type="text" class="form-control" name="dateStart" id="mutation-date-start" placeholder="Tanggal awal" autocomplete="off" required value="{{ !is_null($accountTrxList) ? $accountTrxList['dateStart'] : '' }}" />
                <span class="input-group-addon">hingga</span>
                <input type="text" class="form-control" name="dateEnd" id="mutation-date-end" placeholder="Tanggal akhir" autocomplete="off" required value="{{ !is_null($accountTrxList) ? $accountTrxList['dateEnd'] : '' }}" />
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
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Uraian</th>
                    <th class="text-center">Tipe</th>
                    <th class="text-right">Jumlah Pembayaran</th>
                    <th class="text-right">Saldo</th>
                </tr>
                </thead>
                <tbody>
                @foreach($accountTrxList['trxList'] as $trx)
                <tr>
                    <td class="text-center">{{ date('d-m-Y', strtotime($trx->trxDate)) }}</td>
                    <td>{{ $trx->description }}</td>
                    <td class="text-center">{{ $trx->debetKredit }}</td>
                    <td class="text-right">{{ idr($trx->amount) }}</td>
                    <td class="text-right">{{ idr($trx->balance) }}</td>
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

            /*
            $('.input-daterange').datepicker({
                format: "dd-mm-yyyy",
                autoclose: true,
                language: 'id'
            });
            */

            var $dateOptions = {
                format: "dd-mm-yyyy",
                autoclose: true,
                language: 'id'
            };
            var $dateStart = $('#mutation-date-start');
            var $dateEnd = $('#mutation-date-end');
            var tempDateStart = '';
            var tempDateEnd = '';

            // When start date was changed
            $dateStart.datepicker($dateOptions)
                .on("changeDate", function (e) {
                    d = new Date(e.date);
                    d.setDate(d.getDate() + 30);

                    var splittedDate = tempDateEnd.split('-');
                    var mergedDate = new Date(splittedDate[2] + '-' + splittedDate[1] + '-' + splittedDate[0]);

                    if (tempDateEnd === '' || (splittedDate.length === 3 && mergedDate > d) || mergedDate <= new Date(e.date)) {
                        $dateEnd.datepicker('update', d);
                    } else {
                        $dateEnd.datepicker('update', tempDateEnd);
                    }

                    tempDateEnd = $dateEnd.val();
                    tempDateStart = $dateStart.val();
                });

            // When end date was changed
            $dateEnd.datepicker($dateOptions)
                .on("changeDate", function (e) {
                    d = new Date(e.date);
                    d.setDate(d.getDate() - 30);

                    var splittedDate = tempDateStart.split('-');
                    var mergedDate = new Date(splittedDate[2] + '-' + splittedDate[1] + '-' + splittedDate[0]);

                    if (tempDateStart === '' || (splittedDate.length === 3 && mergedDate < d) || mergedDate > new Date(e.date)) {
                        $dateStart.datepicker('update', d);
                    } else {
                        $dateStart.datepicker('update', tempDateStart);
                    }

                    tempDateEnd = $dateEnd.val();
                    tempDateStart = $dateStart.val();
                });
        });
    </script>
@endpush