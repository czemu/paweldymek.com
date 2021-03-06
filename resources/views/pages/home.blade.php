@extends('layouts/main')

@section('content')
    <div id="content" class="home">
        <div id="sidebar">
            <header>
                <div class="author">
                    <div class="photo">
                        <img src="{{ url('images/pawel_dymek.jpg') }}" alt="Paweł Dymek" />
                    </div>
                    <h1>Paweł Dymek</h1>
                    <span>Software Developer</span>
                </div>
            </header>
            <ul class="icons">
                <li>
                    <a href="https://github.com/czemu" title="GitHub" target="_blank"><i class="icon-github-circled"></i></a>
                </li>
                <li>
                    <a href="https://twitter.com/pawel_dymek" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                </li>
                <li>
                    <a href="https://www.linkedin.com/in/pawel-dymek/" title="LinkedIn" target="_blank"><i class="icon-linkedin-squared"></i></a>
                </li>
                <li>
                    <a href="mailto:pawel.dymek@gmail.com" title="E-mail"><i class="icon-mail-alt"></i></a>
                </li>
            </ul>
        </div>

        <div id="main">
            @include('partials/post_list')
            @include('partials/footer')
        </div>
    </div>
@endsection

@section('head')
    <link rel="alternate" hreflang="{{ Request::is('en') ? 'pl' : 'en' }}" href="{{ Request::is('en') ? url('pl') : url('en') }}" />
@endsection
