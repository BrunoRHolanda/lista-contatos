/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */
import Vue from 'vue';

import '@config/bootstrap';
import '@config/plugins';
import '@config/http';
import '@vue/router';
import '@config/auth';

import App from '@vue/App';

App.router = Vue.router;

const app = new Vue(App).$mount('#app');

export default app;
