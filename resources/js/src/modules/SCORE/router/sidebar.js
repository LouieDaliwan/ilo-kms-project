export default [
    {
        code: "score",
        name: "score",
        meta: {
            title: "SCORE",
            icon: "mdi-briefcase-outline",
            requiresAuth: true,
            sort: 5,
            roles: ["Superadmin", "Member"],
            children: ["score.dashboard"],
        },
        children: [
            {
                code: "score.dashboard",
                name: "score.dashboard",
                meta: {
                    title: "Dashboard",
                    requiresAuth: true,
                    sort: 6,
                    children: ["score.dashboard"],
                    roles: ["Superadmin", "Member"],
                },
            },
        ],
    },
];
