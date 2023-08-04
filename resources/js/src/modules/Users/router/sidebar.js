export default [
    {
        code: "users",
        name: "users",
        meta: {
            title: "Users",
            icon: "mdi-briefcase-outline",
            requiresAuth: false,
            sort: 5,
            children: ["users.all", "users.create", "users.trashed"],
        },
        children: [
            {
                code: "users.all",
                name: "users.all",
                meta: {
                    title: "List Users",
                    requiresAuth: false,
                    sort: 6,
                    children: ["users.all"],
                },
            },
            {
                code: "users.create",
                name: "users.create",
                meta: {
                    title: "Add User",
                    requiresAuth: false,
                    sort: 7,
                    children: ["users.create"],
                },
            },
            {
                code: "users.trashed",
                name: "users.trashed",
                meta: {
                    title: "Trashed",
                    requiresAuth: false,
                    sort: 8,
                    children: ["users.trashed"],
                },
            },
        ],
    },
];
