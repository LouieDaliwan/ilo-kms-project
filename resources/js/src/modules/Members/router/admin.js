const routes = [
    {
        path: "/admin/members",
        name: "members.index",
        component: () => import("@root/App.vue"),
        meta: {
            title: "Members",
            icon: "mdi-book-multiple-variant",
        },
        children: [
            {
                path: "all",
                name: "members.all",
                component: () => import("../Index.vue"),
                meta: {
                    title: "All Members",
                    //   permission: 'customers.index',
                    icon: "mdi-book-multiple-variant",
                },
            },
            {
                path: "create",
                name: "members.create",
                component: () => import("../Create.vue"),
                meta: {
                    title: "Create Member",
                    //   permission: 'customers.index',
                    icon: "mdi-book-multiple-variant",
                },
            },
        ],
    },
];

export default routes;
