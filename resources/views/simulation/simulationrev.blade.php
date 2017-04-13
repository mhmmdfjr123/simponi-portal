@extends('layouts.front')

@section('content')
    <section id="simulation-content" class="section-box">
        <div class="container">
            {{-- <!-- <img class="contentimage" src="{{ asset('theme/front/images/header/simulation.jpg') }}" alt="Content" /> --> --}}
            <h2>
                Simulasi BNI Simponi Berdasarkan Kebutuhan.
                <a href="/simulation" style="margin-top:10px;font-size:16px;float:right;">→ Simulasi Berdasarkan Iuran</a>
            </h2>
            <form id="simulation-form" class="rev col-xs-12">
                <div class="left-side col-sm-4 col-xs-12">
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
                    </div>
                    <div class="form-group">
                        <label>Usia Anda</label>
                        <select id="age" class="form-control" data-target="#duration,#living-cost-after,#living-cost-total">
                        @for ($i = 20; $i <= 50; $i++)
                            <option data-value="{{ $i }}">{{ $i }} tahun</option>
                        @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Rencana Usia Pensiun</label>
                        <select id="retirement-age" class="form-control" data-target="#duration,#duration-after,#living-cost-after,#living-cost-total">
                        @for ($i = 45; $i <= 60; $i += 5)
                            <option data-value="{{ $i }}">{{ $i }} tahun</option>
                        @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Usia Harapan Hidup</label>
                        <select id="life-expectancy" class="form-control" data-target="#duration-after,#living-cost-total">
                        @for ($i = 60; $i <= 100; $i += 5)
                            <option data-value="{{ $i }}">{{ $i }} tahun</option>
                        @endfor
                        </select>
                    </div> --> --}}
                    <div class="form-group">
                        <label>Usia Anda</label>
                        <input id="age" class="form-control numeric validatenow numstart" type="text" placeholder="Masukkan Usia Anda" data-target="#duration,#living-cost-after,#living-cost-total" data-value="0" data-min-value="17" data-message="Usia tidak boleh kurang dari 17 dan lebih dari 55 tahun" data-numstart-target="#retirement-age" data-numstart-message="Usia tidak boleh sama atau lebih dari Rencana Usia Pensiun" required />
                        <small style="display:block"><i>Usia minimum pembukaan rekening BNI Simponi adalah 17 tahun.</i></small>
                    </div>
                    <div class="form-group">
                        <label>Rencana Usia Pensiun</label>
                        <input id="retirement-age" class="form-control numeric validatenow numstart" type="text" placeholder="Masukkan Usia Pensiun" data-target="#duration,#duration-after,#living-cost-after,#living-cost-total" data-value="0" data-min-value="40" data-message="Rencana Usia Pensiun tidak boleh kurang dari 40 tahun" data-numstart-target="#life-expectancy" data-numstart-message="Rencana Usia Pensiun tidak boleh sama atau lebih dari Usia Harapan Hidup" required />
                        <small style="display:block"><i>Usia Pensiun minimum untuk nasabah baru BNI Simponi adalah 40 tahun.</i></small>
                    </div>
                    <div class="form-group" style="display:none;">
                        <label>Jangka Waktu Sebelum Pensiun</label>
                        <input id="duration" class="form-control" type="text" value="N/A" data-value="0" disabled />
                    </div>
                    <div class="form-group">
                        <label>Usia Harapan Hidup</label>
                        <input id="life-expectancy" class="form-control numeric" type="text" placeholder="Masukkan Usia Harapan Hidup" data-target="#duration-after,#living-cost-total" data-value="0" required />
                        <small style="display:block"><i>Usia Harapan Hidup rata-rata di Indonesia adalah 80 tahun.</i></small>
                    </div>
                    <div class="form-group" style="display:none;">
                        <label>Jangka Waktu Masa Pensiun</label>
                        <input id="duration-after" class="form-control" type="text" value="N/A" data-value="0" disabled />
                    </div>
                </div>
                <div class="middle-side col-sm-4 col-xs-12">
                    <div class="form-group">
                        <label>Biaya Hidup Saat Ini</label>
                        <div class="input-group">
                            <div class="input-group-addon">Rp</div>
                            <input id="living-cost" class="form-control currency numeric" type="text" placeholder="Masukkan Biaya Hidup Saat Ini" data-value="0" data-target="#living-cost-after,#living-cost-total" required />
                        </div>
                        <small style="display:block"><i>Biaya Hidup Anda per bulan.</i></small>
                    </div>
                    <div class="form-group">
                        <label>Asumsi Inflasi Per Tahun</label>
                        <div class="input-group">
                            <input id="inflation-rate" class="form-control percentage numeric validatenow" type="text" placeholder="Masukkan Asumsi Inflasi Per Tahun" data-value="0" data-min-value="1" data-max-value="20" data-message="Asumsi Inflasi Per Tahun tidak boleh lebih rendah dari 1% dan lebih tinggi dari 20%" data-target="#living-cost-after,#living-cost-total" required />
                            <div class="input-group-addon">%</div>
                        </div>
                        <small style="display:block"><i>Rata-rata tingkat inflasi di Indonesia adalah 3-6% per tahun.</i></small>
                    </div>
                    <div class="form-group" style="display:none;">
                        <label>Biaya Hidup Saat Pensiun</label>
                        <div class="input-group">
                            <div class="input-group-addon">Rp</div>
                            <input id="living-cost-after" class="form-control" type="text" value="N/A" data-value="0" disabled />
                        </div>
                    </div>
                    <div class="form-group" style="display:none;">
                        <label>Total Biaya Hidup Masa Pensiun</label>
                        <div class="input-group">
                            <div class="input-group-addon">Rp</div>
                            <input id="living-cost-total" class="form-control" type="text" value="N/A" data-value="0" disabled />
                        </div>
                    </div>
                    {{-- <!-- <div class="form-group">
                        <label>Target Investasi</label>
                        <select id="investation-rate" class="form-control">
                        @for ($i = 1; $i <= 25; $i++)
                            <option data-value="{{ $i / 100 }}">{{ $i }}.0%</option>
                        @endfor
                        </select>
                    </div> --> --}}
                    <div class="form-group">
                        <label>Target Investasi</label>
                        <div class="input-group">
                            <input id="investation-rate" class="form-control percentage numeric validatenow" type="text" placeholder="Masukkan Target Investasi" data-value="0" data-min-value="1" data-max-value="25" data-message="Target Investasi tidak boleh lebih rendah dari 1% dan lebih tinggi dari 25%" required />
                            <div class="input-group-addon">%</div>
                        </div>
                        <small style="display:block"><i>Target Investasi minimum 1% dan maksimum 25%. Lihat <a href="/faq#faq-category-25" target="_blank">FAQ</a> untuk melihat tingkat bunga dari setiap paket investasi DPLK BNI.</i></small>
                    </div>
                </div>
                <div class="right-side col-sm-4 col-xs-12">
                    <a class="calculate col-xs-12 btn btn-lg btn-primary">Hitung</a>
                    <a class="hidden-xs hidden-sm hidden-md hidden-lg page-scroll" href="#simulation"></a>
                    <a class="hidden-xs hidden-sm hidden-md hidden-lg page-scroll" href="#simulation-form"></a>
                </div>
                <div id="simulation" class="col-xs-12">
                    <div class="narration col-xs-12">
                        Anda memiliki waktu <span data-info="#duration">0</span> tahun hingga waktu pensiun Anda tiba. Dengan usia harapan hidup <span data-info="#life-expectancy">0</span> tahun, Anda memiliki jangka waktu masa pensiun selama <span data-info="#duration-after">0</span> tahun. Dengan biaya hidup sebesar Rp<span data-info="#living-cost">0</span> per bulan dan asumsi inflasi sebesar <span data-info="#inflation-rate">0</span>% per tahun, biaya hidup Anda setelah pensiun akan menjadi sebesar Rp<span data-info="#living-cost-after">0</span> dengan total biaya hidup masa pensiun akan menjadi sebesar Rp<span data-info="#living-cost-total">0</span>. Untuk mengakomodasi biaya hidup Anda setelah pensiun sesuai dengan data di atas, Anda bisa melakukan investasi dengan salah satu dari tiga skema setoran berikut:</div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div id="monthly-investation" class="simulationresult section-box-item">
                            <label>Setoran Bulanan*<a class="material-icons info" data-toggle="tooltip" title="Investasi Bulanan adalah iuran atau dana yang harus Anda investasikan setiap bulan sebelum pensiun untuk mencapai target investasi yang Anda inginkan"><i class="fa fa-info-circle"></i></a></label>
                            <span>N/A</span>
                            <b></b>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div id="annual-investation" class="simulationresult section-box-item">
                            <label>Setoran Tahunan*)**)<a class="material-icons info" data-toggle="tooltip" title="Investasi Tahunan adalah iuran atau dana yang harus Anda investasikan setiap satu tahun sekali sebelum pensiun untuk mencapai target investasi yang Anda inginkan"><i class="fa fa-info-circle"></i></a></label>
                            <span>N/A</span>
                            <b></b>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div id="lumpsum" class="simulationresult section-box-item">
                            <label>Setoran Satu Kali*<a class="material-icons info" data-toggle="tooltip" title="Investasi Saat Ini / Lumpsum adalah iuran atau dana yang harus Anda investasikan satu kali sebelum pensiun untuk mencapai target investasi yang Anda inginkan"><i class="fa fa-info-circle"></i></a></label>
                            <span>N/A</span>
                            <b></b>
                        </div>
                    </div>
                    <small class="disclaimer col-xs-12"><i>* Hasil simulasi merupakan estimasi, hasil akhir sebenarnya dapat berbeda</i></small>
                    <small class="disclaimer col-xs-12"><i>** Setoran tahunan dapat dilakukan dengan tetap melakukan setoran Dana Awal minimum sebesar Rp250.000 dalam jangka waktu maksimum 3 bulan setelah pembukaan rekening BNI Simponi</i></small>
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