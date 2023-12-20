export default [
    {
        code: "wise",
        name: "wise",
        meta: {
            title: "WISE",
            icon: "mdi-briefcase-outline",
            requiresAuth: true,
            sort: 5,
            children: [
                "wise.dashboard",
                "wise.participants",
                "wise.activity-plus",
                "wise.evaluations",
            ],
        },
        children: [
            {
                code: "wise.dashboard",
                name: "wise.dashboard",
                meta: {
                    title: "Dashboard",
                    requiresAuth: true,
                    sort: 6,
                    children: ["wise.dashboard"],
                },
            },
            {
                code: "wise.participants",
                name: "wise.participants",
                meta: {
                    title: "Participants",
                    requiresAuth: true,
                    sort: 7,
                    children: ["wise.participants"],
                },
            },
            {
                code: "wise.activity-plus",
                name: "wise.activity-plus",
                meta: {
                    title: "Activity Plus",
                    requiresAuth: true,
                    sort: 8,
                    children: ["wise.activity-plus"],
                },
            },
            {
                code: "wise.evaluations",
                name: "wise.evaluations",
                meta: {
                    title: "Participants Evaluation",
                    requiresAuth: true,
                    sort: 9,
                    children: ["wise.evaluations"],
                },
            },
        ],
    },
];
