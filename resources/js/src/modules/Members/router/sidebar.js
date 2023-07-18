export default [
    {
        code: 'members',
        name: 'members',
        meta: {
            title: 'Members',
            icon: 'mdi-briefcase-outline',
            requiresAuth: false,
            sort: 5,
            children: ['members.index', 'members.create'],
        },
        children: [
            {
                code: 'members.index',
                name: 'members.index',
                meta: {
                  title: 'All Members',
                  requiresAuth: false,
                  sort: 5,
                  children: ['members.index', 'members.create'],
                },
            },
            {
                code: 'members.create',
                name: 'members.create',
                meta: {
                    title: 'Members Create',
                    requiresAuth: false,
                    sort: 6,
                    children: ['members.create'],
                },
            },
        ]
    }
]
