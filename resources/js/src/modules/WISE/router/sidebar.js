export default [
    {
        code: "wise",
        name: "wise",
        meta: {
            title: "WISE",
            icon: "mdi-briefcase-outline",
            requiresAuth: true,
            sort: 5,
            children: ["wise.all", "users.upload"],
        },
        children: [
            {
                code: "wise.all",
                name: "wise.all",
                meta: {
                    title: "All",
                    requiresAuth: true,
                    sort: 6,
                    children: ["wise.all"],
                },
            },
            {
                code: "wise.upload",
                name: "wise.upload",
                meta: {
                    title: "Upload",
                    requiresAuth: true,
                    sort: 7,
                    children: ["wise.upload"],
                },
            },
        ],
    },
];
