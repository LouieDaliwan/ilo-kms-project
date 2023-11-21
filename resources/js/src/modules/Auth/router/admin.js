const routes = [
    {
        path: "/admin/user-profile",
        name: "auth-profile",
        redirect: { name: "user-profile" },
        component: () => import("@root/App.vue"),
        meta: {
            title: "User Profile",
            sort: 6,
            requiresAuth: true,
            icon: "mdi-book-multiple-variant",
        },
        children: [
            {
                path: "user-profile",
                name: "user-profile",
                component: () => import("../Profile.vue"),
                meta: {
                    title: "List Users",
                    sort: 6,
                    requiresAuth: true,
                    //   permission: 'customers.index',
                    icon: "mdi-book-multiple-variant",
                },
            },
        ],
    },
];

export default routes;
