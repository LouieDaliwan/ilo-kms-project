const routes = [
    {
        path: '/admin/members',
        name: 'members.index',
        component: () => import('@root/App.vue'),
        meta: {
            title: 'Members',
            sort: 6,
            requiresAuth: false,
            icon: 'mdi-book-multiple-variant',
        },
        children: [
            {
                path: '/admin/members',
                name: 'members.index',
                component: () => import('../Index.vue'),
                meta: {
                  title: 'All Members',
                  sort: 6,
                  requiresAuth: false,
                //   permission: 'customers.index',
                  icon: 'mdi-book-multiple-variant',
                },
            },
            {
                path: '/admin/members-create',
                name: 'members.create',
                component: () => import('../Create.vue'),
                meta: {
                  title: 'Create Member',
                  sort: 7,
                  requiresAuth: false,
                //   permission: 'customers.index',
                  icon: 'mdi-book-multiple-variant',
                },
            },
        ]
    },
]


export default routes;
