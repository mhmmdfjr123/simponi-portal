@extends('layouts.front')

@section('content')
    <div class="content-header with-bg bg-wisma46-mini">
        <h1>Kategori Artikel: {!! $pageTitle !!}</h1>
        <hr class="title">
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="content-detail">
                    <div class="row">
                        <div class="col-sm-3" id="sidebar">
                            <ul class="nav nav-tabs nav-stacked" id="post-category-navigation">
                                <li {!! $postAlias == '' ? 'class="active"' : '' !!}><a href="{{ route('post-category') }}">Semua Kategori</a></li>
                                @foreach($categories as $category)
                                    <li {!! $postAlias == $category->alias ? 'class="active"' : '' !!}><a href="{{ route('post-category', [$category->alias]) }}">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-sm-9">
                            <!-- Download List -->
                            <ul class="article-list">
                                @foreach($posts as $post)
                                    <li>
                                        <a href="{{ route('post', $post->alias) }}">
                                            <h4 class="title">{{ $post->title }}</h4>
                                        </a>
                                        <div class="info">
                                            <span class="date">{{ $post->created_at->format('d-m-Y H:i:s') }}</span>
                                            @if($postAlias == '')
                                            <span class="category">
                                                <i class="fa fa-tags" style="margin-right: 3px"></i> {{ $post->categories->implode('name', ', ') }}
                                            </span>
                                            @endif
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                        {{ $posts->links() }}
                        <!-- End of Download List -->
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

            $('#post-category-navigation').scrollToFixed({
                limit: function() {
                    return $('#contact').offset().top - $(this).outerHeight(true) - $('#contact').css('margin-top').replace('px', '');
                },
                marginTop: offsetTop,
                zIndex: 100,
                removeOffsets: true
            });
        });
    </script>
@endsection