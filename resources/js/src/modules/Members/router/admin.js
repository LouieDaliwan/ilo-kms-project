const routes = [
    {
        path: '/members',
        name: 'members',
        component: () => import('../Index.vue'),
        meta: { requiresAuth: false },
    },
    {
        path: '/members-create',
        name: 'create-members',
        component: () => import('../Create.vue'),
        meta: { requiresAuth: false },

    },
    {
        path: '/members/:id',
        name: 'members-show',
        component: () => import('../Show.vue'),
        meta: { requiresAuth: false },
    }

]


export default routes;
