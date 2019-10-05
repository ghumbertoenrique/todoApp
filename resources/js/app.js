require('./bootstrap');

window.Vue = require('vue');

import Todos from './components/Todos.vue';
import Navbar from './components/Navbar.vue';

Vue.component('todos', Todos);
Vue.component('navbar', Navbar);


const app = new Vue({
  el:'#app'
});
