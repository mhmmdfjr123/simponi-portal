@extends('layouts.front')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="content-container">
                    <div class="content-header">
                        <h1>{!! $page->title !!}</h1>
                        <hr class="title">
                    </div>
                    <div class="content-detail">
                        {!! $page->content !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr class="separator">
@endsection