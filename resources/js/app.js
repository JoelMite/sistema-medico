/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

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
Vue.component('create-appointment-component', require('./components/CreateAppointmentComponent.vue').default);
Vue.component('create-medical-consultation-component', require('./components/CreateMedicalConsultationComponent.vue').default);
Vue.component('home-dashboard-doctor-component', require('./components/HomeDashboardDoctorComponent.vue').default);
Vue.component('home-dashboard-patient-component', require('./components/HomeDashboardPatientComponent.vue').default);
Vue.component('home-dashboard-administrator-component', require('./components/HomeDashboardAdministratorComponent.vue').default);
Vue.component('create-doctor-component', require('./components/CreateDoctorComponent.vue').default);
Vue.component('table-pending-appointment-component', require('./components/TablePendingAppointmentComponent.vue').default);
Vue.component('table-confirmed-appointment-component', require('./components/TableConfirmedAppointmentComponent.vue').default);
Vue.component('table-old-appointment-component', require('./components/TableOldAppointmentComponent.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
// require('./index');
