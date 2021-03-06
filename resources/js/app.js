
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vuelidate from 'vuelidate';
Vue.use(Vuelidate);

import Notifications from 'vue-notification';
Vue.use(Notifications);

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
Vue.component('team-select', require('./components/TeamSelect.vue').default);
Vue.component('team-detail-container', require('./components/TeamDetailContainer.vue').default);
Vue.component('team-title', require('./components/TeamTitle.vue').default);
Vue.component('list-table', require('./components/ListTable.vue').default);
Vue.component('form-player-create-edit', require('./components/FormPlayerCreateEdit.vue').default);
Vue.component('form-team-create-edit', require('./components/FormTeamCreateEdit.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});
