
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.moment = require('moment');

import { MdField, MdSteppers, MdButton } from 'vue-material/dist/components'
import {store} from './store';
import { loadProgressBar } from 'axios-progress-bar'
var VueCookie = require('vue-cookie');
// Tell Vue to use the plugin
Vue.use(VueCookie);


Vue.use(MdField);
Vue.use(MdSteppers);
Vue.use(MdButton);

window.loadProgressBar = loadProgressBar
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('crawler-nav', require('./components/navbar'));
Vue.component('crawler-sidepanel', require('./components/crawler-sidepanel'));
Vue.component('crawler-input', require('./components/crawler-input.vue'));
Vue.component('crawler-analytics', require('./components/crawler-analytics.vue'));
Vue.component('job-offer-log', require('./components/offer-log'));
Vue.component('job-offer-modal', require('./components/modal'));
Vue.component('job-offer-preview', require('./components/offer-previews'));

const app = new Vue({
    el: '#app',
    store: store,
    data: function () {
      return {
        offers: ''
      }
    },
    mounted() {
    window.loadProgressBar();
    if(window.data && window.data.offers){
      this.$store.commit('setOffers', window.data.offers)
    }

    let welcomeCookie = this.$cookie.get('welcome');

    if(!welcomeCookie) {
      this.$store.commit('revealModal', {modal: null, type: 'welcome'});
    }
  }
});
