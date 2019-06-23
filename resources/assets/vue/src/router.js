import Vue from 'vue';
import VueRouter from 'vue-router';

import Contatos from '@vue/views/Contatos';
import Login from "@vue/views/Login";

Vue.router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            redirect: '/login'
        },
        {
            path: '/contatos',
            name: 'contatos',
            component: Contatos,
            meta: { auth: true },
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
            meta: { auth: false }
        }
    ],
});

