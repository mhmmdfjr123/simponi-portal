@extends('layouts.backoffice')

@section('content')
    <ul class="breadcrumb breadcrumb-page">
        <!-- Auto Breadcrumbs -->
    </ul>

    <div class="page-header">

        <div class="row">
            <!-- Page header, center on small screens -->
            <h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa fa-dashboard page-header-icon"></i>&nbsp;&nbsp;Dashboard</h1>

            <div class="col-xs-12 col-sm-8">
                <div class="row">
                    <hr class="visible-xs no-grid-gutter-h">
                    <!--
                    <div class="pull-right col-xs-12 col-sm-auto"><a href="#" class="btn btn-primary btn-labeled" style="width: 100%;"><span class="btn-label icon fa fa-plus"></span>Create project</a></div>
                    -->
                </div>
            </div>
        </div>
    </div> <!-- / .page-header -->


    <div class="row">
        <div class="col-md-8">

            <!-- 5. $UPLOADS_CHART =============================================================================

                            Uploads chart
            -->
            <!-- Javascript -->
            <script>
                init.push(function () {
                    var uploads_data = [
                        { day: '2014-03-10', v: 20 },
                        { day: '2014-03-11', v: 10 },
                        { day: '2014-03-12', v: 15 },
                        { day: '2014-03-13', v: 12 },
                        { day: '2014-03-14', v: 5  },
                        { day: '2014-03-15', v: 5  },
                        { day: '2014-03-16', v: 20 }
                    ];
                    Morris.Line({
                        element: 'hero-graph',
                        data: uploads_data,
                        xkey: 'day',
                        ykeys: ['v'],
                        labels: ['Value'],
                        lineColors: ['#fff'],
                        lineWidth: 2,
                        pointSize: 4,
                        gridLineColor: 'rgba(255,255,255,.5)',
                        resize: true,
                        gridTextColor: '#fff',
                        xLabels: "day",
                        xLabelFormat: function(d) {
                            return ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov', 'Dec'][d.getMonth()] + ' ' + d.getDate();
                        }
                    });
                });
            </script>
            <!-- / Javascript -->

            <div class="stat-panel">
                <div class="stat-row">
                    <!-- Small horizontal padding, bordered, without right border, top aligned text -->
                    <div class="stat-cell col-sm-4 padding-sm-hr bordered no-border-r valign-top">
                        <!-- Small padding, without top padding, extra small horizontal padding -->
                        <h4 class="padding-sm no-padding-t padding-xs-hr"><i class="fa fa-cloud-upload text-primary"></i>&nbsp;&nbsp;Uploads</h4>
                        <!-- Without margin -->
                        <ul class="list-group no-margin">
                            <!-- Without left and right borders, extra small horizontal padding, without background, no border radius -->
                            <li class="list-group-item no-border-hr padding-xs-hr no-bg no-border-radius">
                                Documents <span class="label label-pa-purple pull-right">34</span>
                            </li> <!-- / .list-group-item -->
                            <!-- Without left and right borders, extra small horizontal padding, without background -->
                            <li class="list-group-item no-border-hr padding-xs-hr no-bg">
                                Audio <span class="label label-danger pull-right">128</span>
                            </li> <!-- / .list-group-item -->
                            <!-- Without left and right borders, without bottom border, extra small horizontal padding, without background -->
                            <li class="list-group-item no-border-hr no-border-b padding-xs-hr no-bg">
                                Videos <span class="label label-success pull-right">12</span>
                            </li> <!-- / .list-group-item -->
                        </ul>
                    </div> <!-- /.stat-cell -->
                    <!-- Primary background, small padding, vertically centered text -->
                    <div class="stat-cell col-sm-8 bg-primary padding-sm valign-middle">
                        <div id="hero-graph" class="graph" style="height: 230px;"></div>
                    </div>
                </div>
            </div> <!-- /.stat-panel -->
            <!-- /5. $UPLOADS_CHART -->

            <!-- 6. $EASY_PIE_CHARTS ===========================================================================

                            Easy Pie charts
            -->
            <!-- Javascript -->
            <script>
                init.push(function () {
                    // Easy Pie Charts
                    var easyPieChartDefaults = {
                        animate: 2000,
                        scaleColor: false,
                        lineWidth: 6,
                        lineCap: 'square',
                        size: 90,
                        trackColor: '#e5e5e5'
                    }
                    $('#easy-pie-chart-1').easyPieChart($.extend({}, easyPieChartDefaults, {
                        barColor: PixelAdmin.settings.consts.COLORS[1]
                    }));
                    $('#easy-pie-chart-2').easyPieChart($.extend({}, easyPieChartDefaults, {
                        barColor: PixelAdmin.settings.consts.COLORS[1]
                    }));
                    $('#easy-pie-chart-3').easyPieChart($.extend({}, easyPieChartDefaults, {
                        barColor: PixelAdmin.settings.consts.COLORS[1]
                    }));
                });
            </script>
            <!-- / Javascript -->

            <div class="row">
                <div class="col-xs-4">
                    <!-- Centered text -->
                    <div class="stat-panel text-center">
                        <div class="stat-row">
                            <!-- Dark gray background, small padding, extra small text, semibold text -->
                            <div class="stat-cell bg-dark-gray padding-sm text-xs text-semibold">
                                <i class="fa fa-globe"></i>&nbsp;&nbsp;BANDWIDTH
                            </div>
                        </div> <!-- /.stat-row -->
                        <div class="stat-row">
                            <!-- Bordered, without top border, without horizontal padding -->
                            <div class="stat-cell bordered no-border-t no-padding-hr">
                                <div class="pie-chart" data-percent="43" id="easy-pie-chart-1">
                                    <div class="pie-chart-label">12.3TB</div>
                                </div>
                            </div>
                        </div> <!-- /.stat-row -->
                    </div> <!-- /.stat-panel -->
                </div>
                <div class="col-xs-4">
                    <div class="stat-panel text-center">
                        <div class="stat-row">
                            <!-- Dark gray background, small padding, extra small text, semibold text -->
                            <div class="stat-cell bg-dark-gray padding-sm text-xs text-semibold">
                                <i class="fa fa-flash"></i>&nbsp;&nbsp;PICK LOAD
                            </div>
                        </div> <!-- /.stat-row -->
                        <div class="stat-row">
                            <!-- Bordered, without top border, without horizontal padding -->
                            <div class="stat-cell bordered no-border-t no-padding-hr">
                                <div class="pie-chart" data-percent="93" id="easy-pie-chart-2">
                                    <div class="pie-chart-label">93%</div>
                                </div>
                            </div>
                        </div> <!-- /.stat-row -->
                    </div> <!-- /.stat-panel -->
                </div>
                <div class="col-xs-4">
                    <div class="stat-panel text-center">
                        <div class="stat-row">
                            <!-- Dark gray background, small padding, extra small text, semibold text -->
                            <div class="stat-cell bg-dark-gray padding-sm text-xs text-semibold">
                                <i class="fa fa-cloud"></i>&nbsp;&nbsp;USED RAM
                            </div>
                        </div> <!-- /.stat-row -->
                        <div class="stat-row">
                            <!-- Bordered, without top border, without horizontal padding -->
                            <div class="stat-cell bordered no-border-t no-padding-hr">
                                <div class="pie-chart" data-percent="75" id="easy-pie-chart-3">
                                    <div class="pie-chart-label">12GB</div>
                                </div>
                            </div>
                        </div> <!-- /.stat-row -->
                    </div> <!-- /.stat-panel -->
                </div>
            </div>
        </div>
        <!-- /6. $EASY_PIE_CHARTS -->

        <div class="col-md-4">
            <div class="row">

                <!-- 7. $EARNED_TODAY_STAT_PANEL ===================================================================

                                    Earned today stat panel
                -->
                <div class="col-sm-4 col-md-12">
                    <div class="stat-panel">
                        <!-- Danger background, vertically centered text -->
                        <div class="stat-cell bg-danger valign-middle">
                            <!-- Stat panel bg icon -->
                            <i class="fa fa-trophy bg-icon"></i>
                            <!-- Extra large text -->
                            <span class="text-xlg"><span class="text-lg text-slim">$</span><strong>147</strong></span><br>
                            <!-- Big text -->
                            <span class="text-bg">Earned today</span><br>
                            <!-- Small text -->
                            <span class="text-sm"><a href="#">See details in your profile</a></span>
                        </div> <!-- /.stat-cell -->
                    </div> <!-- /.stat-panel -->
                </div>
                <!-- /7. $EARNED_TODAY_STAT_PANEL -->


                <!-- 8. $RETWEETS_GRAPH_STAT_PANEL =================================================================

                                    Retweets graph stat panel
                -->
                <div class="col-sm-4 col-md-12">
                    <!-- Javascript -->
                    <script>
                        init.push(function () {
                            $("#stats-sparklines-3").pixelSparkline([275,490,397,487,339,403,402,312,300], {
                                type: 'line',
                                width: '100%',
                                height: '45px',
                                fillColor: '',
                                lineColor: '#fff',
                                lineWidth: 2,
                                spotColor: '#ffffff',
                                minSpotColor: '#ffffff',
                                maxSpotColor: '#ffffff',
                                highlightSpotColor: '#ffffff',
                                highlightLineColor: '#ffffff',
                                spotRadius: 4,
                                highlightLineColor: '#ffffff'
                            });
                        });
                    </script>
                    <!-- / Javascript -->

                    <div class="stat-panel">
                        <div class="stat-row">
                            <!-- Purple background, small padding -->
                            <div class="stat-cell bg-pa-purple padding-sm">
                                <!-- Extra small text -->
                                <div class="text-xs" style="margin-bottom: 5px;">RETWEETS GRAPH</div>
                                <div class="stats-sparklines" id="stats-sparklines-3" style="width: 100%"></div>
                            </div>
                        </div> <!-- /.stat-row -->
                        <div class="stat-row">
                            <!-- Bordered, without top border, horizontally centered text -->
                            <div class="stat-counters bordered no-border-t text-center">
                                <!-- Small padding, without horizontal padding -->
                                <div class="stat-cell col-xs-4 padding-sm no-padding-hr">
                                    <!-- Big text -->
                                    <span class="text-bg"><strong>312</strong></span><br>
                                    <!-- Extra small text -->
                                    <span class="text-xs text-muted">TWEETS</span>
                                </div>
                                <!-- Small padding, without horizontal padding -->
                                <div class="stat-cell col-xs-4 padding-sm no-padding-hr">
                                    <!-- Big text -->
                                    <span class="text-bg"><strong>1000</strong></span><br>
                                    <!-- Extra small text -->
                                    <span class="text-xs text-muted">FOLLOWERS</span>
                                </div>
                                <!-- Small padding, without horizontal padding -->
                                <div class="stat-cell col-xs-4 padding-sm no-padding-hr">
                                    <!-- Big text -->
                                    <span class="text-bg"><strong>523</strong></span><br>
                                    <!-- Extra small text -->
                                    <span class="text-xs text-muted">FOLLOWING</span>
                                </div>
                            </div> <!-- /.stat-counters -->
                        </div> <!-- /.stat-row -->
                    </div> <!-- /.stat-panel -->
                </div>
                <!-- /8. $RETWEETS_GRAPH_STAT_PANEL -->

                <!-- 9. $UNIQUE_VISITORS_STAT_PANEL ================================================================

                                    Unique visitors stat panel
                -->
                <div class="col-sm-4 col-md-12">
                    <!-- Javascript -->
                    <script>
                        init.push(function () {
                            $("#stats-sparklines-2").pixelSparkline(
                                    [275,490,397,487,339,403,402,312,300,294,411,367,319,416,355,416,371,479,279,361,312,269,402,327,474,422,375,283,384,372], {
                                        type: 'bar',
                                        height: '36px',
                                        width: '100%',
                                        barSpacing: 2,
                                        zeroAxis: false,
                                        barColor: '#ffffff'
                                    });
                        });
                    </script>
                    <!-- / Javascript -->

                    <div class="stat-panel">
                        <div class="stat-row">
                            <!-- Warning background -->
                            <div class="stat-cell bg-warning">
                                <!-- Big text -->
                                <span class="text-bg">11% more</span><br>
                                <!-- Small text -->
                                <span class="text-sm">Unique visitors today</span>
                            </div>
                        </div> <!-- /.stat-row -->
                        <div class="stat-row">
                            <!-- Warning background, small padding, without top padding, horizontally centered text -->
                            <div class="stat-cell bg-warning padding-sm no-padding-t text-center">
                                <div id="stats-sparklines-2" class="stats-sparklines" style="width: 100%"></div>
                            </div>
                        </div> <!-- /.stat-row -->
                    </div> <!-- /.stat-panel -->
                </div>
            </div>
        </div>
    </div>
    <!-- /9. $UNIQUE_VISITORS_STAT_PANEL -->

@endsection