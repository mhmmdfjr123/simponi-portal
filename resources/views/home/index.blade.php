@extends('layouts.front', ['bodyClass' => 'with-affix-menu'])

@section('content')
    <header class="sim-carousel">
        <!-- Carousel -->
        <div id="sim-carousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#sim-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#sim-carousel" data-slide-to="1"></li>
                <li data-target="#sim-carousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img class="first-slide" src="{{ asset('theme/front/images/carousel/banner-1.jpg') }}" alt="First slide">
                    {{--<div class="container">
                        <div class="carousel-caption">
                            <h1>Example headline.</h1>
                            <p>Example sub headline.</p>
                            <p><a class="btn btn-lg btn-primary" href="#" role="button">DAFTAR SEKARANG</a></p>
                        </div>
                    </div>--}}
                </div>
                <div class="item">
                    <img class="second-slide" src="{{ asset('theme/front/images/carousel/banner-2.jpg') }}" alt="Second slide">
                    {{--<div class="container">
                        <div class="carousel-caption">
                            <h1>Another example headline.</h1>
                            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                            <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
                        </div>
                    </div>--}}
                </div>
                <div class="item">
                    <img class="third-slide" src="{{ asset('theme/front/images/carousel/banner-1.jpg') }}" alt="Third slide">
                    {{--<div class="container">
                        <div class="carousel-caption">
                            <h1>One more for good measure.</h1>
                            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                            <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
                        </div>
                    </div>--}}
                </div>
            </div>
            <!--
            <a class="left carousel-control" href="#sim-carousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#sim-carousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
            -->

            <div id="header-nav-masking"></div>

            <div class="above-fold">
                <a class="page-scroll" href="#about">
                    <div class="btn-scroll-arrow">
                        <i class="fa fa-angle-double-down"></i>
                    </div>
                </a>
            </div>
        </div>
        <!-- End of Carousel -->
    </header>

    <section class="section-box featured bg-featured">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="section-box-item">
                        <div class="box-header">
                            <h4 class="box-title">Berita</h4>
                            <div class="box-title-action"><a href="#">Lihat Semua <i class="fa fa-angle-double-right"></i></a></div>
                        </div>
                        <div class="box-body">
                            <ul class="fa-ul">
                                <li><i class="fa-li fa fa-check"></i> <a href="#">Mengapa perlu investasi?</a></li>
                                <li><i class="fa-li fa fa-check"></i> <a href="#">BNI Simponi saat ini dan nanti</a></li>
                                <li><i class="fa-li fa fa-check"></i> <a href="#">Mengenal lebih jauh produk investasi non bank</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="section-box-item">
                        <div class="box-header">
                            <h4 class="box-title">Promosi</h4>
                            <div class="box-title-action"><a href="#">Lihat Semua <i class="fa fa-angle-double-right"></i></a></div>
                        </div>
                        <div class="box-body">
                            <ul class="fa-ul">
                                <li><i class="fa-li fa fa-bullhorn"></i> <a href="#">Mengapa perlu investasi?</a></li>
                                <li><i class="fa-li fa fa-bullhorn"></i> <a href="#">BNI Simponi saat ini dan nanti</a></li>
                                <li><i class="fa-li fa fa-bullhorn"></i> <a href="#">Mengenal lebih jauh produk investasi non bank</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="section-box-item">
                        <div class="box-header">
                            <h4 class="box-title">Fund Fact Sheet</h4>
                            <div class="box-title-action"><a href="#">Lihat Semua <i class="fa fa-angle-double-right"></i></a></div>
                        </div>
                        <div class="box-body">
                            <ul class="fa-ul">
                                <li><i class="fa-li fa fa-download"></i> <a href="#">Mengapa perlu investasi?</a></li>
                                <li><i class="fa-li fa fa-download"></i> <a href="#">BNI Simponi saat ini dan nanti</a></li>
                                <li><i class="fa-li fa fa-download"></i> <a href="#">Mengenal lebih jauh produk investasi non bank</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-secondary" id="about">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text-center">
                    <h2 class="section-heading">Apa itu BNI Simponi?</h2>
                    <hr class="title">
                    <div class="text-faded">
                        <p>BNI Simponi adalah <strong>layanan program pensiun</strong> yang diselenggarakan oleh Dana Pensiun Lembaga Keuangan PT. Bank Negara Indonesia (Persero) Tbk  (DPLK BNI) sejak tahun 1994 berdasarkan Undang-Undang Nomor 11 Tahun 1992 tentang Dana Pensiun. Selama 15 tahun terakhir sejak tahun 2001, DPLK BNI berhasil menjadi <strong>market leader</strong> dalam industri pengelolaan dana pensiun di Indonesia.</p>
                    </div>
                    <a href="#services" class="page-scroll btn btn-default btn-outline btn-xl sr-button">MULAI PENELUSURAN</a>
                </div>
            </div>
        </div>
    </section>

    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">At Your Service</h2>
                    <hr class="title">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-diamond text-primary sr-icons"></i>
                        <h3>Sturdy Templates</h3>
                        <p>Our templates are updated regularly so they don't break.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-paper-plane text-primary sr-icons"></i>
                        <h3>Ready to Ship</h3>
                        <p>You can use this theme as is, or you can make changes!</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-newspaper-o text-primary sr-icons"></i>
                        <h3>Up to Date</h3>
                        <p>We update dependencies to keep things fresh.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-heart text-primary sr-icons"></i>
                        <h3>Made with Love</h3>
                        <p>You have to make your websites with love these days!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <aside class="bg-dark">
        <div class="container text-center">
            <div class="call-to-action">
                <h2>SIMULASI</h2>
                <p class="text-faded">Anda dapat melakukan simulasi penghitungan biaya investasi Anda dengan hasil yang akan Anda dapatkan. Silakan tekan tombol di bawah.</p>
                <a href="/simulation" class="btn btn-default btn-outline btn-xl sr-button" target="_blank">LAKUKAN SIMULASI</a>
            </div>
        </div>
    </aside>

    <section class="section-left">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-illustration">
                    <img src="{{ asset('theme/front/images/elderly.png') }}" class="img-responsive">
                </div>
                <div class="col-md-6 col-content">
                    <h2 class="section-heading">Nikmati masa muda di hari tua anda</h2>
                    <hr class="title">
                    <ul class="fa-ul col-content-list">
                        <li><i class="fa-li fa fa-check"></i>Lorem ipsum dolor sit amet 1</li>
                        <li><i class="fa-li fa fa-check"></i>Lorem ipsum dolor sit amet 2</li>
                        <li><i class="fa-li fa fa-check"></i>Lorem ipsum dolor sit amet 3</li>
                        <li><i class="fa-li fa fa-check"></i>Lorem ipsum dolor sit amet 4</li>
                    </ul>
                    <a class="btn btn-md btn-primary btn-outline sr-button" href="#">Daftar Sekarang</a>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-softgray">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-content">
                    <h2 class="section-heading">Dapatkan voucher belanja hingga Rp1 Milyar</h2>
                    <hr class="title">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In elementum mauris ut congue luctus. In fringilla pellentesque nibh, ac hendrerit tortor euismod vitae. Phasellus rhoncus accumsan orci, eu efficitur ante fermentum et. Nunc interdum dapibus posuere. Proin a diam venenatis, consequat lacus maximus, laoreet risus. Pellentesque consectetur sem arcu, a placerat nunc faucibus ut. </p>
                </div>
                <div class="col-lg-6 col-illustration">
                    <!-- 16:9 aspect ratio -->
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/PdhPG4SdS54" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection