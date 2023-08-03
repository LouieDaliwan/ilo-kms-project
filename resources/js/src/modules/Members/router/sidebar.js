export default [
    {
        code: "members",
        name: "members",
        meta: {
            title: "Members",
            icon: "mdi-briefcase-outline",
            requiresAuth: false,
            sort: 5,
            children: ["members.index", "members.create"],
        },
        children: [
            {
                code: "members.all",
                name: "members.all",
                meta: {
                    title: "All Members",
                    requiresAuth: false,
                    sort: 6,
                    children: ["members.all"],
                },
            },
            {
                code: "members.create",
                name: "members.create",
                meta: {
                    title: "Members Create",
                    requiresAuth: false,
                    sort: 7,
                    children: ["members.create"],
                },
            },
        ],
    },
];
