@extends('layouts.front', ['bodyClass' => 'with-affix-menu'])

@section('content')
    <header class="sim-carousel">
        <!-- Carousel -->
        <div id="sim-carousel" class="carousel slide">
            @if(count($banners) > 0)
                <ol class="carousel-indicators">
                    @foreach($banners as $banner)
                    <li data-target="#sim-carousel" data-slide-to="{{ $loop->index }}" {!! ($loop->index == 0) ? 'class="active"':'' !!}></li>
                    @endforeach
                </ol>
                <div class="carousel-inner" role="listbox">
                    @foreach($banners as $banner)
                    <div class="item {!! ($loop->index == 0) ? 'active':'' !!}">
                        <div class="carousel-image" style="background-image: url('{{ asset('file/banner/'.$banner->image_filename) }}')"></div>
                    </div>
                    @endforeach
                </div>
            @else
                <ol class="carousel-indicators">
                    <li data-target="#sim-carousel" data-slide-to="0" class="active"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <div class="carousel-image" style="background-image: url('{{ asset('theme/front/images/header/default-carousel.jpg') }}')"></div>
                    </div>
                </div>
            @endif
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
                                @foreach($latestNews as $news)
                                <li><i class="fa-li fa fa-check"></i> <a href="{{ url('post/'.$news->alias) }}" title="{{ $news->title }}">{{ str_limit($news->title, $featuredBoxStrLimit) }}</a></li>
                                @endforeach
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
                                @foreach($promotions as $promotion)
                                    <li><i class="fa-li fa fa-bullhorn"></i> <a href="{{ url('post/'.$promotion->alias) }}" title="{{ $promotion->title }}">{{ str_limit($promotion->title, $featuredBoxStrLimit) }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="section-box-item">
                        <div class="box-header">
                            <h4 class="box-title">Fund Fact Sheet</h4>
                            <div class="box-title-action"><a href="{{ route('download-category', $ffs->alias) }}">Lihat Semua <i class="fa fa-angle-double-right"></i></a></div>
                        </div>
                        <div class="box-body">
                            <ul class="fa-ul">
                                @foreach($fundFactSheet as $download)
                                    <li><i class="fa-li fa fa-download"></i> <a href="{{ route('download-file', [$download->file_name]) }}">{{ $download->name }}</a></li>
                                @endforeach
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
                    <a href="#services" class="page-scroll btn btn-white btn-outline btn-xl sr-button">MULAI PENELUSURAN</a>
                </div>
            </div>
        </div>
    </section>

    <section class="section-left">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-illustration">
                    <img src="{{ asset('theme/front/images/youth.png') }}" class="img-responsive">
                </div>
                <div class="col-md-6 col-content">
                    <h2 class="section-heading">Masa depan anda ditentukan harini.</h2>
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

    <aside class="bg-wisma46">
        <div class="container text-center">
            <div class="call-to-action">
                <h2>SIMULASI</h2>
                <p class="text-faded">Anda dapat melakukan simulasi penghitungan biaya investasi Anda dengan hasil yang akan Anda dapatkan. Silakan tekan tombol di bawah.</p>
                <a href="/simulation" class="btn btn-white btn-outline btn-xl sr-button">LAKUKAN SIMULASI</a>
            </div>
        </div>
    </aside>

    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Produk & Layanan</h2>
                    <hr class="title">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-diamond text-primary sr-icons"></i>
                        <h3>Sample 1</h3>
                        <p>Our templates are updated regularly so they don't break.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-paper-plane text-primary sr-icons"></i>
                        <h3>Sample 2</h3>
                        <p>You can use this theme as is, or you can make changes!</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-newspaper-o text-primary sr-icons"></i>
                        <h3>Sample 3</h3>
                        <p>We update dependencies to keep things fresh.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-heart text-primary sr-icons"></i>
                        <h3>Sample 4</h3>
                        <p>You have to make your websites with love these days!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-softgray">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-content">
                    <h2 class="section-heading">Ayo daftar sekarang!</h2>
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

@section('footScript')
    <script src="{{ asset('theme/front/vendor/jquery-touch-events/jquery.mobile-events.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            const $simCarousel = $('#sim-carousel');

            $simCarousel.bind('swipeleft', function(e) {
                $simCarousel.carousel('next')
            });

            $simCarousel.bind('swiperight', function(e) {
                $simCarousel.carousel('prev')
            });

            $simCarousel.carousel({
                interval: 4000
            });
        })
    </script>
@endsection