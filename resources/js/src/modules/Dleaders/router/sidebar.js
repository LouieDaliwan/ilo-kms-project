export default [
    {
        code: 'dleaders',
        name: 'dleaders',
        meta: {
            title: 'Dgroup Leaders',
            icon: 'mdi-briefcase-outline',
            requiresAuth: false,
            sort: 5,
            children: ['dleaders.index', 'dleaders.create'],
        },
        children: [
            {
                code: 'dleaders.index',
                name: 'dleaders.index',
                meta: {
                  title: 'All Dgroup Leaders',
                  requiresAuth: false,
                  sort: 5,
                  children: ['dleaders.index', 'dleaders.create'],
                },
            },
            {
                code: 'dleaders.create',
                name: 'dleaders.create',
                meta: {
                  title: 'DLeader Create',
                  requiresAuth: false,
                  sort: 6,
                  children: ['dleaders.create'],
                },
            },
            //   {
            //     code: 'members.show',
            //     name: 'members.show',
            //     meta: {
            //       title: 'Members Show',
            //       authenticatable: false,
            //       sort: 7,
            //       children: ['members.show'],
            //     },
            //   },
        ]
    }
]
