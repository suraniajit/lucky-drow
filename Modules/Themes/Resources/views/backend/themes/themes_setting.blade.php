@extends('themes::layouts.backend.master')
@section('title')    
    {!! __('user::user/labels.user-page-title') !!}
@endsection
@section('page-title')    
{!! __('themes::user/labels.user-page-title') !!}
@endsection
@push('css-stack')
@endpush
@section('content')
hello i m from themes
@endsection
@push('js-stack')
@endpush