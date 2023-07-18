const routes = [
    {
        path: '/admin/d-leaders',
        name: 'dleaders.index',
        component:() => import('@root/App.vue'),
        meta: {
            Title: 'Dgroup Leaders',
            sort: 6,
            requiresAuth: false,
            icon: 'mdi-book-multiple-variant',
        },
        children: [
            {
                path: '/admin/d-leaders',
                name: 'dleaders.index',
                component: () => import('../Index.vue'),
                meta: {
                    title: 'All Dgroup Leaders',
                    sort: 6,
                    requiresAuth: false,
                }
            },
            {
                path: '/admin/d-leaders-create',
                name: 'dleaders.create',
                component: () => import('../Create.vue'),
                meta: {
                    title: 'Assign Droup Leader',
                    sort: 6,
                    requiresAuth: false,
                }
            }

        ]
    }
    // {
    //     path: '/members-create',
    //     name: 'create-members',
    //     component: import('../Create.vue'),
    //     meta: { requiresAuth: false },

    // },
    // {
    //     path: '/members/:id',
    //     name: 'members-show',
    //     component: import('../Show.vue'),
    //     meta: { requiresAuth: false },
    // }
]


export default routes;
