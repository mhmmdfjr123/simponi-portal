@extends('layouts.front')

@section('content')
    <section id="simulation-content" class="section-box">
        <div class="container">
            <img class="contentimage" src="{{ asset('theme/front/images/header/simulation.jpg') }}" alt="Content" />
            <h2>Simulasi BNI Simponi Berdasarkan Iuran.</h2>
            <form id="simulation-form" class="row col-xs-12">
                <div class="left-side col-sm-6 col-xs-12">
                    {{-- <!-- <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input class="form-control" type="text" placeholder="Masukkan Nama Lengkap" />
                    </div>
                    <div class="form-group">
                        <label>Alamat Email</label>
                        <input class="form-control" type="email" placeholder="Masukkan Alamat Email" />
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <div class="date-control">
                            <select class="form-control">
                                <option>Pilih Tanggal</option>
                                @for ($i = 1; $i <= 31; $i++)
                                    <option data-value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            <select class="form-control">
                                <option>Pilih Bulan</option>
                                <option>Januari</option>
                                <option>Februari</option>
                                <option>Maret</option>
                                <option>April</option>
                                <option>Mei</option>
                                <option>Juni</option>
                                <option>Juli</option>
                                <option>Agustus</option>
                                <option>September</option>
                                <option>Oktober</option>
                                <option>November</option>
                                <option>Desember</option>
                            </select>
                            <select class="form-control">
                                <option>Pilih Tahun</option>
                                <option>1989</option>
                                <option>1990</option>
                                <option>1991</option>
                                <option>1992</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <div class="radio">
                            <label>
                                <input type="radio" name="genderRadio">
                                Perempuan
                            </label>
                            <label>
                                <input type="radio" name="genderRadio">
                                Laki-laki
                            </label>
                        </div>
                    </div> --> --}}
                    <div class="form-group">
                        <label>Usia Anda</label>
                        <select id="age" class="form-control">
                        @for ($i = 20; $i <= 50; $i++)
                            <option data-value="{{ $i }}">{{ $i }} tahun</option>
                        @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Rencana Usia Pensiun</label>
                        <select id="retirement-age" class="form-control">
                        @for ($i = 45; $i <= 60; $i += 5)
                            <option data-value="{{ $i }}">{{ $i }} tahun</option>
                        @endfor
                        </select>
                    </div>
                </div>
                <div class="right-side col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label>Pembayaran Dana Awal</label>
                        <div class="radio">
                            <label>
                                <input type="radio" name="topupRadio" required />
                                Tidak ada
                            </label>
                            <label>
                                <input type="radio" name="topupRadio" />
                                Sekali
                            </label>
                            <label>
                                <input type="radio" name="topupRadio" />
                                Tiap tahun
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Dana Awal</label>
                        <div class="input-group">
                            <div class="input-group-addon">Rp</div>
                            <input id="starting-balance" class="form-control currency" type="text" placeholder="Masukkan Dana Awal" data-value="0" disabled />
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Tipe Pembayaran Iuran</label>
                        <div class="radio">
                            <label>
                                <input type="radio" name="billingRadio" required />
                                Bulanan
                            </label>
                            <label>
                                <input type="radio" name="billingRadio" />
                                Tahunan
                            </label>
                        </div>
                    </div>
                    <div class="form-group billing">
                        <label>Iuran</label>
                        <div class="input-group">
                            <div class="input-group-addon">Rp</div>
                            <input class="form-control currency" type="text" placeholder="Masukkan Iuran" data-value="0" disabled required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Kenaikan Iuran Per Tahun</label>
                        <div class="input-group">
                            <input id="billing-increment" class="form-control percentage" type="text" placeholder="Masukkan Kenaikan Iuran Per Tahun" data-value="0" disabled />
                            <div class="input-group-addon">%</div>
                        </div>
                    </div>
                </div>
                <div class="variables col-xs-12">
                    <div class="form-group col-sm-4 col-xs-12">
                        <label>Tingkat Bunga DPLK</label>
                        <select id="interest-rate" class="form-control">
                            <option data-value="0.080">8.0%</option>
                            <option data-value="0.090">9.0%</option>
                            <option data-value="0.100">10.0%</option>
                            <option data-value="0.110">11.0%</option>
                            <option data-value="0.120">12.0%</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-4 col-xs-12">
                        <label>Biaya Administrasi (Per Tahun)</label>
                        <div class="input-group">
                            <div class="input-group-addon">Rp</div>
                            <input id="administration-fee" class="form-control" type="text" value="18.000" data-value="18000" disabled />
                        </div>
                    </div>
                    <div class="form-group col-sm-4 col-xs-12">
                        <label>Biaya Pengelolaan Dana</label>
                        <input id="management-fee" class="form-control" type="text" value="0.85% dari akumulasi dana per tahun" data-value="0.0085" disabled />
                    </div>
                    <div class="form-group col-sm-offset-4 col-sm-4 col-xs-12">
                        <a class="calculate col-xs-12 btn btn-lg btn-primary">Hitung</a>
                        <a class="hidden-xs hidden-sm hidden-md hidden-lg page-scroll" href="#simulation"></a>
                        <a class="hidden-xs hidden-sm hidden-md hidden-lg page-scroll" href="#simulation-form"></a>
                    </div>
                </div>
                <canvas id="simulation" class="col-xs-12" height="250"></canvas>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div id="total-funding" class="simulationresult section-box-item">
                        <label>Total Iuran<a class="material-icons info" data-toggle="tooltip" title="Total iuran adalah dana awal ditambah iuran Anda (per bulan / tahun sesuai pilihan Anda) mulai dari pembukaan rekening hingga berakhirnya masa rekening Anda (sesuai usia pensiun Anda)."><i class="fa fa-info-circle"></i></a></label>
                        <span>N/A</span>
                        <b></b>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div id="total-development" class="simulationresult section-box-item">
                        <label>Hasil Pengembangan<a class="material-icons info" data-toggle="tooltip" title="Hasil pengembangan adalah jumlah perkembangan total iuran mulai dari pembukaan rekening DPLK hingga berakhirnya masa rekening DPLK Anda (sesuai usia pensiun Anda)."><i class="fa fa-info-circle"></i></a></label>
                        <span>N/A</span>
                        <b></b>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div id="total-fund" class="simulationresult section-box-item">
                        <label>Total Dana Manfaat<a class="material-icons info" data-toggle="tooltip" title="Total dana manfaat adalah dana yang bisa Anda klaim di akhir masa rekening DPLK Anda (sesuai usia pensiun Anda)"><i class="fa fa-info-circle"></i></a></label>
                        <span>N/A</span>
                        <b></b>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('footScript')
    <script src="{{ asset('theme/front/vendor/chartjs/Chart.min.js') }}"></script>
    <script src="{{ asset('theme/front/vendor/jquery-numeric/jquery.numeric.js') }}"></script>
    <script src="{{ asset('theme/front/vendor/jquery-animate-number/jquery.animateNumber.min.js') }}"></script>
    <script src="{{ mix('theme/front/js/pages/simulation.js') }}"></script>
@endsection