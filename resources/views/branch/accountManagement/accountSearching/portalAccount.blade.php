@extends('layouts.branch')

@section('content')
    <div class="container branch-container">
        <h3>{{ $pageTitle }}</h3>
        <hr class="title">

        <p class="help-block">Anda saat ini login sebagai: {{ $user->username }}</p>

        <div class="account-search-box-wrapper">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs nav-justified" id="account-type-tab" role="tablist">
                <li role="presentation"><a href="#individual" aria-controls="home" role="tab" data-toggle="tab">Perorangan</a></li>
                <li role="presentation"><a href="#company" aria-controls="profile" role="tab" data-toggle="tab">Perusahaan</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="individual">
                    <div class="account-search-box">
                        <form class="form-individual" method="post" action="{{ route('branch-search-individual-account') }}">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <input type="text" class="form-control input-lg text-center" name="accountPerorangan" placeholder="Nomor Akun DPLK" autocomplete="off" required />
                            </div>

                            <button type="submit" class="btn btn-primary">
                                <small><i class="ion-ios-search-strong" style="margin-right: 5px"></i> <strong>CARI AKUN PERORANGAN</strong></small>
                            </button>
                        </form>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="company">
                    <div class="account-search-box">
                        <form class="form-company" method="post" action="{{ route('branch-search-company-account') }}">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <input type="text" class="form-control input-lg text-center" name="accountPerusahaan" placeholder="Nomor Kolektif Perusahaan" autocomplete="off" required />
                            </div>

                            <button type="submit" class="btn btn-primary text-uppercase">
                                <small><i class="ion-ios-search-strong" style="margin-right: 5px"></i> <strong>Cari Akun Perusahaan</strong></small>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="branch-announcement">
            @widget('branchAnnouncement', [])
        </div>
    </div>
@endsection

@section('footScript')
    <script type="text/javascript">
        $(function () {
            var $formIndividual = $('.form-individual');
            var $formCompany = $('.form-company');

            $formIndividual.validate();
            $formIndividual.submit(function(e){
                if($(this).valid()){
                    $formIndividual.find('input.form-control').attr('readonly', true);
                }
            });

            $formCompany.validate();
            $formCompany.submit(function(e){
                if($(this).valid()){
                    $formCompany.find('input.form-control').attr('readonly', true);
                }
            });

            // Check form state
            var activeForm = '{{ Session::get('activeForm') }}';
            activeForm = '#' + (activeForm != '' ? activeForm : 'individual');

            $('#account-type-tab').find('a[href="' + activeForm + '"]').tab('show');
        });
    </script>
@endsection