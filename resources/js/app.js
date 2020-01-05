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
