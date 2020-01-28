@extends('layouts/main')

@section('content')
    <div id="content" class="article">
        <div id="sidebar" style="background-image: url({{ url('images/backgrounds/4.jpg') }})">
            <div class="inner">
                <header>
                    @include('partials/sidebar_author')

                    <h1 class="title"><span>Tag: {{ $tag->name }}</span></h1>
                </header>
            </div>
        </div>

        <div id="main">
            @include('partials/post_list')
            @include('partials/footer')
        </div>
    </div>
@endsection

@section('head')
    <link rel="alternate" hreflang="{{ Request::is('en/*') ? 'pl' : 'en' }}" href="{{ LaravelLocalization::getLocalizedURL(Request::is('en/*') ? 'pl' : 'en') }}" />
@endsection
