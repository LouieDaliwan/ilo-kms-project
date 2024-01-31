export default [
    {
        code: "users",
        name: "users",
        meta: {
            title: "Users",
            icon: "mdi-account-settings",
            requiresAuth: true,
            sort: 5,
            roles: ["Superadmin"],
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
                    roles: ["Superadmin"],
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
                    roles: ["Superadmin"],
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
            //         roles: ['Superadmin'],
            //         children: ["users.trashed"],
            //     },
            // },
        ],
    },
];
