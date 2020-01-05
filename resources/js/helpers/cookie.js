export const setCookie = (cookieKey, cookieValue, expirationDays) => {
  let expires = '';

  if (expirationDays) {
    const date = new Date();

    date.setTime(date.getTime() + (expirationDays * 24 * 60 * 60 * 1000));

    expires = "; expires=" + date.toUTCString();
  }

  document.cookie = `${cookieKey}=${cookieValue || ''}${expires}; path=/`;
}

export const getCookie = (cookieKey) => {
  let cookieName = `${cookieKey}=`;

  let cookieArray = document.cookie.split(';');

  for (let cookie of cookieArray) {

    while (cookie.charAt(0) == ' ') {
          cookie = cookie.substring(1, cookie.length);
      }

    if (cookie.indexOf(cookieName) == 0) {
          return cookie.substring(cookieName.length, cookie.length);
      }
  }
}
