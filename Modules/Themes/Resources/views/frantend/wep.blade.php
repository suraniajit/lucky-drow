@extends('themes::layouts.frontend.master')
@section('title')    
    {!! config('casestudy.name') !!}
@endsection
@section('page-title')    
    {!! config('casestudy.name') !!}
@endsection
@section('content')
@php 
$theme_data = getThemeString();
@endphp
<section class="breadcrumb-area bg-img bg-overlay jarallax" style="background-image: url(modules/themes/frontend/image/wep-1.jpg);">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="breadcrumb-content">
                    <h2>WEP</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('user.home.index')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">WEP</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="about-area section-padding-100-0">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-12 col-md-12">
                <div class="about-content mb-100">
                    <!-- Section Heading -->
                    <div class="section-heading">
                        <!--<div class="line"></div>-->
                        <!--<p>Take look at our</p>-->
                        <h2 style="text-transform:none;">WEP </h2>
                    </div>
                    <p class="mb-0">
                        At certify through our women empowerment Program, we continuously identify the women talents who had a career break due to personal reasons. We are providing proper training and WFH option to give a comfort for them to start working. 
                        If you would like to part of out WEP please send your details to 
                        <a href="mailto:{{$theme_data['email']}}" data-toggle="tooltip" data-placement="bottom" title="{{$theme_data['email']}}"><span>{{$theme_data['email']}}</span></a>
                    </p>

                </div>
            </div>

        </div>
    </div>
</section>


@endsection
