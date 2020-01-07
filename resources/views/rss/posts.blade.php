<?xml version="1.0" encoding="utf-8"?><rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
    <channel>
        <atom:link href="{{ route('rss.posts') }}" rel="self" type="application/rss+xml" />
        <title>{{ config('app.name') }}</title>
        <description>
            Paweł Dymek - Full Stack Web &amp; Mobile Developer
        </description>
        <link>{{ url('/') }}/</link>
        <language>en-US</language>
        <pubDate>{{ date('r') }}</pubDate>

        @if (count($posts))
            @foreach ($posts as $post)
                <item>
                    <title><![CDATA[{{ $post->name }}]]></title>
                    <description><![CDATA[
                        @if ($post->hasMedia('image'))
                            <img src="{{ $post->getFirstMediaUrl('image', 'large') }}" alt="" /><br />
                        @endif
                        {{ $post->intro }}
                    ]]></description>
                    <link>{{ $post->getUrl() }}</link>
                    <guid>{{ $post->getUrl() }}</guid>
                    <pubDate>{{ date('r', strtotime($post->created_at)) }}</pubDate>
                </item>
            @endforeach
        @endif
    </channel>
</rss>
