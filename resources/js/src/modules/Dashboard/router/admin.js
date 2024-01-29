export default [
    {
        path: "dashboard",
        name: "dashboard",
        component: () => import("../Dashboard.vue"),
        meta: {
            title: "Dashboard",
            description: "Overview of the app.",
            sort: 0,
            requiresAuth: true,
            permission: false,
            roles: ["Superadmin", "Member"],
            // icon: 'dashboard',
        },
    },
    {
        path: "dashboard",
        name: "divider:dashboard",
        meta: {
            sort: 1,
            divider: true,
            height: 2,
            roles: ["Superadmin", "Member"],
        },
    },
];
