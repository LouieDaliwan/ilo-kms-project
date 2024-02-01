export default [
    {
        code: "score",
        name: "score",
        meta: {
            title: "SCORE",
            icon: "mdi-calculator-variant",
            requiresAuth: true,
            sort: 2,
            roles: ["Superadmin", "Member"],
            children: [
                "score.about",
                "score.davao",
                "score.tagaytay",
                "score.manila",
            ],
        },
        children: [
            {
                code: "score.about",
                name: "score.about",
                meta: {
                    title: "About",
                    requiresAuth: true,
                    sort: 1,
                    roles: ["Superadmin", "Members"],
                    children: ["score.about"],
                },
            },
            {
                code: "score.davao",
                name: "score.davao",
                meta: {
                    title: "Davao",
                    requiresAuth: true,
                    sort: 2,
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
                    sort: 3,
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
                    sort: 4,
                    children: ["score.manila"],
                    roles: ["Superadmin", "Member"],
                },
            },
        ],
    },
];
