import Vue from 'vue';
import VueAuth from '@websanova/vue-auth';
import JwtDriver from '@websanova/vue-auth/drivers/auth/bearer.js';
import VueResourceDriver from '@websanova/vue-auth/drivers/http/vue-resource.1.x.js';
import VueRouterDriver from '@websanova/vue-auth/drivers/router/vue-router.2.x.js';

import RoutesApi from './routes-api';

/**
 * websanova/vue-auth
 * https://github.com/websanova/vue-auth/blob/master/docs/Guide.md
 * https://imasters.com.br/back-end/trabalhando-autenticacao-com-jwt-e-vue-2
 *
 * Este plugin é bem extensível, então ele trabalha sob o conceito de Drivers.
 *
 */
Vue.use(VueAuth, {
    auth: JwtDriver,
    http: VueResourceDriver,
    router: VueRouterDriver,

    /**
     *  Atributo que o plugin irá usar para definir os cargos do objeto do Usuário
     */
    rolesVar: 'type',

    /**
     * Endpoint consumido ao efetuar o login
     *
     */
    loginData: {
        url: RoutesApi.auth.login.url,
        method: RoutesApi.auth.login.method,
        redirect: '/',
        fetchUser: true
    },

    /**
     * Endpoint consumido para recuperar os dados do usuário
     *
     */
    fetchData: {
        url: RoutesApi.auth.me.url,
        method: RoutesApi.auth.me.method
    },

    /**
     * É o endpoint que vai validar se o nosso token é válido ou não.
     *
     */
    refreshData: {
        url: RoutesApi.auth.refresh.url,
        method: RoutesApi.auth.refresh.method,
        atInit: false
    }
});