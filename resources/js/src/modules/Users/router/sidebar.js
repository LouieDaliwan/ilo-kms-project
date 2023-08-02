export default [
    {
        code: "users",
        name: "users",
        meta: {
            title: "Users",
            icon: "mdi-briefcase-outline",
            requiresAuth: false,
            sort: 5,
            children: ["users.index", "users.create"],
        },
        children: [
            {
                code: "users.index",
                name: "users.index",
                meta: {
                    title: "All Users",
                    requiresAuth: false,
                    sort: 5,
                    children: ["users.index", "users.create"],
                },
            },
            {
                code: "users.create",
                name: "users.create",
                meta: {
                    title: "User Create",
                    requiresAuth: false,
                    sort: 6,
                    children: ["users.create"],
                },
            },
            {
                code: "users.trashed",
                name: "users.trashed",
                meta: {
                    title: "Users Trashed",
                    requiresAuth: false,
                    sort: 6,
                    children: ["users.trashed"],
                },
            },
        ],
    },
];
