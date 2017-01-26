@extends('layouts.front', ['transparentHeader' => true])

@section('content')
    <header>
        <!-- Carousel -->
        <div id="sim-carousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#sim-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#sim-carousel" data-slide-to="1"></li>
                <li data-target="#sim-carousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img class="first-slide" src="{{ asset('theme/front/images/banner-1.jpg') }}" alt="First slide">
                    <div class="container">
                        <div class="carousel-caption">
                            <h1>Example headline.</h1>
                            <p>Example sub headline.</p>
                            <p><a class="btn btn-lg btn-primary" href="#" role="button">DAFTAR SEKARANG</a></p>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img class="second-slide" src="{{ asset('theme/front/images/header.jpg') }}" alt="Second slide">
                    <div class="container">
                        <div class="carousel-caption">
                            <h1>Another example headline.</h1>
                            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                            <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img class="third-slide" src="{{ asset('theme/front/images/header.jpg') }}" alt="Third slide">
                    <div class="container">
                        <div class="carousel-caption">
                            <h1>One more for good measure.</h1>
                            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                            <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <a class="left carousel-control" href="#sim-carousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#sim-carousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <!-- End of Carousel -->
        <!--
        <div class="information">
            <div>
                <h3>INFORMASI</h3>
                <ul>
                    <li>
                        <a href=#>
                            <b>DAPATKAN VOUCHER BELANJA SETIAP TOP UP</b>
                            <span>Anda berhak mendapatkan voucher belanja hingga Rp1 Milyar untuk setiap top up Simponi.</span>
                        </a>
                    </li>
                    <li>
                        <a href=#>
                            <b>GRATIS PULSA 10 RIBU SETIAP TOP UP DENGAN TOKOPEDIA</b>
                            <img src="https://ecs7.tokopedia.net/img/og_tokopedia.jpg" alt="Promo Top Up BNI Simponi" />
                            <span>Promo ini berlaku hingga tanggal 29 Februari 2017</span>
                        </a>
                    </li>
                    <li>
                        <a href=#>
                            <b>NIKMATI MASA MUDA DI HARI TUA ANDA</b>
                            <span>Siapa bilang masa muda tidak bisa dinikmati nanti?</span>
                        </a>
                    </li>
                    <li>
                        <a href=#>
                            <b>BNI SIMPONI INVESTASI PASTI</b>
                            <span>Investasi tidak perlu menunggu tua. Berinvestasi dengan BNI Simponi sekarang dan dapatkan manfaatnya.</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        -->
    </header>

    <!-- <div class="col-sm-12 abovefold">
        <a class="col-sm-6 text-center page-scroll" href="#about">Apa itu BNI Simponi?<span class="fa fa-angle-double-down"></span></a>
        <a class="col-sm-6 text-center page-scroll" href="#featured">Temukan Hal Menarik<span class="fa fa-angle-double-down"></span></a>
    </div> -->

    <section id="featured">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 text-center">
                    <span class="col-sm-12">INFORMASI</span>
                    <div class="col-sm-12">
                        <div class="col-sm-12">
                            <ul>
                                <li>
                                    <a href=#>
                                        <b>DAPATKAN VOUCHER BELANJA SETIAP TOP UP</b>
                                        <span>Anda berhak mendapatkan voucher belanja hingga Rp1 Milyar untuk setiap top up Simponi.</span>
                                    </a>
                                </li>
                                <li>
                                    <a href=#>
                                        <b>NIKMATI MASA MUDA DI HARI TUA ANDA</b>
                                        <span>Siapa bilang masa muda tidak bisa dinikmati nanti?</span>
                                    </a>
                                </li>
                                <li>
                                    <a href=#>
                                        <b>BNI SIMPONI INVESTASI PASTI</b>
                                        <span>Investasi tidak perlu menunggu tua. Berinvestasi dengan BNI Simponi sekarang dan dapatkan manfaatnya.</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 text-center">
                    <span class="col-sm-12">PROMO</span>
                    <div class="col-sm-12">
                        <div class="col-sm-12">
                            <ul>
                                <li>
                                    <a href=#>
                                        <b>DAPATKAN VOUCHER BELANJA SETIAP TOP UP</b>
                                        <span>Anda berhak mendapatkan voucher belanja hingga Rp1 Milyar untuk setiap top up Simponi.</span>
                                    </a>
                                </li>
                                <li>
                                    <a href=#>
                                        <b>NIKMATI MASA MUDA DI HARI TUA ANDA</b>
                                        <span>Siapa bilang masa muda tidak bisa dinikmati nanti?</span>
                                    </a>
                                </li>
                                <li>
                                    <a href=#>
                                        <b>BNI SIMPONI INVESTASI PASTI</b>
                                        <span>Investasi tidak perlu menunggu tua. Berinvestasi dengan BNI Simponi sekarang dan dapatkan manfaatnya.</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 text-center">
                    <span class="col-sm-12">Infografis</span>
                    <div class="col-sm-12">
                        <div class="col-sm-12">
                            <ul>
                                <li>
                                    <a href=#>
                                        <b>DAPATKAN VOUCHER BELANJA SETIAP TOP UP</b>
                                        <span>Anda berhak mendapatkan voucher belanja hingga Rp1 Milyar untuk setiap top up Simponi.</span>
                                    </a>
                                </li>
                                <li>
                                    <a href=#>
                                        <b>NIKMATI MASA MUDA DI HARI TUA ANDA</b>
                                        <span>Siapa bilang masa muda tidak bisa dinikmati nanti?</span>
                                    </a>
                                </li>
                                <li>
                                    <a href=#>
                                        <b>BNI SIMPONI INVESTASI PASTI</b>
                                        <span>Investasi tidak perlu menunggu tua. Berinvestasi dengan BNI Simponi sekarang dan dapatkan manfaatnya.</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 text-center">
                    <span class="col-sm-12">Simulasi</span>
                    <div class="col-sm-12">
                        <div class="col-sm-12">
                            <ul>
                                <li>
                                    <a href="/simulation" target="_blank">
                                        <b>SIMULASIKAN INVESTASI DPLK ANDA</b>
                                        <span>Dengan menggunakan aplikasi simulasi, Anda bisa mengetahui dan mengatur rencana keuangan Anda di masa depan.</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-sm-3 text-center">
                    <span class="col-sm-12">DPLK Sekarang & Nanti</span>
                    <div class="col-sm-12">
                        <div class="col-sm-12">
                            <iframe class="col-sm-12" src="http://www.youtube.com/embed/CKU4PLxbK0M"></iframe>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus interdum, libero id sodales tristique, mi erat molestie quam, et tristique sapien lacus nec tellus.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 text-center">
                    <span class="col-sm-12">PROMOSI</span>
                    <div class="col-sm-12">
                        <div class="col-sm-12">
                            <iframe class="col-sm-12" src="http://www.youtube.com/embed/Lp9OP4dvSTs"></iframe>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus interdum, libero id sodales tristique, mi erat molestie quam, et tristique sapien lacus nec tellus.</p>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </section>

    <div class="col-sm-12 abovefold">
        <a class="col-sm-12 text-center page-scroll" href="#about">Apa itu BNI Simponi?<span class="fa fa-angle-double-down"></span></a>
        <!-- <a class="col-sm-6 text-center page-scroll" href="#featured">Temukan Hal Menarik<span class="fa fa-angle-double-down"></span></a> -->
    </div>

    <section class="bg-secondary" id="about">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text-center">
                    <h2 class="section-heading">Apa itu BNI Simponi?</h2>
                    <hr class="light">
                    <p class="text-faded">BNI Simponi adalah layanan program pensiun yang diselenggarakan oleh Dana Pensiun Lembaga Keuangan PT. Bank Negara Indonesia (Persero) Tbk  (DPLK BNI) sejak tahun 1994 berdasarkan Undang-Undang Nomor 11 Tahun 1992 tentang Dana Pensiun.</p>
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
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-diamond text-primary sr-icons"></i>
                        <h3>Sturdy Templates</h3>
                        <p class="text-muted">Our templates are updated regularly so they don't break.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-paper-plane text-primary sr-icons"></i>
                        <h3>Ready to Ship</h3>
                        <p class="text-muted">You can use this theme as is, or you can make changes!</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-newspaper-o text-primary sr-icons"></i>
                        <h3>Up to Date</h3>
                        <p class="text-muted">We update dependencies to keep things fresh.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-heart text-primary sr-icons"></i>
                        <h3>Made with Love</h3>
                        <p class="text-muted">You have to make your websites with love these days!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--
    <section class="no-padding" id="portfolio">
        <div class="container-fluid">
            <div class="row no-gutter popup-gallery">
                <div class="col-lg-4 col-sm-6">
                    <a href="images/portfolio/fullsize/1.jpg" class="portfolio-box">
                        <img src="images/portfolio/thumbnails/1.jpg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Category
                                </div>
                                <div class="project-name">
                                    Project Name
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="images/portfolio/fullsize/2.jpg" class="portfolio-box">
                        <img src="images/portfolio/thumbnails/2.jpg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Category
                                </div>
                                <div class="project-name">
                                    Project Name
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="images/portfolio/fullsize/3.jpg" class="portfolio-box">
                        <img src="images/portfolio/thumbnails/3.jpg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Category
                                </div>
                                <div class="project-name">
                                    Project Name
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="images/portfolio/fullsize/4.jpg" class="portfolio-box">
                        <img src="images/portfolio/thumbnails/4.jpg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Category
                                </div>
                                <div class="project-name">
                                    Project Name
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="images/portfolio/fullsize/5.jpg" class="portfolio-box">
                        <img src="images/portfolio/thumbnails/5.jpg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Category
                                </div>
                                <div class="project-name">
                                    Project Name
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="images/portfolio/fullsize/6.jpg" class="portfolio-box">
                        <img src="images/portfolio/thumbnails/6.jpg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Category
                                </div>
                                <div class="project-name">
                                    Project Name
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    -->

    <aside class="bg-dark">
        <div class="container text-center">
            <div class="call-to-action">
                <h2>SIMULASI</h2>
                <p class="text-faded">Anda dapat melakukan simulasi penghitungan biaya investasi Anda dengan hasil yang akan Anda dapatkan. Silakan tekan tombol di bawah.</p>
                <a href="/simulation" class="btn btn-default btn-outline btn-xl sr-button" target="_blank">LAKUKAN SIMULASI</a>
            </div>
        </div>
    </aside>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <iframe class="col-lg-12" src="http://www.youtube.com/embed/pqCL1dQm1cs" height="320"></iframe>
                </div>
                <div class="col-lg-6">
                    <h2 class="section-heading text-center">Dapatkan voucher belanja hingga Rp1 Milyar</h2>
                    <hr class="primary">
                    <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In elementum mauris ut congue luctus. In fringilla pellentesque nibh, ac hendrerit tortor euismod vitae. Phasellus rhoncus accumsan orci, eu efficitur ante fermentum et. Nunc interdum dapibus posuere. Proin a diam venenatis, consequat lacus maximus, laoreet risus. Pellentesque consectetur sem arcu, a placerat nunc faucibus ut. Duis justo diam, pellentesque nec elit et, iaculis commodo elit. Nullam viverra rhoncus sagittis. Quisque a faucibus velit. Integer sagittis cursus lorem, sit amet auctor ipsum dapibus fermentum. Donec in rutrum tellus. Donec eu bibendum lorem. Vestibulum pulvinar fermentum cursus. Pellentesque tincidunt velit quam, non pulvinar dolor semper eget. Donec in sagittis urna.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">HUBUNGI KAMI</h2>
                    <hr class="primary">
                    <p>Hubungi kami di <i>Call Center</i> atau <i>email</i> di bawah dan dapatkan penawaran menarik dari BNI Simponi.</p>
                </div>
                <div class="col-lg-4 col-lg-offset-2 text-center">
                    <i class="fa fa-phone fa-3x sr-contact"></i>
                    <p><a href="tel:1500046">1500046</a></p>
                </div>
                <div class="col-lg-4 text-center">
                    <i class="fa fa-envelope-o fa-3x sr-contact"></i>
                    <p><a href="mailto:bnicall@bni.co.id">bnicall@bni.co.id</a></p>
                </div>
            </div>
        </div>
    </section>
@endsection