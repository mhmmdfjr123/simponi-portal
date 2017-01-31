@extends('layouts.front')

@section('content')
    <section id="content">
        <div class="container">
            <div class="row">
                <form class="col-xs-12 text-justify">
                    <img class="contentimage" src="{{ asset('theme/front/images/simulation.jpg') }}" alt="Content" />
                    <h2>Simulasi DPLK BNI.</h2>
                    <div class="identity col-sm-6 col-xs-12">
                        <div class="form-group">
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
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    <option>6</option>
                                    <option>7</option>
                                    <option>8</option>
                                    <option>9</option>
                                    <option>10</option>
                                    <option>11</option>
                                    <option>12</option>
                                    <option>13</option>
                                    <option>14</option>
                                    <option>15</option>
                                    <option>16</option>
                                    <option>17</option>
                                    <option>18</option>
                                    <option>19</option>
                                    <option>20</option>
                                    <option>21</option>
                                    <option>22</option>
                                    <option>23</option>
                                    <option>24</option>
                                    <option>25</option>
                                    <option>26</option>
                                    <option>27</option>
                                    <option>28</option>
                                    <option>29</option>
                                    <option>30</option>
                                    <option>31</option>
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
                            <label>Rencana Usia Pensiun</label>
                            <select id="retirement-age" class="form-control">
                                <option data-value="45">45 tahun</option>
                                <option data-value="50">50 tahun</option>
                                <option data-value="55">55 tahun</option>
                            </select>
                        </div>
                    </div>
                    <div class="starting-balance col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label>Pembayaran Dana Awal</label>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="topupRadio">
                                    Tidak ada
                                </label>
                                <label>
                                    <input type="radio" name="topupRadio">
                                    Sekali
                                </label>
                                <label>
                                    <input type="radio" name="topupRadio">
                                    Tiap tahun
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Dana Awal</label>
                            <div class="input-group">
                                <div class="input-group-addon">Rp</div>
                                <input id="starting-balance" class="form-control currency" type="text" placeholder="Masukkan Dana Awal" data-value="0" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tipe Pembayaran Iuran</label>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="billingRadio">
                                    Bulanan
                                </label>
                                <label>
                                    <input type="radio" name="billingRadio">
                                    Tahunan
                                </label>
                            </div>
                        </div>
                        <div class="form-group billing">
                            <label>Iuran</label>
                            <div class="input-group">
                                <div class="input-group-addon">Rp</div>
                                <input class="form-control currency" type="text" placeholder="Masukkan Iuran" data-value="0" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Kenaikan Iuran Per Tahun</label>
                            <div class="input-group">
                                <input id="billing-increment" class="form-control percentage" type="text" placeholder="Masukkan Kenaikan Iuran Per Tahun" data-value="0" />
                                <div class="input-group-addon">%</div>
                            </div>
                        </div>
                    </div>
                    <div class="variables col-xs-12">
                        <div class="form-group col-sm-4 col-xs-12">
                            <label>Tingkat Bunga DPLK</label>
                            <select id="interest-rate" class="form-control">
                                <option data-value="8.0">8.0%</option>
                                <option data-value="9.0">9.0%</option>
                                <option data-value="10.0">10.0%</option>
                                <option data-value="11.0">11.0%</option>
                                <option data-value="12.0">12.0%</option>
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
                            <input id="management-fee" class="form-control" type="text" value="0.85% dari akumulasi dana per tahun" data-value="0.85" disabled />
                        </div>
                        <div class="form-group col-sm-offset-4 col-sm-4 col-xs-12">
                            <a class="calculate col-xs-12 btn btn-lg btn-primary">Hitung</a>
                        </div>
                    </div>
                    <canvas id="simulation" class="col-xs-12" height="250"></canvas>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('footScript')
    <script src="{{ asset('theme/front/vendor/chartjs/chart.min.js') }}"></script>
    <script src="{{ asset('theme/front/js/pages/simulation.js') }}"></script>
@endsection