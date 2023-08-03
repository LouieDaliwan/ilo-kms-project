const routes = [
    {
        path: "/admin/d-leaders",
        name: "dleaders.index",
        component: () => import("@root/App.vue"),
        meta: {
            Title: "Dgroup Leaders",
            sort: 6,
            requiresAuth: false,
            icon: "mdi-book-multiple-variant",
        },
        children: [
            {
                path: "all",
                name: "dleaders.all",
                component: () => import("../Index.vue"),
                meta: {
                    title: "All Dgroup Leaders",
                    sort: 6,
                    requiresAuth: false,
                },
            },
            {
                path: "create",
                name: "dleaders.create",
                component: () => import("../Create.vue"),
                meta: {
                    title: "Assign Droup Leader",
                    sort: 7,
                    requiresAuth: false,
                },
            },
        ],
    },
];

export default routes;
