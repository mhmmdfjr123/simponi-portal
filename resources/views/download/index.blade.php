@extends('layouts.front')

@section('content')
    <div class="content-header with-bg bg-wisma46-mini">
        <h1>Download</h1>
        <hr class="title">
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="content-detail">
                    <div class="row">
                        <div class="col-sm-3" id="sidebar">
                            <ul class="nav nav-tabs nav-stacked" id="faq-navigation">
                                <li {!! $categoryAlias == '' ? 'class="active"' : '' !!}><a href="{{ route('download-list') }}">Semua Kategori</a></li>
                                @foreach($categories as $category)
                                    <li {!! $categoryAlias == $category->alias ? 'class="active"' : '' !!}><a href="{{ route('download-category', [$category->alias]) }}">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-sm-9">
                            <!-- Download List -->
                            <ul class="download-list">
                                @foreach($files as $file)
                                    <li>
                                        <div class="file-type hidden-xs">
                                            @if($file->file_ext == 'pdf')
                                                <i class="fa fa-file-pdf-o"></i>
                                            @elseif($file->file_ext == 'doc' || $file->file_ext == 'docx')
                                                <i class="fa fa-file-word-o"></i>
                                            @elseif($file->file_ext == 'ppt' || $file->file_ext == 'pptx')
                                                <i class="fa fa-file-powerpoint-o"></i>
                                            @elseif($file->file_ext == 'xls' || $file->file_ext == 'xlsx')
                                                <i class="fa fa-file-excel-o"></i>
                                            @else
                                                <i class="fa fa-file-o"></i>
                                            @endif

                                            <div class="file-size">{{ humanFileSize($file->file_size) }}</div>
                                        </div>
                                        <div class="info">
                                            <h4 class="title">{{ $file->name }}</h4>
                                            <p class="desc">{{ $file->desc }}</p>
                                            <div class="date">
                                                Diunggah pada: {{ $file->created_at->format('d-m-Y H:i:s') }}
                                            </div>
                                        </div>
                                        <div class="action">
                                            <a class="btn btn-sm btn-primary" href="{{ route('download-file', [$file->file_name]) }}"><i class="fa fa-download"></i> Download</a>
                                            <div class="download-info">{{ $file->total_download }} download</div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                            {{ $files->links() }}
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

            $('#faq-navigation').scrollToFixed({
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