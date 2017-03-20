@extends('layouts.portal')

@section('portalContent')
    <h3>Download Laporan</h3>

    @if(!is_null($reports))
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th width="40px" class="text-center">No.</th>
                <th>Nama File</th>
                <th width="100px" class="text-center"><i class="fa fa-download"></i></th>
            </tr>
            </thead>
            <tbody>
            @foreach($reports as $report)
            <tr>
                <td class="text-center">{{ $loop->index + 1 }}</td>
                <td>{{ $report }}</td>
                <td class="text-center"><a href="{{ route('portal-report-download', [$report, 'date' => $date]) }}" class="btn btn-primary btn-md btn-md-uppercase">Download</a></td>
            </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-warning">
            Laporan untuk tanggal {{ $date }} belum tersedia, silahkan masukan tanggal lain.
        </div>
    @endif
@endsection