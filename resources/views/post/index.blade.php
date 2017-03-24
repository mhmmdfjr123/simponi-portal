@extends('layouts.front')

@section('content')
    <div class="content-header">
        <h1>{!! $post->title !!}</h1>
        <hr class="title">
    </div>

    <div class="container slim-content-container">
        <div class="row">
            <div class="col-md-12">
                <div class="content-detail">
                    {!! $post->content !!}
                </div>
            </div>
        </div>
    </div>
@endsection