const routes = [
    {
        path: "/admin/wise",
        name: "wise.index",
        component: () => import("@root/App.vue"),
        meta: {
            title: "Wise",
            sort: 6,
            requiresAuth: true,
            icon: "mdi-book-multiple-variant",
        },
        children: [
            {
                path: "dashboard",
                name: "wise.dashboard",
                component: () => import("../Index.vue"),
                meta: {
                    title: "Wise Dashboard",
                    sort: 6,
                    requiresAuth: true,
                    //   permission: 'customers.index',
                    icon: "mdi-book-multiple-variant",
                },
            },
            {
                path: "participants",
                name: "wise.participants",
                component: () => import("../Participants.vue"),
                meta: {
                    title: "Participants",
                    sort: 7,
                    requiresAuth: true,
                    //   permission: 'customers.index',
                    icon: "mdi-book-multiple-variant",
                },
            },
            {
                path: "activity-plus",
                name: "wise.activity-plus",
                component: () => import("../ActivityPlus.vue"),
                meta: {
                    title: "Activity Plus",
                    sort: 8,
                    requiresAuth: true,
                    //   permission: 'customers.index',
                    icon: "mdi-book-multiple-variant",
                },
            },
            {
                path: "evaluations",
                name: "wise.evaluations",
                component: () => import("../Evaluation.vue"),
                meta: {
                    title: "Participants Evaluation",
                    sort: 9,
                    requiresAuth: true,
                    //   permission: 'customers.index',
                    icon: "mdi-book-multiple-variant",
                },
            },
            {
                path: ":id",
                name: "wise.show",
                component: () => import("../Show.vue"),
                meta: {
                    title: "Show Participant",
                    sort: 10,
                    requiresAuth: true,
                    //   permission: 'customers.index',
                    icon: "mdi-book-multiple-variant",
                },
            },
        ],
    },
];

export default routes;
