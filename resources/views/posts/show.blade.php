@extends('layouts/main')

@section('content')
    <div id="content" class="article">
        <div id="sidebar">
            <div class="inner">
                <header>
                    @include('partials/sidebar_author')

                    <h1 class="title"><span>{{ $post->name }}</span></h1>
                </header>
            </div>
        </div>

        <div id="main">
            <section id="article">
                <div class="top-bar">
                    <p>
                        {{ trans('posts.posted') }} <time datetime="{{ $post->created_at }}" title="{{ $post->created_at }}">{!! \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $post->created_at)->diffForHumans(); !!}</time>
                        <span>&bull;</span>
                        {{ trans('posts.time_to_read', ['time' => $post->getReadTime()]) }}
                    </p>
                </div>

                <div class="intro">{!! $post->intro !!}</div>

                @if ($post->hasMedia('image'))
                    <img class="main" src="{{ $post->getFirstMediaUrl('image') }}" alt="{{ $post->getFirstMedia('image')->getCustomProperty('description') }}" />
                @endif

                <div class="content">
                    {!! parsedown($post->content) !!}
                </div>

                @if (count($post->tags))
                    <ul class="tags">
                        @foreach ($post->tags as $tag)
                            <li>
                                <a href="{{ $tag->getUrl() }}">{{ $tag->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif

                <div id="disqus_thread"></div>
                <script>
                    var disqus_config = function () {
                        this.page.url = '{{ $post->getUrl() }}';
                        this.page.identifier = '/post/{{ $post->slug }}';
                        this.language = '{{ App::getLocale() }}';
                    };
                    (function() {
                    var d = document, s = d.createElement('script');
                    s.src = 'https://pawel-dymek.disqus.com/embed.js';
                    s.setAttribute('data-timestamp', +new Date());
                    (d.head || d.body).appendChild(s);
                    })();
                </script>
                <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
            </section>

            @include('partials/footer')
        </div>
    </div>

    <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "Article",
      "name": "{{ $post->name }}",
      "headline": "{{ $post->name }}",
      "datePublished": "{{ date('Y-m-d', strtotime($post->created_at)) }}",
      "dateModified": "{{ date('Y-m-d', strtotime($post->updated_at)) }}",
      "author": {
          "@type": "Person",
          "name": "Paweł Dymek",
          "url": "{{ url('/') }}",
          "image": {
             "@type": "ImageObject",
             "url": "{{ url('images/home.png') }}",
             "caption": "Paweł Dymek"
          }
      },
      "publisher": {
          "@type": "Organization",
          "name": "Paweł Dymek",
          "url": "{{ url('/') }}",
          "logo": {
             "@type": "ImageObject",
             "url": "{{ url('images/home.png') }}",
             "name": "Paweł Dymek"
          }
      },

      @if ( ! empty($post->hasMedia('image')))
        "image": "{{ url($post->getFirstMediaUrl('image', 'large')) }}",
      @else
        "image": "{{ url('images/home.png') }}",
      @endif

      "mainEntityOfPage": {
          "@type": "WebPage",
          "@id": "{{ $post->getUrl() }}"
      }
    }
    </script>
@endsection

@section('open_graph')
    @include('partials.open_graph', [
        'type' => 'article',
        'title' => $post->name,
        'url' => $post->getUrl(),
        'description' => \Str::limit(str_replace(PHP_EOL, ' ', ! empty($post->intro) ? $post->intro : $post->content), 200, '...'),
        'image' => $post->hasMedia('image') ? url($post->getFirstMediaUrl('image')) : url('images/home.png')
    ])
@endsection
