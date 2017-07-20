@extends('layouts.branch')

@section('content')
    <div class="container branch-container">
        <h3>{{ $pageTitle }}</h3>
        <hr class="title">

        <p class="help-block">Anda saat ini login sebagai: {{ $user->username }}</p>

        <div class="row" style="margin-top: 20px">
            <div class="col-md-6">
                <table class="account-detail">
                    <tr>
                        <th>Nomor Kolektif Perusahaan</th>
                        <td>{{ $customer->nokol }}</td>
                    </tr>
                    <tr>
                        <th>Nama Perusahaan</th>
                        <td>{{ $customer->companyName }}</td>
                    </tr>
                    <tr>
                        <th>No. ID</th>
                        <td>{{ $customer->identityType }}: {{ $customer->identityNumber }}</td>
                    </tr>
                    <tr>
                        <th>Tipe Perusahaan</th>
                        <td>{{ $customer->companyType }}</td>
                    </tr>
                    <tr>
                        <th>Tipe Industri</th>
                        <td>{{ $customer->industryType }}</td>
                    </tr>
                    <tr>
                        <th>Sektor</th>
                        <td>{{ $customer->sectorType }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>
                            {{ $customer->address1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>Telepon</th>
                        <td>
                            {{ $customer->phoneNumber }}
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <div class="branch-announcement full-width no-margin-top">
                    @widget('branchAnnouncement', [])
                </div>

                @if(count($notCompleteDataAlert) > 0 ? 'disabled' : '')
                <div class="alert alert-danger text-left">
                    <strong>Data Belum Lengkap</strong>
                    <ul>
                        @foreach($notCompleteDataAlert as $alert)
                        <li>{{ $alert }}</li>
                        @endforeach
                    </ul>

                    <div style="margin-top: 20px">"Mohon lengkapi data perusahaan di DPLK Smile"</div>
                </div>
                @endif

                <form method="post" action="{{ route('branch-company-registration', [$encryptedId]) }}" class="form-register text-left">
                    {{ csrf_field() }}

                    <input type="hidden" name="accountPerusahaan" value="{{ $customer->nokol  }}">
                    <input type="hidden" name="namaPerusahaan" value="{{ $customer->companyName  }}">
                    <input type="hidden" name="identityPerusahaan" value="{{ $customer->identityNumber  }}">

                    <div class="form-group">
                        <input type="email" name="personInChargeEmail" value="{{ old('personInChargeEmail') }}" class="form-control input-lg" placeholder="Alamat Email PIC" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <input type="text" name="personInChargePhone" value="{{ old('personInChargePhone') }}" class="form-control input-lg" placeholder="Nomor Handphone PIC" required autocomplete="off">
                    </div>

                    <button type="submit" {!! (count($notCompleteDataAlert) > 0 ? 'disabled' : '') !!} class="btn btn-success btn-md-uppercase" id="btn-register" data-loading-text="Mohon tunggu...">
                        <i class="ion-android-add" style="margin-right: 5px"></i> Register
                    </button>

                    <a href="{{ route('branch-dashboard') }}" class="btn btn-sm btn-primary btn-outline">Batal</a>
                </form>

                {{--<div class="line-text">
                    <hr />
                    <span class="w-60">atau</span>
                </div>--}}
            </div>
        </div>
    </div>
@endsection

@section('footScript')
    <script type="text/javascript">
        $(function () {
            const $formRegister = $(".form-register");

            $formRegister.validate();

            $formRegister.submit(function(e){
                if($(this).valid()){
                    $('input.form-control').attr('readonly', true);
                    $('#btn-register').button('loading');
                }
            });
        });
    </script>
@endsection