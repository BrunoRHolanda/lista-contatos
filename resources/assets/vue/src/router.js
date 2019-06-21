import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from '@vue/views/Home';
import Sobre from '@vue/views/Sobre';
import Produto from "@vue/views/catalogo/Produto";
import Catalogo from "@vue/views/catalogo/Catalogo";
import Loja from "@vue/views/Loja";
import Contato from "@vue/views/Contato";
import ProdutosCatalogo from "@vue/views/catalogo/ProdutosCatalogo";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
        },
    ],
});

export default router;
