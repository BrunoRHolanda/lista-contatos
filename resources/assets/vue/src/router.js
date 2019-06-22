import VueRouter from 'vue-router';

import Contatos from '@vue/views/Contatos';

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'contatos',
            component: Contatos,
        },
    ],
});

export default router;
