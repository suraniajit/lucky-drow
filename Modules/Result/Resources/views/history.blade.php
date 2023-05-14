@extends('themes::layouts.backend.master')
@section('title')    
    {!! config('result.name') !!}
@endsection
@section('page-title')    
    {!! config('result.name') !!}
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                    history
            </div>  
            <div class="card-body">
                <p>
                    history of wing  
                </p>
            </div>
        </div>
    </div>
@endsection