<section id="posts">
    @if (count($posts))
        @foreach ($posts as $post)
            <article>
                <header>
                    <h3><a href="{{ $post->getUrl() }}">{{ $post->name }}</a></h3>
                    <div class="bottom">
                        Posted on <time datetime="{{ $post->created_at }}" title="{{ $post->created_at }}">{{ date('M j, Y', strtotime($post->created_at)) }}</time>
                        <span>&bull;</span>
                        {{ $post->getReadTime() }} min to read
                    </div>
                </header>
                @if ( ! empty($post->intro))
                    <p>
                        {{ $post->intro }}
                    </p>
                    <p class="read-more">
                        <a href="{{ $post->getUrl() }}">Read more</a>
                    </p>
                @endif

                @if (count($post->tags))
                    <ul class="tags">
                        @foreach ($post->tags as $tag)
                            <li>
                                <a href="{{ $tag->getUrl() }}">{{ $tag->getTranslation('name', App::getLocale()) }}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </article>
        @endforeach
    @endif
</section>
