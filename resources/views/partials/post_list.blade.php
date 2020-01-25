<section id="posts">
    @if (count($posts))
        @foreach ($posts as $post)
            <article>
                <header>
                    <h3><a href="{{ $post->getUrl() }}">{{ $post->name }}</a></h3>
                    <div class="bottom">
                        {{ trans('posts.posted') }} <time datetime="{{ $post->created_at }}" title="{{ $post->created_at }}">{!! \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $post->created_at)->diffForHumans(); !!}</time>
                        <span>&bull;</span>
                        {{ trans('posts.time_to_read', ['time' => $post->getReadTime()]) }}
                    </div>
                </header>
                @if ( ! empty($post->intro))
                    <p>
                        {{ $post->intro }}
                    </p>
                    <p class="read-more">
                        <a href="{{ $post->getUrl() }}">{{ trans('posts.read_more') }}</a>
                    </p>
                @endif

                @if (count($post->tags))
                    <ul class="tags">
                        @foreach ($post->tags as $tag)
                            <li>
                                <a href="{{ $tag->getUrl() }}">{{ $tag->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </article>
        @endforeach
    @endif
</section>
