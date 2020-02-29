// Highlight.js
import hljs from 'highlight.js';

hljs.initHighlightingOnLoad();

// Cookie alert
import {
    setCookie
} from './helpers/cookie';

let cookie_alert = document.getElementById('cookie-alert');

if (cookie_alert) {
    let cookie_alert_close = cookie_alert.querySelector('.close-alert');

    if (cookie_alert_close !== null) {
        cookie_alert_close.onclick = function(e) {
            e.preventDefault();

            setCookie('cookie_alert', '1', 180);
            cookie_alert.classList.add('hidden');
        }
    }
}

// Disqus lazy loading
const disqusContainer = document.getElementById('disqus_thread');
const disqusObserver = new IntersectionObserver(function(entries) {
    if (entries[0].isIntersecting) {
        (function() {
            var d = document, s = d.createElement('script');
            s.src = 'https://pawel-dymek.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();

        disqusObserver.disconnect();
    }
}, { rootMargin: '300px', threshold: 0 });

if (disqusContainer) {
    disqusObserver.observe(disqusContainer);
}
