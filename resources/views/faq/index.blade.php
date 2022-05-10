@extends('layouts.front')

@section('content')
<<<<<<< HEAD
    <div class="content-header with-bg" style="width:1440px; height:151px; background-color:#1D97AE;">
        <div class="" style="position:relative; top:-20px;">
            <h1 style="color:white;">Frequently Asked Questions (FAQ)</h1>
            <hr class="title">
        </div>
=======
    <div class="content-header with-bg bg-wisma46-mini">
        <h1>Frequently Asked Questions (FAQ)</h1>
        <hr class="title">
>>>>>>> b14d6eba5d5bb333f060a031ae36ac98746553db
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="content-detail">
                    <div class="row">
                        <div class="col-sm-3" id="sidebar">
                            <ul class="nav nav-tabs nav-stacked hidden-xs" id="faq-navigation">
                                @foreach($faqCategories as $faqCategory)
                                    <li><a href="#faq-category-{{ $faqCategory->id }}" class="page-scroll-faq">{{ $faqCategory->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-sm-9">
                            <!-- FAQ -->
                            <div class="panel-group">
                                @foreach($faqCategories as $faqCategory)
                                    <div class="faq-category-container" id="faq-category-{{ $faqCategory->id }}">
                                        <h3 class="faq-category-title">{{ $faqCategory->name }}</h3>

                                        @foreach($faqCategory->faqs as $faq)
                                            <div class="panel panel-default panel-faq">
                                                <div class="panel-heading">
                                                    <a data-toggle="collapse" data-parent=".faq-category-container" href="#faq-cat-{{ $faqCategory->id }}-item-{{ $faq->id }}">
                                                        <h4 class="panel-title">
                                                            {{ $faq->question }}
                                                            <span class="pull-right"><i class="glyphicon glyphicon-plus"></i></span>
                                                        </h4>
                                                    </a>
                                                </div>
                                                <div id="faq-cat-{{ $faqCategory->id }}-item-{{ $faq->id }}" class="panel-collapse collapse">
                                                    <div class="panel-body">
                                                        {!! $faq->answer !!}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                @endforeach
                            </div>
                            <!-- End of FAQ -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footScript')
    <script src="{{ asset('theme/front/vendor/scrolltofixed/jquery-scrolltofixed-min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            const offsetTop = 75;

            $('body').scrollspy({ target: '#sidebar', offset: offsetTop });

            $('#faq-navigation').scrollToFixed({
                limit: function() {
                    return $('#contact').offset().top - $(this).outerHeight(true) - $('#contact').css('margin-top').replace('px', '');
                },
                marginTop: offsetTop,
                zIndex: 100,
                removeOffsets: true
            });

            const $collapsibleElement = $('.collapse');

            $collapsibleElement.on('show.bs.collapse', function() {
                var id = $(this).attr('id');
                $('a[href="#' + id + '"]').closest('.panel-heading').addClass('active-faq');
                $('a[href="#' + id + '"] .panel-title span').html('<i class="glyphicon glyphicon-minus"></i>');
            });
            $collapsibleElement.on('hide.bs.collapse', function() {
                var id = $(this).attr('id');
                $('a[href="#' + id + '"]').closest('.panel-heading').removeClass('active-faq');
                $('a[href="#' + id + '"] .panel-title span').html('<i class="glyphicon glyphicon-plus"></i>');
            });

            // jQuery for page scrolling feature - requires jQuery Easing plugin
            $('a.page-scroll-faq').bind('click', function(event) {
                var $anchor = $(this);
                $('html, body').stop().animate({
                    scrollTop: ($($anchor.attr('href')).offset().top - 73)
                }, 1000, 'easeInOutExpo');
                event.preventDefault();
            });
        });
    </script>
@endsection