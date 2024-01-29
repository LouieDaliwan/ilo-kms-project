const routes = [
    {
        path: "/admin/users",
        name: "users.index",
        component: () => import("@root/App.vue"),
        meta: {
            title: "Users",
            sort: 6,
            requiresAuth: true,
            icon: "mdi-book-multiple-variant",
            roles: ["Superadmin"],
        },
        children: [
            {
                path: "all",
                name: "users.all",
                component: () => import("../Index.vue"),
                meta: {
                    title: "List Users",
                    sort: 6,
                    requiresAuth: true,
                    roles: ["Superadmin"],
                    //   permission: 'customers.index',
                    icon: "mdi-book-multiple-variant",
                },
            },
            {
                path: "create",
                name: "users.create",
                component: () => import("../Create.vue"),
                meta: {
                    title: "Create Member",
                    sort: 7,
                    requiresAuth: true,
                    roles: ["Superadmin"],
                    //   permission: 'customers.index',
                    icon: "mdi-book-multiple-variant",
                },
            },
            {
                path: ":id",
                name: "users.show",
                component: () => import("../Show.vue"),
                meta: {
                    title: "Show Member",
                    sort: 8,
                    requiresAuth: true,
                    roles: ["Superadmin"],
                    //   permission: 'customers.index',
                    icon: "mdi-book-multiple-variant",
                },
            },
            {
                path: "trashed",
                name: "users.trashed",
                component: () => import("../Trashed.vue"),
                meta: {
                    title: "Show Trashed",
                    sort: 9,
                    requiresAuth: true,
                    roles: ["Superadmin"],
                    //   permission: 'customers.index',
                    icon: "mdi-book-multiple-variant",
                },
            },
        ],
    },
];

export default routes;
