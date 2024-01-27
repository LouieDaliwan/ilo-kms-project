export default [
    {
        name: "dashboard",
        meta: {
            title: "Dashboard",
            sort: 0,
            requiresAuth: false,
            icon: "mdi-view-dashboard-outline",
            permission: false,
            roles: ["Superadmin", "Member"],
        },
    },
    {
        name: "divider:dashboard/index",
        meta: {
            title: "",
            sort: 1,
            subheader: true,
            height: 2,
            roles: ["Superadmin", "Member"],
        },
    },
];
