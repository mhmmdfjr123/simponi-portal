@extends('layouts.front', ['navbar' => 'navbar-bg'])

@section('content')
    <section id="content">
        <div class="container">
            <div class="row">
                <form class="col-lg-12 text-justify">
                    <img class="contentimage" src="{{ asset('theme/front/images/simulation.jpg') }}" alt="Content" />
                    <h2>Pembukaan Baru Rekening DPLK BNI.</h2>
                    <div class="applynew form-horizontal col-sm-12">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">
                                Nama Lengkap
                                <small class="help-block"><i>(Sesuai Tanda Pengenal)</i></small>
                            </label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Masukkan Nama Lengkap" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nama Alias</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Masukkan Nama Alias" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Salutasi</label>
                            <div class="col-sm-10 radio">
                                <label>
                                    <input type="radio" name="salutationRadio">
                                    Bpk
                                </label>
                                <label>
                                    <input type="radio" name="salutationRadio">
                                    Ibu
                                </label>
                                <label>
                                    <input type="radio" name="salutationRadio">
                                    Sdr
                                </label>
                                <label>
                                    <input type="radio" name="salutationRadio">
                                    Sdri
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Jenis Kelamin</label>
                            <div class="col-sm-10 radio">
                                <label>
                                    <input type="radio" name="genderRadio">
                                    Pria
                                </label>
                                <label>
                                    <input type="radio" name="genderRadio">
                                    Wanita
                                </label>
                            </div>
                        </div>
                        <div class="form-group nationality">
                            <label class="col-sm-2 control-label">Kewarganegaraan</label>
                            <div class="col-sm-10 radio">
                                <label>
                                    <input type="radio" name="nationalityRadio">
                                    WNI
                                </label>
                                <label>
                                    <input type="radio" name="nationalityRadio">
                                    WNA
                                </label>
                                <select class="form-control" disabled>
                                    <option>Pilih Kewarganegaraan</option>
                                    <option>United States</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tanda Pengenal</label>
                            <div class="col-sm-10 radio">
                                <label>
                                    <input type="radio" name="idRadio">
                                    KTP
                                </label>
                                <label>
                                    <input type="radio" name="idRadio">
                                    SIM
                                </label>
                                <label>
                                    <input type="radio" name="idRadio">
                                    Paspor
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nomor Tanda Pengenal</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Masukkan Nomor Tanda Pengenal" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Masa Berlaku</label>
                            <div class="date-control col-sm-10">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="expirationCheckbox">
                                        Seumur Hidup
                                    </label>
                                </div>
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
                                    <option>2017</option>
                                    <option>2018</option>
                                    <option>2019</option>
                                    <option>2020</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tempat Lahir</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Masukkan Tempat Lahir" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tanggal Lahir</label>
                            <div class="date-control col-sm-10">
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
                                    <option>1960</option>
                                    <option>1961</option>
                                    <option>1991</option>
                                    <option>1992</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Agama</label>
                            <div class="col-sm-10">
                                <select class="form-control">
                                    <option>Pilih Agama</option>
                                    <option>Islam</option>
                                    <option>Kristen</option>
                                    <option>Katolik</option>
                                    <option>Hindu</option>
                                    <option>Buddha</option>
                                    <option>Lainnya</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nama Gadis Ibu Kandung</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Masukkan Nama Gadis Ibu Kandung" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Status Pernikahan</label>
                            <div class="col-sm-10 radio">
                                <label>
                                    <input type="radio" name="maritalRadio">
                                    Lajang
                                </label>
                                <label>
                                    <input type="radio" name="maritalRadio">
                                    Menikah
                                </label>
                                <label>
                                    <input type="radio" name="maritalRadio">
                                    Janda/Duda
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Pendidikan Terakhir</label>
                            <div class="col-sm-10">
                                <select class="form-control">
                                    <option>Pilih Pendidikan</option>
                                    <option>SD</option>
                                    <option>SMP</option>
                                    <option>SMA</option>
                                    <option>D3</option>
                                    <option>S1</option>
                                    <option>S2</option>
                                    <option>S3</option>
                                </select>
                            </div>
                        </div>
                        <div class="incometax form-group">
                            <label class="col-sm-2 control-label">NPWP</label>
                            <div class="col-sm-10 radio">
                                <label>
                                    <input type="radio" name="taxRadio">
                                    Ada
                                </label>
                                <label>
                                    <input type="radio" name="taxRadio">
                                    Tidak
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nomor NPWP</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Masukkan Nomor NPWP" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="email" placeholder="Masukkan Email" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nomor HP</label>
                            <div class="phone-control col-sm-10">
                                <select class="form-control" disabled>
                                    <option>+62</option>
                                </select>
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <b>−</b>
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <b>−</b>
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nomor HP Alternatif</label>
                            <div class="phone-control col-sm-10">
                                <select class="form-control" disabled>
                                    <option>+62</option>
                                </select>
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <b>−</b>
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <b>−</b>
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">
                                Alamat Rumah
                                <small class="help-block"><i>(Sesuai Tanda Pengenal)</i></small>
                            </label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Masukkan Alamat Rumah" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">RT/RW</label>
                            <div class="address-control col-sm-10">
                                <input class="form-control" type="number" />
                                <b>/</b>
                                <input class="form-control" type="number" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Desa/Kelurahan</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Masukkan Desa/Kelurahan" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Kecamatan</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Masukkan Kecamatan" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Kota</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Masukkan Kota" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Provinsi</label>
                            <div class="col-sm-10">
                                <select class="form-control">
                                    <option>Pilih Provinsi</option>
                                    <option>Nanggroe Aceh Darussalam</option>
                                    <option>DKI Jakarta</option>
                                    <option>Jawa Barat</option>
                                    <option>Jawa Tengah</option>
                                    <option>Jawa Timur</option>
                                    <option>Sumatera Selatan</option>
                                    <option>Sumatera Barat</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Kode Pos</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Masukkan Kode Pos" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nomor Telepon</label>
                            <div class="phone-control col-sm-10">
                                <select class="form-control">
                                    <option>Pilih Kode Area</option>
                                    <option>+62-21</option>
                                    <option>+62-22</option>
                                    <option>+62-61</option>
                                    <option>+62-751</option>
                                </select>
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <b>−</b>
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <b>−</b>
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Jenis Pekerjaan</label>
                            <div class="col-sm-10">
                                <select class="form-control">
                                    <option>Pilih Jenis Pekerjaan</option>
                                    <option>Wirausaha</option>
                                    <option>Pegawai Swasta</option>
                                    <option>Pegawai BUMN</option>
                                    <option>TNI</option>
                                    <option>POLRI</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Jabatan Pekerjaan</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Masukkan Jabatan Pekerjaan" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nama Perusahaan</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Masukkan Nama Perusahaan" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Jenis Usaha</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Masukkan Jenis Usaha" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Kode Usaha</label>
                            <div class="col-sm-10 radio">
                                <label>
                                    <input type="radio" name="jobRadio">
                                    BUMN
                                </label>
                                <label>
                                    <input type="radio" name="jobRadio">
                                    BUMD
                                </label>
                                <label>
                                    <input type="radio" name="jobRadio">
                                    BUMS
                                </label>
                                <label>
                                    <input type="radio" name="jobRadio">
                                    Lembaga Sosial
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Alamat Kantor</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Masukkan Alamat Kantor" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">RT/RW</label>
                            <div class="address-control col-sm-10">
                                <input class="form-control" type="number" />
                                <b>/</b>
                                <input class="form-control" type="number" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Desa/Kelurahan</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Masukkan Desa/Kelurahan" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Kecamatan</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Masukkan Kecamatan" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Kota</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Masukkan Kota" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Provinsi</label>
                            <div class="col-sm-10">
                                <select class="form-control">
                                    <option>Pilih Provinsi</option>
                                    <option>Nanggroe Aceh Darussalam</option>
                                    <option>DKI Jakarta</option>
                                    <option>Jawa Barat</option>
                                    <option>Jawa Tengah</option>
                                    <option>Jawa Timur</option>
                                    <option>Sumatera Selatan</option>
                                    <option>Sumatera Barat</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Kode Pos</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Masukkan Kode Pos" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nomor Telepon Kantor</label>
                            <div class="phone-control col-sm-10">
                                <select class="form-control">
                                    <option>Pilih Kode Area</option>
                                    <option>+62-21</option>
                                    <option>+62-22</option>
                                    <option>+62-61</option>
                                    <option>+62-751</option>
                                </select>
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <b>−</b>
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <b>−</b>
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Sama Seperti Alamat</label>
                            <div class="col-sm-10 radio">
                                <label>
                                    <input type="radio" name="jobRadio">
                                    Rumah
                                </label>
                                <label>
                                    <input type="radio" name="jobRadio">
                                    Kantor
                                </label>
                                <label>
                                    <input type="radio" name="jobRadio">
                                    Lainnya
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Alamat</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Masukkan Alamat Kantor" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">RT/RW</label>
                            <div class="address-control col-sm-10">
                                <input class="form-control" type="number" />
                                <b>/</b>
                                <input class="form-control" type="number" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Desa/Kelurahan</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Masukkan Desa/Kelurahan" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Kecamatan</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Masukkan Kecamatan" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Kota</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Masukkan Kota" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Provinsi</label>
                            <div class="col-sm-10">
                                <select class="form-control">
                                    <option>Pilih Provinsi</option>
                                    <option>Nanggroe Aceh Darussalam</option>
                                    <option>DKI Jakarta</option>
                                    <option>Jawa Barat</option>
                                    <option>Jawa Tengah</option>
                                    <option>Jawa Timur</option>
                                    <option>Sumatera Selatan</option>
                                    <option>Sumatera Barat</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Kode Pos</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Masukkan Kode Pos" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nomor Telepon</label>
                            <div class="phone-control col-sm-10">
                                <select class="form-control">
                                    <option>Pilih Kode Area</option>
                                    <option>+62-21</option>
                                    <option>+62-22</option>
                                    <option>+62-61</option>
                                    <option>+62-751</option>
                                </select>
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <b>−</b>
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <b>−</b>
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nama Lengkap</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Masukkan Nama Lengkap" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tempat Lahir</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Masukkan Tempat Lahir" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tanggal Lahir</label>
                            <div class="date-control col-sm-10">
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
                                    <option>1960</option>
                                    <option>1961</option>
                                    <option>1991</option>
                                    <option>1992</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Alamat</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Masukkan Alamat Kantor" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">RT/RW</label>
                            <div class="address-control col-sm-10">
                                <input class="form-control" type="number" />
                                <b>/</b>
                                <input class="form-control" type="number" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Desa/Kelurahan</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Masukkan Desa/Kelurahan" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Kecamatan</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Masukkan Kecamatan" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Kota</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Masukkan Kota" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Provinsi</label>
                            <div class="col-sm-10">
                                <select class="form-control">
                                    <option>Pilih Provinsi</option>
                                    <option>Nanggroe Aceh Darussalam</option>
                                    <option>DKI Jakarta</option>
                                    <option>Jawa Barat</option>
                                    <option>Jawa Tengah</option>
                                    <option>Jawa Timur</option>
                                    <option>Sumatera Selatan</option>
                                    <option>Sumatera Barat</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Kode Pos</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Masukkan Kode Pos" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nomor Telepon</label>
                            <div class="phone-control col-sm-10">
                                <select class="form-control">
                                    <option>Pilih Kode Area</option>
                                    <option>+62-21</option>
                                    <option>+62-22</option>
                                    <option>+62-61</option>
                                    <option>+62-751</option>
                                </select>
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <b>−</b>
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <b>−</b>
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                                <input class="form-control" type="text" maxlength="1" autocomplete="off" autocapitalize="off" autocorrect="off" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Hubungan Dengan Peserta</label>
                            <div class="col-sm-10 radio">
                                <label>
                                    <input type="radio" name="relativeRadio">
                                    Ayah
                                </label>
                                <label>
                                    <input type="radio" name="relativeRadio">
                                    Ibu
                                </label>
                                <label>
                                    <input type="radio" name="relativeRadio">
                                    Kakak
                                </label>
                                <label>
                                    <input type="radio" name="relativeRadio">
                                    Adik
                                </label>
                                <label>
                                    <input type="radio" name="relativeRadio">
                                    Paman
                                </label>
                                <label>
                                    <input type="radio" name="relativeRadio">
                                    Bibi
                                </label>
                                <label>
                                    <input type="radio" name="relativeRadio">
                                    Lainnya
                                </label>
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