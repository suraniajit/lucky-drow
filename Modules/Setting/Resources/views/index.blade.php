@extends('themes::layouts.backend.master')
@section('title')    
    {!! config('setting.name') !!}
@endsection
@section('page-title')    
    {!! config('setting.name') !!}
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                    seting module
            </div>  
            <div class="card-body">
                    <p>mini balance alert message</p>
                    <p>wining quata </p>
                    <p>wing price set (exam each tiket * 10) / auto</p>
                    <p>set tiket price </p>
                    <p>drow  time and site setting update time</p>
            </div>
        </div>
    </div>
@endsection