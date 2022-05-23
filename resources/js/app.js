/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

const { default: Axios } = require('axios');

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});


/*
BOTTONE PER ELIMINARE I POST NELLA PAGINA ADMIN/POSTS
Alla pressione si rende visibile il popup, il quale contiene il vero bottone per eliminare il post
*/

const showPopup = document.getElementById('show-popup');
if (showPopup) {
    const confirmationForm = showPopup.querySelector('form');

    // Al click sul bottone delete mostro il popup (rimuovendo il display:none) e modifico il link dell'action destroy
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function() {
            confirmationForm.action = confirmationForm.dataset.base.replace('*****', this.dataset.slug);
            showPopup.classList.remove('d-none');
        })
    });

    // Al click sul no chiudo il popup (rimettendo il display:none) e ricodifico il link del destroy
    const btnNo = document.querySelector('#btn-no');
    btnNo.addEventListener('click', function() {
        confirmationForm.action = '';
        showPopup.classList.add('d-none');
    });

}


/*
AUTOCOMPILAZIONE SLUG NEL FORM DI CREAZIONE POST
*/

const titleForm = document.getElementById('title');
if (titleForm) {
    titleForm.addEventListener('keyup', function() {
        const eleSlug = document.getElementById('slug');
        const titleInput = titleForm.value;

        Axios.post('/admin/slugger', {
            stringToSlug: titleInput,
        })
            .then(function (response) {
                // console.log(response)
                eleSlug.value = response.data.slug;
            })
    });
}
