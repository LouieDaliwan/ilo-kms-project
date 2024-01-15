export default [
    {
        code: "score",
        name: "score",
        meta: {
            title: "SCORE",
            icon: "mdi-briefcase-outline",
            requiresAuth: true,
            sort: 5,
            children: [
                "score.dashboard",
                "score.indicator_one",
                "score.indicator_two",
                "score.indicator_three",
            ],
        },
        children: [
            // {
            //     code: "score.dashboard",
            //     name: "score.dashboard",
            //     meta: {
            //         title: "Dashboard",
            //         requiresAuth: true,
            //         sort: 6,
            //         children: ["score.dashboard"],
            //     },
            // },
            {
                code: "score.indicator_one",
                name: "score.indicator_one",
                meta: {
                    title: "Score Indicator One",
                    requiresAuth: true,
                    sort: 7,
                    children: ["score.indicator_one"],
                },
            },
            {
                code: "score.indicator_two",
                name: "score.indicator_two",
                meta: {
                    title: "Score Indicator Two",
                    requiresAuth: true,
                    sort: 8,
                    children: ["score.indicator_two"],
                },
            },
            {
                code: "score.indicator_three",
                name: "score.indicator_three",
                meta: {
                    title: "Score Indicator Three",
                    requiresAuth: true,
                    sort: 9,
                    children: ["score.indicator_three"],
                },
            },
        ],
    },
];
