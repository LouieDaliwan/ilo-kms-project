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
                path: "dashboard",
                name: "score.dashboard",
                component: () => import("../Index.vue"),
                meta: {
                    title: "Score Dashboard",
                    sort: 6,
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
