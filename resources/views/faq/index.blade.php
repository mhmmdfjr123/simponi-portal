@extends('layouts.front')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Content  -->
                <div class="content-container full-width">
                    <div class="content-header">
                        <h1>FAQ</h1>
                        <hr class="title">
                    </div>
                    <div class="content-detail">
                        <div class="row">
                            <div class="col-sm-3" id="sidebar">
                                <ul class="nav nav-tabs nav-stacked hidden-xs" id="faq-navigation">
                                    @for($i = 1; $i <= 4; $i++)
                                        <li><a href="#faq-category-{{ $i }}" class="page-scroll">FAQ Category {{ $i }}</a></li>
                                    @endfor
                                </ul>

                                {{--<div class="list-group hidden-xs" id="faq-navigation">
                                    @for($i = 1; $i <= 4; $i++)
                                    <a href="#faq-category-{{ $i }}" class="list-group-item page-scroll">FAQ Category {{ $i }}</a>
                                    @endfor
                                </div>--}}
                            </div>
                            <div class="col-sm-9">
                                <!-- FAQ -->
                                <div class="panel-group">
                                    @for($i = 1; $i <= 4; $i++)
                                        <div class="faq-category-container" id="faq-category-{{ $i }}">
                                            <h3 class="faq-category-title">FAQ Category {{ $i }}</h3>

                                            @for($j = 1; $j <= 3; $j++)
                                                <div class="panel panel-default panel-faq">
                                                    <div class="panel-heading">
                                                        <a data-toggle="collapse" data-parent=".faq-category-container" href="#faq-cat-{{ $i }}-item-{{ $j }}">
                                                            <h4 class="panel-title">
                                                                FAQ Category {{ $i }} Item #{{ $j }}
                                                                <span class="pull-right"><i class="glyphicon glyphicon-plus"></i></span>
                                                            </h4>
                                                        </a>
                                                    </div>
                                                    <div id="faq-cat-{{ $i }}-item-{{ $j }}" class="panel-collapse collapse">
                                                        <div class="panel-body">
                                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                                        </div>
                                                    </div>
                                                </div>
                                            @endfor
                                        </div>

                                    @endfor
                                </div>
                                <!-- End of FAQ -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Content  -->
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
        });
    </script>
@endsection