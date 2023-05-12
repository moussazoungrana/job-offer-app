/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)

import {enableBodyScroll,disableBodyScroll} from "body-scroll-lock/lib/bodyScrollLock.esm";

import './sass/main.scss';

function handleMobileMainMenu() {
    const activator = document.querySelector('#show-mobile-navbar');
    const canceller = document.querySelector('#hide-mobile-navbar');
    const menu = document.querySelector("#mobile-menu");

    if (!activator || !canceller || !menu) return false;

    activator.addEventListener('click', function () {
        menu.style.display = 'block';
        canceller.style.display = 'block';
        activator.style.display = 'none';
        disableBodyScroll(menu);
    });

    canceller.addEventListener('click', function () {
        menu.style.display = 'none';
        canceller.style.display = 'none';
        activator.style.display = 'block';
        enableBodyScroll(menu);
    })
}

document.addEventListener('DOMContentLoaded', function () {
    handleMobileMainMenu();

})

