@extends('layouts.front', ['bodyClass' => ''])

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
                        @if($banner->hyperlink != '')
                        <a href="{!! $banner->hyperlink !!}">
                            <div class="carousel-image" style="background-image: url('{{ asset('file/banner/'.$banner->image_filename) }}')"></div>
                        </a>
                        @else
                            <div class="carousel-image" style="background-image: url('{{ asset('file/banner/'.$banner->image_filename) }}')"></div>
                        @endif
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

    <section class="bg-secondary-alt" id="about">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text-center">
                    <h2 class="section-heading">Apa itu BNI Simponi?</h2>
                    <div class="text-faded">
                        <p>BNI Simponi adalah layanan program pensiun yang diselenggarakan oleh Dana Pensiun Lembaga Keuangan PT. Bank Negara Indonesia (Persero) Tbk  (DPLK BNI) sejak tahun 1994 berdasarkan Undang-Undang Nomor 11 Tahun 1992 tentang Dana Pensiun. Selama 15 tahun terakhir sejak tahun 2001, DPLK BNI berhasil menjadi market leader dalam industri pengelolaan dana pensiun di Indonesia.</p>
                    </div>
                    <a href="#overview" class="page-scroll btn btn-white btn-outline btn-xl sr-button">Daftar Online</a>
                </div>
            </div>
        </div>
    </section>

    <section id="overview" class="section-left bg-secondary-alt2" style="padding: 80px 0 0 0">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-illustration">
                    <img src="{{ asset('theme/front/images/dplk-timer.png') }}" class="img-responsive" style="">
                </div>
                <div class="col-md-7 col-content" style="padding-bottom: 50px">
                    <h2 class="section-heading">Masa depan anda ditentukan hari ini.</h2>
                    <p>Pensiun adalah masa saat Anda memiliki waktu luang untuk beribadah, berkumpul dengan keluarga, berkeliling dunia, atau melakukan kegiatan menyenangkan lainnya. BNI Simponi hadir untuk membantu Anda mewujudkan masa pensiun impian Anda.</p>
                    <a class="page-scroll btn btn-md btn-primary btn-outline sr-button" href="#services">Lihat Produk & Layanan</a>
                </div>
            </div>
        </div>
    </section>

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
            <div class="row text-center" >
                {{-- <div class="col-lg-6 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-user text-primary sr-icons"></i>
                        <h3>Individu</h3>
                        <p>Untuk Peserta Individu, DPLK BNI menyelenggarakan Program Pensiun Iuran Pasti (PPIP) dengan produknya bernama BNI Simponi (Simpanan Pensiun BNI)...</p>
                        <p><a class="btn btn-md btn-primary btn-outline sr-button" href="/jenis-program-peserta-individu" style="margin-top:20px">Lihat Selengkapnya</a></p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-users text-primary sr-icons"></i>
                        <h3>Kolektif</h3>
                        <p>Program Pensiun untuk Kompensasi Pesangon (PPUKP) merupakan produk yang dirancang untuk memenuhi kebutuhan Pemberi Kerja atas persiapan pembayaran dana pesangon karyawan...</p>
                        <p><a class="btn btn-md btn-primary btn-outline sr-button" href="/jenis-program-peserta-kelompok" style="margin-top:20px">Lihat Selengkapnya</a></p>
                    </div>
                </div> --}}
                <div class="col-lg-4 col-md-4">
                    <div class="service-box">
                        <img class="sr-icons" width="370" height="400" src="{{ asset('theme/front/images/product/konservatif.jpg') }}" alt="Konservatif" />
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="service-box">
                        <img class="sr-icons" width="370" height="400" src="{{ asset('theme/front/images/product/moderat.jpg') }}" alt="Moderat" />
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="service-box">
                        <img class="sr-icons" width="370" height="400" src="{{ asset('theme/front/images/product/agresif.jpg') }}" alt="Agresif" />
                    </div>
                </div>
                <p><a class="btn btn-md btn-primary btn-outline sr-button" href="/jenis-program-peserta-individu" style="margin-top:20px">Pelajari Lebih Lanjut</a></p>
            </div>
        </div>
    </section>

    <aside class="bg-wisma46">
        <div class="container text-center">
            <div class="call-to-action">
                <h2>SIMULASI</h2>
                <p class="text-faded">Anda dapat melakukan simulasi penghitungan biaya investasi Anda dengan hasil yang akan Anda dapatkan. Terdapat dua mode simulasi, yaitu berdarsarkan iuran dan kebutuhan.</p>
                <a href="/simulation" class="btn btn-white btn-outline btn-xl sr-button">Lakukan Simulasi</a>
            </div>
        </div>
    </aside>

    <section class="bg-softgray">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-content">
                    <h2 class="section-heading">Ayo daftar sekarang!</h2>
                    <hr class="title">
                    <p>Silakan mendaftar melalui aplikasi <a href="https://play.google.com/store/apps/details?id=src.com.bni&gl=US" target="_blank">Mobile Banking BNI</a> apabila Anda ingin membuka rekening baru BNI Simponi Anda. Atau <a href="/portal/login/register">daftarkan</a> nomor rekening Anda untuk dapat menikmati fitur lebih dari BNI Simponi Web Portal bila Anda telah memiliki rekening BNI Simponi.</p>
                    {{-- <p>Silakan Hubungi Cabang terdekat bila Anda ingin membuka rekening baru BNI Simponi Anda. Atau <a href="/portal/login/register">daftarkan</a> nomor rekening Anda untuk dapat menikmati fitur lebih dari BNI Simponi Web Portal bila Anda telah memiliki rekening BNI Simponi</p> --}}
                </div>
                <div class="col-lg-6 col-illustration">
                    <!-- 16:9 aspect ratio -->
                    <div class="embed-responsive embed-responsive-16by9">
                        {{-- <a class="embed-responsive-item playbutton" data-src="https://www.youtube.com/embed/PdhPG4SdS54"> --}}
                            <a class="embed-responsive-item playbutton" data-src="https://www.youtube.com/embed/4ivUHmVeHSs">
                            <i class="fa fa-youtube-play"></i>
                            <img src="{{ asset('theme/front/images/yt-dplk-bni.jpg') }}" alt="DPLK BNI YouTube Thumbnail" />
                        </a>
                        {{-- <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/PdhPG4SdS54" allowfullscreen></iframe> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-box featured bg-featured-alt bg-softgray">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="section-box-item">
                        <div class="box-header">
                            <h4 class="box-title">{{ $newsCat->name }}</h4>
                            <div class="box-title-action">
                                <a href="{{ route('post-category', $newsCat->alias) }}">Lihat Semua <i class="fa fa-angle-double-right"></i></a>
                            </div>
                        </div>
                        <div class="box-body">
                            <ul>
                                @foreach($latestNews as $news)
                                <li><i class="fa fa-check"></i> <a href="{{ url('post/'.$news->alias) }}" title="{{ $news->title }}">{{ $news->title }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="section-box-item">
                        <div class="box-header">
                            <h4 class="box-title">{{ $promotionCat->name }}</h4>
                            <div class="box-title-action">
                                <a href="{{ route('post-category', $promotionCat->alias) }}">Lihat Semua <i class="fa fa-angle-double-right"></i></a>
                            </div>
                        </div>
                        <div class="box-body">
                            <ul>
                                @foreach($promotions as $promotion)
                                    <li><i class="fa fa-bullhorn"></i> <a href="{{ url('post/'.$promotion->alias) }}" title="{{ $promotion->title }}">{{ $promotion->title }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="section-box-item">
                        <div class="box-header">
                            <h4 class="box-title">{{ $ffsCat->name }}</h4>
                            <div class="box-title-action"><a href="{{ route('download-category', $ffsCat->alias) }}">Lihat Semua <i class="fa fa-angle-double-right"></i></a></div>
                        </div>
                        <div class="box-body">
                            <ul>
                                @foreach($fundFactSheet as $download)
                                    <li><i class="fa fa-download"></i> <a href="{{ route('download-file', [$download->file_name]) }}">{{ $download->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
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

            $('.playbutton').click(function () {
                $(this).css('display', 'none').after('<iframe class="embed-responsive-item" src="' + ($(this).data('src') + '?autoplay=1') + '" allowfullscreen></iframe>');
            });
        })
    </script>
@endsection