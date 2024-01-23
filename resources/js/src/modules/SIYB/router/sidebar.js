export default [
    {
        code: "siyb",
        name: "siyb",
        meta: {
            title: "SIYB",
            icon: "mdi-briefcase-outline",
            requiresAuth: true,
            sort: 5,
            children: ["siyb.agency"],
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
                code: "siyb.agency",
                name: "siyb.agency",
                meta: {
                    title: "SIYB Agency",
                    requiresAuth: true,
                    sort: 7,
                    children: ["siyb.agency"],
                },
            },
        ],
    },
];
