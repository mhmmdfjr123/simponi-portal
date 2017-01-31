@extends('layouts.front')

@section('content')
    <section id="content">
        <div class="container">
            <div class="row">
                <form class="col-lg-12 text-justify">
                    <img class="contentimage" src="{{ asset('theme/front/images/header/simulation.jpg') }}" alt="Content" />
                    <h2>Simulasi DPLK BNI.</h2>
                    <div class="identity col-sm-6">
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
                                    <option>1960</option>
                                    <option>1961</option>
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
                            <select class="form-control">
                                <option>50 tahun</option>
                                <option>55 tahun</option>
                                <option>60 tahun</option>
                            </select>
                        </div>
                    </div>
                    <div class="billing col-sm-6">
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
                                <input class="form-control" type="number" placeholder="Masukkan Dana Awal" />
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
                        <div class="form-group">
                            <label>Iuran Per Tahun</label>
                            <div class="input-group">
                                <div class="input-group-addon">Rp</div>
                                <input class="form-control" type="number" placeholder="Masukkan Iuran Per Tahun" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Kenaikan Iuran Per Tahun</label>
                            <div class="input-group">
                                <div class="input-group-addon">Rp</div>
                                <input class="form-control" type="number" placeholder="Masukkan Kenaikan Iuran Per Tahun" />
                            </div>
                        </div>
                    </div>
                    <div class="variables col-sm-12">
                        <div class="form-group col-sm-4">
                            <label>Tingkat Bunga DPLK</label>
                            <select class="form-control">
                                <option>8.0%</option>
                                <option>9.0%</option>
                                <option>10.0%</option>
                                <option>11.0%</option>
                                <option>12.0%</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>Biaya Administrasi (Per Tahun)</label>
                            <div class="input-group">
                                <div class="input-group-addon">Rp</div>
                                <input class="form-control" type="text" value="Rp18.000" disabled />
                            </div>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>Biaya Pengelolaan Dana</label>
                            <input class="form-control" type="text" value="0.85% dari akumulasi dana per tahun" disabled />
                        </div>
                    </div>
                    <canvas id="simulation" class="col-sm-12" height="250"></canvas>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('footScript')
    <script src="{{ asset('theme/front/vendor/chartjs/chart.min.js') }}"></script>
    <script src="{{ asset('theme/front/js/pages/simulation.js') }}"></script>
@endsection