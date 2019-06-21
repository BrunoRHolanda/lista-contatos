/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */
import Vue from 'vue';

import './config/bootstrap';
import './config/http';

import Routes from '@vue/router';
import App from '@vue/App';

const app = new Vue({
    el: '#app',
    router: Routes,
    render: h => h(App),
});

export default app;
