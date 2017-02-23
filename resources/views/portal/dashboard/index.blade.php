@extends('layouts.front')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="portal-sidebar">
                    <!-- SIDEBAR user-PIC -->
                    <div class="portal-user-pic">
                        <img src="http://keenthemes.com/preview/metronic/theme/assets/admin/pages/media/portal/portal_user-.jpg" class="img-responsive" alt="">
                    </div>
                    <!-- END SIDEBAR user-PIC -->

                    <!-- SIDEBAR user- TITLE -->
                    <div class="portal-user-title">
                        <div class="portal-user-title-name">
                            Efriandika Pratama
                        </div>
                        {{--<div class="portal-user-title-job">
                            Developer
                        </div>--}}
                    </div>
                    <!-- END SIDEBAR user- TITLE -->

                    <!-- SIDEBAR BUTTONS -->
                    <div class="portal-user-buttons">
                        <button type="button" class="btn btn-success btn-sm">Follow</button>
                        <button type="button" class="btn btn-danger btn-sm">Message</button>
                    </div>
                    <!-- END SIDEBAR BUTTONS -->

                    <!-- SIDEBAR MENU -->
                    <div class="portal-user-menu">
                        <ul class="nav">
                            <li class="active">
                                <a href="#"><i class="glyphicon glyphicon-home"></i> Overview </a>
                            </li>
                            <li>
                                <a href="#"><i class="glyphicon glyphicon-user"></i> Profile </a>
                            </li>
                            <li>
                                <a href="#" target="_blank"><i class="glyphicon glyphicon-download"></i> Download </a>
                            </li>
                            <li>
                                <a href="#"><i class="glyphicon glyphicon-flag"></i> Help </a>
                            </li>
                        </ul>
                    </div>
                    <!-- END MENU -->
                </div>
            </div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-body">
                        This page is under construction
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footScript')

@endsection