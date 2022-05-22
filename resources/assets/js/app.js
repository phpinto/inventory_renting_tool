
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('transactions', require('./components/Transactions.vue'));
Vue.component('team_items', require('./components/Team_Items.vue'));
Vue.component('item', require('./components/Item.vue'));
Vue.component('add_item_form', require('./components/Add_Item_Form.vue'));

const app = new Vue({
    el: '#app'
});
