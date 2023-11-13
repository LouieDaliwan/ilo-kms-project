export default [
    {
        path: "/",
        name: "authenticated",
        redirect: { name: "set-new-password" },
        component: () => import("@/components/Layouts/Auth.vue"),
        meta: {
            title: "Set New Password",
            sort: 0,
            requiresAuth: false,
            icon: "mdi-account-key",
        },
        children: [
            {
                path: "/set-new-password",
                name: "set-new-password",
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
