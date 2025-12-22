/*!
  * This script is used to remember user scroll position in the usability
  * assessment page.
  */

document.addEventListener('DOMContentLoaded', function (event) {
    var prevScrollY = sessionStorage.getItem('prevScrollY');
    var prevScrollYForSideMenu = sessionStorage.getItem('prevScrollYForSideMenu');

    if (prevScrollY) {
        window.scrollTo({
            left: 0,
            top: prevScrollY,
            behavior: 'instant'
        });

        sessionStorage.removeItem('prevScrollY');
    }
    
    if (prevScrollYForSideMenu) {
        document.querySelector('#side-menu').scrollTop = prevScrollYForSideMenu;

        sessionStorage.removeItem('prevScrollYForSideMenu');
    }
});

window.addEventListener('beforeunload', function (e) {
    sessionStorage.setItem('prevScrollY', window.scrollY);
    sessionStorage.setItem('prevScrollYForSideMenu', document.querySelector('#side-menu').scrollTop);
});