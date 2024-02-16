const routes = [
    {
        path: "/admin/siyb",
        name: "siyb",
        redirect: { name: "siyb.agency" },
        component: () => import("@root/App.vue"),
        meta: {
            title: "SIYB",
            sort: 3,
            requiresAuth: true,
            roles: ["Superadmin", "Member"],
            icon: "mdi-book-multiple-variant",
        },
        children: [
            {
                path: "about",
                name: "siyb.about",
                component: () => import("../About.vue"),
                meta: {
                    title: "SIYB About",
                    sort: 1,
                    requiresAuth: true,
                    roles: ["Superadmin", "Members"],
                    //   permission: 'customers.index',
                    icon: "mdi-book-multiple-variant",
                },
            },
            {
                path: "agency",
                name: "siyb.agency",
                component: () => import("../Agency/Index.vue"),
                meta: {
                    title: "List Agencies",
                    sort: 2,
                    requiresAuth: true,
                    //   permission: 'customers.index'
                    roles: ["Superadmin", "Member"],
                    icon: "mdi-book-multiple-variant",
                },
            },
            {
                path: "summary",
                name: "siyb.summary",
                component: () => import("../Agency/Summary.vue"),
                meta: {
                    title: "Agent Summary",
                    sort: 3,
                    requiresAuth: true,
                    roles: ["Superadmin", "Member"],
                    //   permission: 'customers.index',
                    icon: "mdi-book-multiple-variant",
                },
            },
            {
                path: "clients",
                name: "siyb.clients",
                component: () => import("../Client/Index.vue"),
                meta: {
                    title: "Clients",
                    sort: 3,
                    requiresAuth: true,
                    roles: ["Superadmin", "Member"],
                    //   permission: 'customers.index',
                    icon: "mdi-book-multiple-variant",
                },
            },
            {
                path: "clients:id",
                name: "siyb.client-profile",
                component: () => import("../Client/Profile.vue"),
                meta: {
                    title: "Client Profile",
                    sort: 4,
                    requiresAuth: true,
                    roles: ["Superadmin", "Member"],
                    //   permission: 'customers.index',
                    icon: "mdi-book-multiple-variant",
                },
            },
            {
                path: "clients-summary",
                name: "siyb.clients-summary",
                component: () => import("../Client/Summary.vue"),
                meta: {
                    title: "Client Summary",
                    sort: 4,
                    requiresAuth: true,
                    roles: ["Superadmin", "Member"],
                    //   permission: 'customers.index',
                    icon: "mdi-book-multiple-variant",
                },
            },
        ],
    },
];

export default routes;
