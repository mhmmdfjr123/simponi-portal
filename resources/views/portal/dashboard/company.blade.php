@extends('layouts.portal')

@section('portalContent')
    <h3 class="text-center">Download Laporan</h3>
    <hr class="title" />

    <div class="search-box">
        <form class="form-validate" method="get" action="{{ route('portal-report') }}">
            <div class="form-group">
                <label for="select-report-date">Laporan per tanggal:</label>
                {{--<input type="text" class="form-control input-lg text-center" name="date" id="date" value="{{ old('date') != '' ? old('date') : date('d-m-Y') }}" placeholder="dd-mm-yyyy" autocomplete="off" required />--}}
                <select class="form-control input-lg text-center" name="date" id="select-report-date" required>
                    <option value="">- Pilih Bulan -</option>
                    @foreach($lastDayEachMonth as $date)
                        <option value="{{ $date->format('d-m-Y') }}" {!! old('date') == $date->format('d-m-Y') ? 'selected' : ''  !!}>
                            {{ $date->formatLocalized('%B %Y') }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary btn-md-uppercase">
                <i class="ion-ios-search-strong" style="margin-right: 5px"></i> Lihat
            </button>
        </form>
    </div>
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

            $('#date').datepicker({
                format: "dd-mm-yyyy",
                language: 'id',
                maxViewMode: 2,
                autoclose: true,
                todayHighlight: true,
                orientation: 'bottom'
            });
        });
    </script>
@endpush