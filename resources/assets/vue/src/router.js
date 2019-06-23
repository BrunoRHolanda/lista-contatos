import Vue from 'vue';
import VueRouter from 'vue-router';

import Contatos from '@vue/views/Contatos';
import Login from "@vue/views/Login";
import Home from "@vue/views/Home";
import Perfil from "@vue/views/Perfil";
import Menu from "@vue/components/Home/Menu";

Vue.router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            redirect: '/login'
        },
        {
            path: '/app',
            component: Home,
            meta: { auth: true },
            children: [
                {
                    path: '/',
                    name: 'app',
                    component: Menu,
                    meta: { auth: true },
                },
                {
                    path: 'contatos',
                    name: 'contatos',
                    component: Contatos,
                    meta: { auth: true },
                },
                {
                    path: 'perfil',
                    name: 'perfil',
                    component: Perfil,
                    meta: { auth: true },
                },
            ],
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
            meta: { auth: false }
        }
    ],
});

