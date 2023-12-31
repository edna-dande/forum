import Vue from 'vue';
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.events = new Vue();

window.flash = function (message) {
    window.events.$emit('flash', message);
};

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('flash', require('./components/Flash.vue').default);
Vue.component('paginator', require('./components/Paginator.vue').default);
Vue.component('user-notifications', require('./components/UserNotifications.vue').default);
// Vue.component('reply', require('./components/Reply.vue').default);
// Vue.component('favorite', require('./components/Favorite.vue').default);
// Vue.component('replies', require('./components/Replies.vue').default);

Vue.component('thread-view', require('./pages/Thread.vue').default);

const app = new Vue({
    el: '#app'
});


