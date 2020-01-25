<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @if (isset($title))
            <title>{{ $title.' - Paweł Dymek' }}</title>
        @else
            <title>Paweł Dymek - Full Stack Web &amp; Mobile Developer</title>
        @endif

        <meta name="description" content="{{ isset($meta_description) ? $meta_description : 'I am a full stack web & mobile developer, and this is my blog where I share interesting knowledge' }}" />
        <meta name="msapplication-TileColor" content="#2d89ef">
        <meta name="theme-color" content="#ffffff">

        <link rel="canonical" href="{{ url()->current() }}" />
        <link href="{{ mix('css/app.css') }}" rel="stylesheet" />

        @if ( ! empty($meta_keywords))
            <meta name="keywords" content="{{ $meta_keywords }}" />
        @endif

        <link rel="apple-touch-icon" sizes="180x180" href="{{ url('apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ url('favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ url('favicon-16x16.png') }}">
        <link rel="manifest" href="{{ url('manifest.json') }}">
        <link rel="alternate" type="application/rss+xml" title="RSS" href="{{ route('rss.posts') }}" />

        @hasSection('open_graph')
            @yield('open_graph')
        @else
            @include('partials/open_graph')
        @endif

        <script>
            WebFontConfig = {
                google: { families: [ 'Roboto:300,400,700:latin-ext&display=swap' ] }
            };

            (function(d) {
                var wf = d.createElement('script'), s = d.scripts[0];
                wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
                wf.async = true;
                s.parentNode.insertBefore(wf, s);
            })(document);
        </script>

        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-836606-11', 'auto');
          ga('send', 'pageview');
        </script>

        @yield('head')
    </head>
    <body>
        <div id="wrapper">
            @yield('content')
        </div>

        @if ( ! isset($_COOKIE['cookie_alert']))
            <div id="cookie-alert">
                <div class="inner">
                    <div>
                        <p>{{ trans('template.cookie_alert.content') }}</p>
                    </div>
                    <div>
                        <a class="btn btn-light btn-sm close-alert" href="#"><i class="icon-cancel"></i>{{ trans('template.cookie_alert.button') }}</a>
                    </div>
                </div>
            </div>
        @endif

        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
