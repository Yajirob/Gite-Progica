/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import './bootstrap';

console.log('Welcome Encore in Gite PROGICA');

let btnContact = document.querySelector('#contact');

btnContact.addEventListener('click', function () {
    console.log('Click form');
    let form = document.querySelector('.form-contact');

    form.classList.remove('hidden');
    form.classList.add('visible');
    this.classList.add('hidden');
})