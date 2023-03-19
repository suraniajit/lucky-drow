@extends('themes::layouts.backend.master')
@section('title')    
    {!! config('user.name') !!}
@endsection
@section('page-title')    
    {!! config('user.name') !!}
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                    hello
            </div>  
            <div class="card-body">
                <p>
                    This view is loaded from module: {!! config('user.name') !!}
                </p>
            </div>
        </div>
    </div>
@endsection