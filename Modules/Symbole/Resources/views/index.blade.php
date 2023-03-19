@extends('themes::layouts.backend.master')
@section('title')    
    {!! config('symbole.name') !!}
@endsection
@section('page-title')    
    {!! config('symbole.name') !!}
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                    hello
            </div>  
            <div class="card-body">
                <p>
                    This view is loaded from module: {!! config('symbole.name') !!}
                </p>
            </div>
        </div>
    </div>
@endsection