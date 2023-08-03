export default [
    {
        code: "dleaders",
        name: "dleaders",
        meta: {
            title: "Dgroup Leaders",
            icon: "mdi-domain",
            requiresAuth: false,
            sort: 5,
            children: ["dleaders.all", "dleaders.create"],
        },
        children: [
            {
                code: "dleaders.all",
                name: "dleaders.all",
                meta: {
                    title: "All Dgroup Leaders",
                    requiresAuth: false,
                    sort: 6,
                    children: ["dleaders.all"],
                },
            },
            {
                code: "dleaders.create",
                name: "dleaders.create",
                meta: {
                    title: "DLeader Create",
                    requiresAuth: false,
                    sort: 7,
                    children: ["dleaders.create"],
                },
            },
        ],
    },
];
