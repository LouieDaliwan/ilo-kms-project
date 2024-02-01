export default [
    {
        code: "fin-ed",
        name: "fin-ed",
        meta: {
            title: "FinED",
            icon: "mdi-account-settings",
            requiresAuth: true,
            sort: 4,
            roles: ["Superadmin"],
            children: ["fin-ed.about"],
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
                    children: ["fin-ed.about"],
                },
            },
        ],
    },
];
