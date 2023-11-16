export default [
    {
        path: "/",
        name: "authenticated",
        redirect: { name: "change-password" },
        component: () => import("@/components/Layouts/Admin.vue"),
        meta: {
            title: "Change Password",
            sort: 0,
            requiresAuth: false,
            icon: "mdi-account-key",
        },
        children: [
            {
                path: "/change-password",
                name: "change-password",
                component: () => import("../SetNewPassword.vue"),
                meta: {
                    title: "Set New Password",
                    sort: 0,
                    requiresAuth: false,
                    icon: "mdi-account-key",
                },
                beforeEnter: (to, from, next) => {
                    const isAuthenticated = localStorage.getItem("auth");
                    const isTemporaryPassword = localStorage.getItem(
                        "isTemporaryPassword",
                    );

                    if (isAuthenticated && !isTemporaryPassword) {
                        let from = to.query.from || { name: "dashboard" };
                        return next(from);
                    } else {
                        return next();
                    }
                },
            },
        ],
    },
];
