export default [
    {
        code: "siyb",
        name: "siyb",
        meta: {
            title: "SIYB",
            icon: "mdi-briefcase",
            requiresAuth: true,
            sort: 3,
            roles: ["Superadmin", "Member"],
            children: [
                "siyb.about",
                "siyb.agency",
                "siyb.summary",
                "siyb.clients",
            ],
        },
        children: [
            {
                code: "fin-ed.about",
                name: "fin-ed.about",
                meta: {
                    title: "About",
                    requiresAuth: true,
                    sort: 1,
                    roles: ["Superadmin", "Members"],
                    children: ["siyb.about"],
                },
            },
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
                    sort: 2,
                    roles: ["Superadmin", "Member"],
                    children: ["siyb.agency"],
                },
            },
            {
                code: "siyb.summary",
                name: "siyb.summary",
                meta: {
                    title: "Agency Summary",
                    requiresAuth: true,
                    sort: 3,
                    children: ["siyb.summary"],
                    roles: ["Superadmin", "Member"],
                },
            },
            {
                code: "siyb.clients",
                name: "siyb.clients",
                meta: {
                    title: "Clients",
                    requiresAuth: true,
                    sort: 3,
                    children: ["siyb.clients"],
                    roles: ["Superadmin", "Member"],
                },
            },
            {
                code: "siyb.clients-summary",
                name: "siyb.clients-summary",
                meta: {
                    title: "Clients Summary",
                    requiresAuth: true,
                    sort: 3,
                    children: ["siyb.clients-summary"],
                    roles: ["Superadmin", "Member"],
                },
            },
        ],
    },
];
