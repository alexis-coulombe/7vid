function setCookie(cookieName, cookieValue) {
    if (getCookie(cookieName) === '') {
        let d = new Date();
        d.setTime(d.getTime() + (3600 * 24 * 60 * 60 * 1000)); // Set cookie for a year
        let expires = "expires=" + d.toUTCString();
        document.cookie = cookieName + "=" + cookieValue + ";" + expires + ";path=/";
    }
}

function getCookie(cookieName) {
    let name = cookieName + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for (let i = 0, iMax = ca.length; i < iMax; i++) {
        let c = ca[i];
        while (c.charAt(0) === ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) === 0) {
            return c.substring(name.length, c.length);
        }
    }
    return '';
}

function showLaw(cookieName) {
    let x = getCookie(cookieName);
    if (x !== '') {
        $("#lawmsg").remove();
    } else {
        setCookie(cookieName, true);
    }
}

$(function() {
    // Show or hide cookie consent
    showLaw('cookie-consent');
});
