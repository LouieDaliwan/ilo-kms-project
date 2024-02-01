const routes = [
    {
        path: "/admin/fin-ed",
        name: "fin-ed.index",
        component: () => import("@root/App.vue"),
        meta: {
            title: "FinED",
            sort: 4,
            requiresAuth: true,
            icon: "mdi-book-multiple-variant",
            roles: ["Superadmin", "Members"],
        },
        children: [
            {
                path: "about",
                name: "fin-ed.about",
                component: () => import("../About.vue"),
                meta: {
                    title: "About",
                    sort: 1,
                    requiresAuth: true,
                    roles: ["Superadmin", "Members"],
                    //   permission: 'customers.index',
                    icon: "mdi-book-multiple-variant",
                },
            },
        ],
    },
];

export default routes;
