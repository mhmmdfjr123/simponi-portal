@extends('layouts.backoffice')

@section('headScript')
    <script>
        requirejs.config({
            paths: { demo: '../demo/demo' }
        });
    </script>
    <script>require(['demo']);</script>
@endsection

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-md-4">
                <h1><i class="page-header-icon ion-arrow-graph-up-right"></i>Backoffice <span class="text-muted font-weight-light">Dashboard</span></h1>
            </div>
        </div>
    </div>

    <div class="row">

        <!-- Stats -->

        <div class="col-md-3">
            <div class="box bg-success darken">
                <div class="box-row">
                    <div class="box-cell p-x-3 p-y-1 bg-success">
                        <div class="pull-xs-left font-weight-semibold font-size-12">TOTAL PENGGUNA</div>
                    </div>
                </div>
                <div class="box-row">
                    <div class="box-cell p-x-3 p-y-2">
                        <i class="box-bg-icon middle left font-size-52 ion-ios-play text-white"></i>
                        <div class="pull-xs-right font-weight-semibold font-size-24 line-height-1" id="counter-total-customer">Calculating...</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel box bg-white text-default">
                <div class="box-row">
                    <div class="box-cell p-x-3 p-y-1">
                        <div class="pull-xs-left font-weight-semibold font-size-12">NASABAH INDIVIDU</div>
                    </div>
                </div>
                <div class="box-row">
                    <div class="box-cell p-x-3 p-y-2">
                        <i class="box-bg-icon middle left text-danger font-size-52 ion-ios-people-outline"></i>
                        <div class="pull-xs-right font-weight-semibold font-size-24 line-height-1" id="counter-individual-account">Calculating...</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel box bg-white text-default">
                <div class="box-row">
                    <div class="box-cell p-x-3 p-y-1">
                        <div class="pull-xs-left font-weight-semibold font-size-12">NASABAH PERUSAHAAN</div>
                    </div>
                </div>
                <div class="box-row">
                    <div class="box-cell p-x-3 p-y-2">
                        <i class="box-bg-icon middle left text-info font-size-52 ion-ios-people-outline"></i>
                        <div class="pull-xs-right font-weight-semibold font-size-24 line-height-1" id="counter-company-account">Calculating...</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel box bg-white text-default">
                <div class="box-row">
                    <div class="box-cell p-x-3 p-y-1">
                        <div class="pull-xs-left font-weight-semibold font-size-12">TOTAL LOGIN HARI INI</div>
                    </div>
                </div>
                <div class="box-row">
                    <div class="box-cell p-x-3 p-y-2">
                        <i class="box-bg-icon middle left text-warning font-size-52 ion-ios-locked-outline"></i>
                        <div class="pull-xs-right font-weight-semibold font-size-24 line-height-1" id="counter-today-login">Calculating...</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- / Stats -->

    </div>

    <!-- Overview -->

    <div class="panel">
        <div class="panel-title">
            Statistik Registrasi Nasabah Individu dan Perusahaan
        </div>

        <hr class="m-a-0">

        <!-- Overview stats
        <div class="p-x-2 p-y-2 b-b-1 clearfix bg-white darken">
            <div class="col-xs-4 p-x-2 b-r-1">
                <div class="font-size-24"><strong>6,216</strong></div>
                <div class="font-size-14">Belum diaktivasi</div>
            </div>
            <div class="col-xs-4 p-x-2 b-r-1">
                <div class="font-size-24"><strong>2,715</strong></div>
                <div class="font-size-14">Sudah Diaktivasi</div>
            </div>
            <div class="col-xs-4 p-x-2">
                <div class="font-size-24"><strong>1,321</strong></div>
                <div class="font-size-14">Terblokir</div>
            </div>
        </div>
 -      -->

        <!-- Graph -->
        <div class="p-x-2 p-y-4">
            <div id="overview-chart" style="height: 250px">
                {{--<div style="position: absolute; top: -10px">Calculating...</div>--}}
            </div>
        </div>
    </div>
@endsection

@section('footScript')
<script type="text/javascript">
    require(['jquery', 'demo', 'px-libs/morris'], function($, Morris) {
        loadCounterAnalytics();
        loadGraphAnalytics();
    });

    function loadCounterAnalytics() {
        $.ajax({
            url: '{{ url('backoffice/dashboard/analytics/counter') }}',
            beforeSend: function(){
                console.log('Retrieving analytics counter data...');
            },
            success: function(response){
                $('#counter-total-customer').text(response.individualAccountTotal + response.companyAccountTotal);
                $('#counter-individual-account').text(response.individualAccountTotal);
                $('#counter-company-account').text(response.companyAccountTotal);
                $('#counter-today-login').text(response.todayLogin);

            },
            type:"get",
            dataType:"json"
        });
    }

    function loadGraphAnalytics() {
        $.ajax({
            url: '{{ url('backoffice/dashboard/analytics/graph') }}',
            beforeSend: function(){
                console.log('Retrieving analytics counter data...');
            },
            success: function(response){
                setGraph(response.data);
            },
            type:"get",
            dataType:"json"
        });
    }

    function setGraph(histories) {
        var data = [];

        histories.forEach(function(history) {
            data.push({
                period:   history.date.substr(0, 10),
                register:  history.counter
            });
        });

        new Morris.Area({
            element:        'overview-chart',
            data:           data,
            xkey:           'period',
            ykeys:          ['register'],
            labels:         ['Register'],
            hideHover:      'auto',
            lineColors:     ['#FF5722'],
            fillOpacity:    0.1,
            behaveLikeLine: true,
            lineWidth:      1,
            pointSize:      4,
            gridLineColor:  '#cfcfcf',
            resize:         true
        });
    }
</script>
@endsection