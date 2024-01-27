export default [
    {
        code: "wise",
        name: "wise",
        meta: {
            title: "WISE",
            icon: "mdi-briefcase-outline",
            requiresAuth: true,
            sort: 5,
            roles: ["Superadmin", "Member"],
            children: [
                "wise.dashboard",
                "wise.participants",
                "wise.activity-plus",
                "wise.evaluations",
                "wise.indicator_one",
                "wise.indicator_two",
                "wise.indicator_three",
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
                    roles: ["Superadmin", "Member"],
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
                    roles: ["Superadmin", "Member"],
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
                    roles: ["Superadmin", "Member"],
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
                    roles: ["Superadmin", "Member"],
                },
            },
            {
                code: "wise.indicator_one",
                name: "wise.indicator_one",
                meta: {
                    title: "Wise Indicator One",
                    requiresAuth: true,
                    sort: 7,
                    children: ["wise.indicator_one"],
                    roles: ["Superadmin", "Member"],
                },
            },
            {
                code: "wise.indicator_two",
                name: "wise.indicator_two",
                meta: {
                    title: "Wise Indicator Two",
                    requiresAuth: true,
                    sort: 8,
                    children: ["wise.indicator_two"],
                    roles: ["Superadmin", "Member"],
                },
            },
            {
                code: "wise.indicator_three",
                name: "wise.indicator_three",
                meta: {
                    title: "Wise Indicator Three",
                    requiresAuth: true,
                    sort: 9,
                    children: ["wise.indicator_three"],
                    roles: ["Superadmin", "Member"],
                },
            },
        ],
    },
];
