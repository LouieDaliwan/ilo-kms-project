export default [
    {
        code: "siyb",
        name: "siyb",
        meta: {
            title: "SIYB",
            icon: "mdi-briefcase-outline",
            requiresAuth: true,
            sort: 5,
            children: ["siyb.agency", "siyb.summary"],
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
                    title: "List Agency",
                    requiresAuth: true,
                    sort: 7,
                    children: ["siyb.agency"],
                },
            },
            {
                code: "siyb.summary",
                name: "siyb.summary",
                meta: {
                    title: "Summary",
                    requiresAuth: true,
                    sort: 8,
                    children: ["siyb.summar"],
                },
            },
        ],
    },
];
