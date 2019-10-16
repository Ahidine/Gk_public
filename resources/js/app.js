
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
Vue.component('addpaiement-component', require('./components/AddPaymentComponent.vue').default);
Vue.component('table-component', require('./components/GroupeEleveComponent.vue').default);
Vue.component('paysville-component', require('./components/PaysVilleComponent.vue').default);
Vue.component('paysvillemodif-component', require('./components/PaysVilleModifComponent.vue').default);
Vue.component('centreaffectation-component', require('./components/TableAffrectationCentre.vue').default);
Vue.component('infoeleve-component', require('./components/InfoEleveComponent.vue').default);
Vue.component('addmodule-component', require('./components/AddModuleComponent.vue').default);
Vue.component('modifmodule-component', require('./components/ModifAffectationModuleComponent.vue').default);
Vue.component('employe-component', require('./components/TableEmployeComponent.vue').default);
Vue.component('profcv-component', require('./components/ProfCvComponent.vue').default);
Vue.component('absence-component', require('./components/AbsencesComponent.vue').default);
Vue.component('calendrie-component', require('./components/CalendrieComponent.vue').default);
Vue.component('profcvedit-component', require('./components/ProfCvEditComponent.vue').default);
Vue.component('affectationeditprof-component', require('./components/AffectationProfEditComponent.vue').default);
Vue.component('profindex-component', require('./components/ProfIndexComponent.vue').default);
Vue.component('affectationniveau-component', require('./components/AffectationNiveauComponent.vue').default);
Vue.component('affectationprof-component', require('./components/AffectationProfComponent.vue').default);
Vue.component('affectationniveaumodif-component', require('./components/AffectationNiveauModifComponent.vue').default);
Vue.component('users-component', require('./components/UsersComponent.vue').default);
Vue.component('absenceseleves-component', require('./components/AbsencesEleveComponent.vue').default);
Vue.component('emplois-component', require('./components/EmploisTempsComponent.vue').default);
Vue.component('create_emplois-component', require('./components/CreateEmploisComponent.vue').default);
Vue.component('addgroupe-component', require('./components/AddGroupeComponent.vue').default);
Vue.component('editgroupe-component', require('./components/EditGroupeComponent.vue').default);
Vue.component('indexgroupe-component', require('./components/IndexGroupeComponent.vue').default);
Vue.component('create_emplois_temps-component', require('./components/CreateEmploisTempsComponent.vue').default);
Vue.component('liste_users-component', require('./components/ListeUsersComponent.vue').default);




/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


const app = new Vue({
    el: '#app'
});
const appseconde = new Vue({
    el: '#appseconde'
});
