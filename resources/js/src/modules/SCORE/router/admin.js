const routes = [
    {
        path: "/admin/score",
        name: "score.index",
        component: () => import("@root/App.vue"),
        meta: {
            title: "Score",
            sort: 6,
            requiresAuth: true,
            icon: "mdi-book-multiple-variant",
            roles: ["Superadmin", "Member"],
        },
        children: [
            {
                path: "about",
                name: "score.about",
                component: () => import("../About.vue"),
                meta: {
                    title: "SCORE About",
                    sort: 1,
                    requiresAuth: true,
                    roles: ["Superadmin", "Members"],
                    //   permission: 'customers.index',
                    icon: "mdi-book-multiple-variant",
                },
            },
            {
                path: "davao",
                name: "score.davao",
                component: () => import("../Davao.vue"),
                meta: {
                    title: "Davao",
                    sort: 2,
                    requiresAuth: true,
                    //   permission: 'customers.index',
                    roles: ["Superadmin", "Member"],
                    icon: "mdi-book-multiple-variant",
                },
            },
            {
                path: "tagaytay",
                name: "score.tagaytay",
                component: () => import("../Tagaytay.vue"),
                meta: {
                    title: "Tagaytay",
                    sort: 3,
                    requiresAuth: true,
                    //   permission: 'customers.index',
                    roles: ["Superadmin", "Member"],
                    icon: "mdi-book-multiple-variant",
                },
            },
            {
                path: "manila",
                name: "score.manila",
                component: () => import("../Manila.vue"),
                meta: {
                    title: "Manila",
                    sort: 4,
                    requiresAuth: true,
                    //   permission: 'customers.index',
                    roles: ["Superadmin", "Member"],
                    icon: "mdi-book-multiple-variant",
                },
            },
        ],
    },
];

export default routes;
