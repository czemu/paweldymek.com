<footer class="main">
    <p class="copyright">
        Copyright &copy; {{ date('Y') }} <a href="{{ route('pages.home') }}">paweldymek.com</a>
    </p>

    <ul class="links">
        <li>
            @if (App::getLocale() == 'pl')
                <a href="{{ url('en') }}">English version</a>
            @else
                <a href="{{ url('pl') }}">Wersja polska</a>
            @endif
        </li>
    </ul>
</footer>
