export default [
    {
        code: "score",
        name: "score",
        meta: {
            title: "SCORE",
            icon: "mdi-calculator-variant",
            requiresAuth: true,
            sort: 5,
            roles: ["Superadmin", "Member"],
            children: ["score.dashboard"],
        },
        children: [
            {
                code: "score.davao",
                name: "score.davao",
                meta: {
                    title: "Davao",
                    requiresAuth: true,
                    sort: 6,
                    children: ["score.davao"],
                    roles: ["Superadmin", "Member"],
                },
            },
            {
                code: "score.tagaytay",
                name: "score.tagaytay",
                meta: {
                    title: "Tagaytay",
                    requiresAuth: true,
                    sort: 6,
                    children: ["score.tagaytay"],
                    roles: ["Superadmin", "Member"],
                },
            },
            {
                code: "score.manila",
                name: "score.manila",
                meta: {
                    title: "Manila",
                    requiresAuth: true,
                    sort: 6,
                    children: ["score.manila"],
                    roles: ["Superadmin", "Member"],
                },
            },
        ],
    },
];
