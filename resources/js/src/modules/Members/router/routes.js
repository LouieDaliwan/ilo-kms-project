const routes = [
    {
        path: '/members',
        name: 'members',
        component: import('../Index.vue')
    },
    {
        path: '/members-create',
        name: 'create-members',
        component: import('../Create.vue')
    },
    {
        path: '/members/:id',
        name: 'members-show',
        component: import('../Show.vue')
    }
]


export default routes;
