@extends('layouts.portal')

@section('headScript')
    <script>
        requirejs.config({
            paths: { demo: '../../demo/demo' }
        });
    </script>
    <script>require(['demo']);</script>
@endsection

@section('content')
    <div class="page-header m-b-0">
        <div class="row">
            <div class="col-md-4">
                <h1><i class="page-header-icon ion-arrow-graph-up-right"></i>Financial <span class="text-muted font-weight-light">Dashboard</span></h1>
            </div>
        </div>
    </div>

    <!-- Balance -->
    <div class="page-wide-block">
        <div class="box m-b-0 valign-middle bg-white">

            <div class="box-cell col-md-7 p-a-4">
                <div>
                    <span class="font-size-18 font-weight-light">Balance</span>&nbsp;&nbsp;
                    <span class="text-success">12% <i class="ion-arrow-up-c"></i></span>
                </div>
                <div class="font-size-34"><small class="font-weight-light text-muted">$</small><strong>31,600</strong></div>
            </div>

            <!-- Balance chart -->
            <div class="box-cell col-sm-5 p-a-4">
                <span id="balance-chart"></span>
            </div>

            <script>
                require(['jquery', 'demo', 'px/util', 'px/plugins/px-sparkline'], function($, pxDemo, pxUtil) {
                    var chartColor = pxDemo.getRandomColors(1)[0];
                    var data = [pxDemo.getRandomData(40000, 20000), pxDemo.getRandomData(40000, 20000), pxDemo.getRandomData(40000, 20000), pxDemo.getRandomData(40000, 20000), pxDemo.getRandomData(40000, 20000), pxDemo.getRandomData(40000, 20000), pxDemo.getRandomData(40000, 20000), pxDemo.getRandomData(40000, 20000), pxDemo.getRandomData(40000, 20000), pxDemo.getRandomData(40000, 20000), 31600];

                    $("#balance-chart").pxSparkline(data, {
                        type: 'line',
                        width: '100%',
                        height: '60px',
                        fillColor: pxUtil.default.hexToRgba(chartColor, 0.3),
                        lineColor: chartColor,
                        lineWidth: 1,
                        spotColor: null,
                        minSpotColor: null,
                        maxSpotColor: null,
                        highlightSpotColor: chartColor,
                        highlightLineColor: chartColor,
                        spotRadius: 3,
                    });
                });
            </script>
        </div>
    </div>

    <!-- / Balance -->

    <!-- Money flow charts -->

    <div class="page-wide-block">
        <div class="box border-radius-0 bg-black">

            <!-- Revenue -->
            <div class="box-cell col-md-6 p-a-4 bg-black darken">
                <div>
                    <span class="font-size-17 font-weight-light">Revenue</span>&nbsp;&nbsp;
                    <span class="text-success">9% <i class="ion-arrow-up-c"></i></span>
                </div>
                <div class="text-muted font-size-11 font-weight-light">past 30 days</div>
                <div class="font-size-34"><small class="font-weight-light text-muted">$</small><strong>3,239</strong></div>

                <!-- Chart -->
                <div class="p-t-4">
                    <canvas id="revenue-chart" width="400" height="150"></canvas>
                </div>
            </div>

            <script>
                require(['demo', 'px/util', 'px-libs/Chart'], function(pxDemo, pxUtil, Chart) {
                    var chartColor = pxDemo.getRandomColors(1)[0];
                    var data = {
                        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                        datasets: [{
                            label:           'Revenue, $',
                            data:            [pxDemo.getRandomData(5000, 2000), pxDemo.getRandomData(5000, 2000), pxDemo.getRandomData(5000, 2000), pxDemo.getRandomData(5000, 2000), pxDemo.getRandomData(5000, 2000), pxDemo.getRandomData(5000, 2000), 3239],
                            borderWidth:     1,
                            backgroundColor: pxUtil.default.hexToRgba(chartColor, 0.3),
                            borderColor:     chartColor
                        }]
                    };

                    new Chart(document.getElementById('revenue-chart').getContext("2d"), {
                        type: 'line',
                        data: data,
                        options: {
                            legend: { display: false },
                        },
                    });
                });
            </script>

            <hr class="m-a-0 visible-xs visible-sm">

            <!-- Expenses -->
            <div class="box-cell col-md-6 p-a-4">
                <div>
                    <span class="font-size-17 font-weight-light">Expenses</span>&nbsp;&nbsp;
                    <span class="text-danger">5% <i class="ion-arrow-down-c"></i></span>
                </div>
                <div class="text-muted font-size-11 font-weight-light">past 30 days</div>
                <div class="font-size-34"><small class="font-weight-light text-muted">$</small><strong>1,273</strong></div>

                <!-- Chart -->
                <div class="p-t-4">
                    <canvas id="expenses-chart" width="400" height="150"></canvas>
                </div>
            </div>

            <script>
                require(['demo', 'px/util', 'px-libs/Chart'], function(pxDemo, pxUtil, Chart) {
                    var chartColor = pxDemo.getRandomColors(1)[0];
                    var data = {
                        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                        datasets: [{
                            label:           'Expenses, $',
                            data:            [pxDemo.getRandomData(3000, 900), pxDemo.getRandomData(3000, 900), pxDemo.getRandomData(3000, 900), pxDemo.getRandomData(3000, 900), pxDemo.getRandomData(3000, 900), pxDemo.getRandomData(3000, 900), 1273],
                            borderWidth:     1,
                            backgroundColor: pxUtil.default.hexToRgba(chartColor, 0.3),
                            borderColor:     chartColor,
                        }],
                    };

                    new Chart(document.getElementById('expenses-chart').getContext("2d"), {
                        type: 'bar',
                        data: data,
                        options: {
                            legend: { display: false },
                        },
                    });
                });
            </script>

        </div>
    </div>

    <!-- / Money flow charts -->

    <!-- Accounts -->

    <div class="row">
        <div class="col-md-6">
            <div class="panel clearfix text-default">
                <div class="panel-title">
                    <i class="panel-title-icon ion-social-usd font-size-16 text-primary"></i> Accounts
                </div>

                <a href="#" class="col-xs-12 p-x-3 p-y-2 b-t-1 bg-white">
                    <div class="pull-xs-right font-size-18"><small class="font-size-13">$</small><strong>10,501</strong></div>
                    <div class="font-size-15">Bank of America</div>
                    <div class="text-muted font-size-14">**********1312</div>
                </a>

                <a href="#" class="col-xs-12 p-x-3 p-y-2 b-t-1 bg-white">
                    <div class="pull-xs-right font-size-18"><small class="font-size-13">$</small><strong>5,241</strong></div>
                    <div class="font-size-15">Citigroup</div>
                    <div class="text-muted font-size-14">**********3265</div>
                </a>

                <a href="#" class="col-xs-12 p-x-3 p-y-2 b-t-1 bg-white">
                    <div class="pull-xs-right font-size-18"><small class="font-size-13">$</small><strong>2,042</strong></div>
                    <div class="font-size-15">J.P.Morgan Chase & Co</div>
                    <div class="text-muted font-size-14">**********6294</div>
                </a>

            </div>
        </div>

        <!-- / Accounts -->

        <!-- Cards -->

        <div class="col-md-6">
            <div class="panel clearfix text-default">
                <div class="panel-title">
                    <i class="panel-title-icon ion-card font-size-16 text-primary"></i> Cards
                </div>

                <a href="#" class="box m-a-0 p-x-3 p-y-2 b-t-1 bg-white">
                    <div class="box-cell valign-middle" style="width: 54px;">
                        <i class="fa fa-cc-visa text-muted font-size-28"></i>
                    </div>
                    <div class="box-cell">
                        <div class="pull-xs-right font-size-18"><small class="font-size-13">$</small><strong>5,312</strong></div>
                        <div class="font-size-15">Salary card <span class="text-muted font-size-12">- Bank of America</span></div>
                        <div class="text-muted font-size-14">**** **** **** 1313</div>
                    </div>
                </a>

                <a href="#" class="box m-a-0 p-x-3 p-y-2 b-t-1 bg-white">
                    <div class="box-cell valign-middle" style="width: 54px;">
                        <i class="fa fa-cc-amex text-muted font-size-28"></i>
                    </div>
                    <div class="box-cell">
                        <div class="pull-xs-right font-size-18"><small class="font-size-13">$</small><strong>2,150</strong></div>
                        <div class="font-size-15">Shopping card <span class="text-muted font-size-12">- Citigroup</span></div>
                        <div class="text-muted font-size-14">**** **** **** 3266</div>
                    </div>
                </a>

                <a href="#" class="box m-a-0 p-x-3 p-y-2 b-t-1 bg-white">
                    <div class="box-cell valign-middle" style="width: 54px;">
                        <i class="fa fa-cc-mastercard text-muted font-size-28"></i>
                    </div>
                    <div class="box-cell">
                        <div class="pull-xs-right font-size-18"><small class="font-size-13">$</small><strong>6,454</strong></div>
                        <div class="font-size-15">Funded card <span class="text-muted font-size-12">- J.P.Morgan Chase & Co</span></div>
                        <div class="text-muted font-size-14">**** **** **** 6295</div>
                    </div>
                </a>

            </div>
        </div>

        <!-- / Cards -->

    </div>

    <!-- Latest transactions -->

    <div class="panel">
        <div class="panel-title">
            Latest transactions
            <div class="panel-heading-controls">
                <a href="#" class="btn btn-xs btn-primary btn-outline btn-outline-colorless">Show all transactions</a>
            </div>
        </div>

        <hr class="m-a-0">

        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Type</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th class="text-xs-right">Value</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><span class="label label-danger">OUTCOME</span></td>
                    <td>07/12/2016</td>
                    <td>Monthly service subscription payment</td>
                    <td class="text-xs-right"><strong>$102.00</strong></td>
                </tr>
                <tr>
                    <td><span class="label label-danger">OUTCOME</span></td>
                    <td>07/05/2016</td>
                    <td>Shopping</td>
                    <td class="text-xs-right"><strong>$82.00</strong></td>
                </tr>
                <tr>
                    <td><span class="label label-success">INCOME</span></td>
                    <td>07/02/2016</td>
                    <td>Monthly salary</td>
                    <td class="text-xs-right"><strong>$3000.00</strong></td>
                </tr>
                <tr>
                    <td><span class="label label-success">INCOME</span></td>
                    <td>06/29/2016</td>
                    <td>Freelance salary</td>
                    <td class="text-xs-right"><strong>$1230.00</strong></td>
                </tr>
                <tr>
                    <td><span class="label label-danger">OUTCOME</span></td>
                    <td>06/23/2016</td>
                    <td>Monthly bills</td>
                    <td class="text-xs-right"><strong>$862.00</strong></td>
                </tr>
                <tr>
                    <td><span class="label label-danger">OUTCOME</span></td>
                    <td>06/12/2016</td>
                    <td>Monthly service subscription payment</td>
                    <td class="text-xs-right"><strong>$102.00</strong></td>
                </tr>
                <tr>
                    <td><span class="label label-danger">OUTCOME</span></td>
                    <td>06/05/2016</td>
                    <td>Shopping</td>
                    <td class="text-xs-right"><strong>$82.00</strong></td>
                </tr>
                <tr>
                    <td><span class="label label-success">INCOME</span></td>
                    <td>06/02/2016</td>
                    <td>Monthly salary</td>
                    <td class="text-xs-right"><strong>$3000.00</strong></td>
                </tr>
                <tr>
                    <td><span class="label label-success">INCOME</span></td>
                    <td>05/29/2016</td>
                    <td>Freelance salary</td>
                    <td class="text-xs-right"><strong>$1230.00</strong></td>
                </tr>
                <tr>
                    <td><span class="label label-danger">OUTCOME</span></td>
                    <td>05/23/2016</td>
                    <td>Monthly bills</td>
                    <td class="text-xs-right"><strong>$862.00</strong></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- / Latest transactions -->
@endsection

@section('footScript')

@endsection