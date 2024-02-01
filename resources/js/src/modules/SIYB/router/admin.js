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
                path: "agency",
                name: "siyb.agency",
                component: () => import("../Agency.vue"),
                meta: {
                    title: "List Agencies",
                    sort: 6,
                    requiresAuth: true,
                    //   permission: 'customers.index'
                    roles: ["Superadmin", "Member"],
                    icon: "mdi-book-multiple-variant",
                },
            },
            {
                path: "summary",
                name: "siyb.summary",
                component: () => import("../Summary.vue"),
                meta: {
                    title: "Summary",
                    sort: 7,
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
