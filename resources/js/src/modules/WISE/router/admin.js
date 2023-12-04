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
                path: "all",
                name: "wise.all",
                component: () => import("../Index.vue"),
                meta: {
                    title: "List Wise",
                    sort: 6,
                    requiresAuth: true,
                    //   permission: 'customers.index',
                    icon: "mdi-book-multiple-variant",
                },
            },
            {
                path: "upload",
                name: "wise.upload",
                component: () => import("../Upload.vue"),
                meta: {
                    title: "Upload Wise",
                    sort: 7,
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
                    title: "Show Member",
                    sort: 8,
                    requiresAuth: true,
                    //   permission: 'customers.index',
                    icon: "mdi-book-multiple-variant",
                },
            },
        ],
    },
];

export default routes;
