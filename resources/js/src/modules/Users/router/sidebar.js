export default [
    {
        code: "users",
        name: "users",
        meta: {
            title: "Users",
            icon: "mdi-briefcase-outline",
            requiresAuth: true,
            sort: 5,
            children: ["users.all", "users.create", "users.trashed"],
        },
        children: [
            {
                code: "users.all",
                name: "users.all",
                meta: {
                    title: "List Users",
                    requiresAuth: true,
                    sort: 6,
                    children: ["users.all"],
                },
            },
            {
                code: "users.create",
                name: "users.create",
                meta: {
                    title: "Add User",
                    requiresAuth: true,
                    sort: 7,
                    children: ["users.create"],
                },
            },
            // {
            //     code: "users.trashed",
            //     name: "users.trashed",
            //     meta: {
            //         title: "Trashed",
            //         requiresAuth: true,
            //         sort: 8,
            //         children: ["users.trashed"],
            //     },
            // },
        ],
    },
];
