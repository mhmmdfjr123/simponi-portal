@extends('layouts.front')

@section('content')
    <div class="content-header">
        <h1 style="max-width: 700px; margin-left: auto; margin-right: auto">{!! $post->title !!}</h1>
        <hr class="title">
        <div style="text-align: center; font-size: 12px; margin-top: -10px;">
            Di posting pada: {{ $post->created_at->format('d-m-Y H:i:s') }} oleh {{ $post->user->name }}
        </div>
        <div style="margin-bottom: 30px; text-align: center; font-size: 13px">
            {!! implode(', ', $categories) !!}
        </div>
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