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
                        <th>Nomor Akun</th>
                        <td>
                            {{ $customer->account }}
                            @if($customer->block == 'Y')
                                <span class="label label-danger">Diblokir</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Tipe Akun</th>
                        <td>{{ $customer->type }}</td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <td>{{ $customer->username }}</td>
                    </tr>
                    <tr>
                        <th>No. ID</th>
                        <td>{{ $customer->idno }}</td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td>{{ $customer->name }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Lahir</th>
                        <td>{{ date('d-m-Y', strtotime($customer->birthdate)) }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $customer->email }}</td>
                    </tr>
                    <tr>
                        <th>Telepon</th>
                        <td>{{ $customer->phone }}</td>
                    </tr>
                    <tr>
                        <th>Gagal Login</th>
                        <td>{{ $customer->failcount }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <div class="branch-announcement full-width">
                    @widget('branchAnnouncement', [])
                </div>

                <div class="panel panel-default">
                    <div class="panel-body">
                        @if($customer->activation != 'ACTIVATED')
                            <a href="javascript:void(0)" onclick="confirmDirectPopUp('{{ route('branch-individual-account-activate', [$encryptedId]) }}', 'Konfirmasi Aktivasi Akun', 'Apakah anda yakin?', 'Aktivasi', 'Batal')" class="btn btn-success btn-md-uppercase">Aktivasi</a>
                        @endif

                        <a href="javascript:void(0)" onclick="loadIntoBox('{{ route('branch-individual-account-change-email', [$encryptedId]) }}')" class="btn btn-default btn-md-uppercase">Ganti Email</a>

                        @if($customer->block == 'Y')
                            <a href="javascript:void(0)" onclick="confirmDirectPopUp('{{ route('branch-individual-account-unblock', [$encryptedId]) }}', 'Konfirmasi Buka Blokir Akun', 'Apakah anda yakin?', 'Buka Blokir', 'Batal')" class="btn btn-default btn-md-uppercase">Buka Blokir</a>
                        @else
                            <a href="javascript:void(0)" onclick="confirmDirectPopUp('{{ route('branch-individual-account-block', [$encryptedId]) }}', 'Konfirmasi Pemblokiran Akun', 'Apakah anda yakin?', 'Blokir', 'Batal')" class="btn btn-default btn-md-uppercase">Blokir</a>
                        @endif

                        <a href="javascript:void(0)" onclick="confirmDirectPopUp('{{ route('branch-individual-account-delete', [$encryptedId]) }}', 'Konfirmasi Hapus Akun', 'Apakah anda yakin?', 'Hapus', 'Batal')" class="btn btn-danger btn-md-uppercase">Hapus Akun</a>
                    </div>
                </div>

                <div class="text-left">
                    <a href="{{ route('branch-dashboard') }}" class="btn btn-sm btn-primary btn-outline"><i class="fa fa-angle-left"></i> Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footScript')
    <script type="text/javascript">
        $(function () {
            // Idn
        });
    </script>
@endsection