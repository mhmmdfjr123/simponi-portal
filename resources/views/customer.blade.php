@extends('layouts.front')

@section('content')
    <section id="customer">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <a class="profile col-sm-12">
                        <span>
                            <span>RA</span>
                            <!-- <img src="" alt="Profile Picture BNI DPLK" /> -->
                        </span>
                        <span>
                            <span>Romy Adzani Adiputra</span>
                            <span>LIHAT PROFIL</span>
                        </span>
                        <i class="material-icons">keyboard_arrow_right</i>
                    </a>
                    <a class="active col-sm-12">Inkuiri Saldo</a>
                    <a class="col-sm-12">Mutasi Rekening</a>
                    <a class="col-sm-12">Form Downloads</a>
                </div>
                <div class="col-sm-8">
                    <div data-active="1">
                        <form class="col-sm-3">
                            <h2>Informasi Profil</h2>
                            <div class="form-group">
                                <label>Nama Depan:</label>
                                <span>Romy Adzani</span>
                            </div>
                            <div class="form-group">
                                <label>Nama Belakang:</label>
                                <span>Adiputra</span>
                            </div>
                            <div class="form-group">
                                <label>Nomor Akun:</label>
                                <span class="account">
                                    <span>78983485473</span>
                                    <span>78394857632</span>
                                    <span>90837888888</span>
                                </span>
                            </div>
                            <h2>Atur Profil</h2>
                            <div class="form-group">
                                <label>Kata Sandi Lama</label>
                                <div>
                                    <div class="input-group">
                                        <input class="form-control" type="password" placeholder="Masukkan Kata Sandi Lama" />
                                        <a class="input-group-addon reveal"><i class="material-icons">remove_red_eye</i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Kata Sandi Baru</label>
                                <div>
                                    <div class="input-group">
                                        <input class="form-control" type="password" placeholder="Masukkan Kata Sandi Baru" />
                                        <a class="input-group-addon reveal"><i class="material-icons">remove_red_eye</i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Konfirmasi Kata Sandi Baru</label>
                                <div>
                                    <div class="input-group">
                                        <input class="form-control" type="password" placeholder="Konfirmasi Kata Sandi Baru" />
                                        <a class="input-group-addon reveal"><i class="material-icons">remove_red_eye</i></a>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary">Simpan</button>
                        </form>
                        <form class="col-sm-3">
                            <h2>Inkuiri Saldo</h2>
                            <div class="form-group">
                                <label>Pilih Akun:</label>
                                <select class="form-control">
                                    <option>78983485473</option>
                                    <option>78394857632</option>
                                    <option>90837888888</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Jumlah Saldo:</label>
                                <span>Rp2.000.000</span>
                            </div>
                            <button class="btn btn-primary">Proses</button>
                        </form>
                        <form class="col-sm-3">
                            <h2>Mutasi Rekening</h2>
                            <div class="form-group">
                                <label>Pilih Akun:</label>
                                <select class="form-control">
                                    <option>78983485473</option>
                                    <option>78394857632</option>
                                    <option>90837888888</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Jangka Waktu:</label>
                                <select class="form-control">
                                    <option>1 minggu terakhir</option>
                                    <option>2 minggu terakhir</option>
                                    <option>1 bulan terakhir</option>
                                </select>
                            </div>
                            <button class="btn btn-primary">Proses</button>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Transaksi</th>
                                            <th>Nilai</th>
                                            <th>Saldo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>01/02/2017</td>
                                            <td>Setor tunai.</td>
                                            <td>Rp1.000.000</td>
                                            <td>Rp1.000.000</td>
                                        </tr>
                                        <tr>
                                            <td>01/03/2017</td>
                                            <td>Setor tunai.</td>
                                            <td>Rp2.000.000</td>
                                            <td>Rp3.000.000</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </form>

                        <div class="col-sm-3">
                            <h2>Form Downloads</h2>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nama File</th>
                                            <th>Deskripsi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Form_Pembukaan_Rekening_DPLK.pdf</td>
                                            <td>Form untuk nasabah yang ingin membuka rekening DPLK.</td>
                                            <td><a class="btn btn-primary">Download</a></td>
                                        </tr>
                                        <tr>
                                            <td>Form_Klaim_Rekening_DPLK.pdf</td>
                                            <td>Form untuk nasabah yang ingin melakukan klaim atas rekening DPLK yang dimiliki.</td>
                                            <td><a class="btn btn-primary">Download</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footScript')
    <script src="{{ asset('theme/front/js/pages/customer.js') }}"></script>
@endsection