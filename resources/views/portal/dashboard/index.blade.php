@extends('layouts.front')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div style="padding-bottom: 300px; padding-top: 20px">
                    Hello, {{ $user->accountPerson->accountName }}<br>
                    <small>This page is Under Construction</small>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footScript')

@endsection