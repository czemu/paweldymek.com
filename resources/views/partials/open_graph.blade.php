<meta property="og:site_name" content="Paweł Dymek" />
<meta property="og:locale" content="{{ 'en_US' }}" />
<meta property="og:url" content="{{ ! empty($url) ? $url : url()->current() }}" />
<meta property="og:type" content="{{ ! empty($type) ? $type : 'website' }}" />
<meta property="og:title" content="{{ ! empty($title) ? $title : 'Paweł Dymek' }}" />
<meta property="og:image" content="{{ ! empty($image) ? $image : url('images/home.png') }}" />

@if ( ! empty($description))
    <meta property="og:description" content="{{ $description }}" />
@endif
