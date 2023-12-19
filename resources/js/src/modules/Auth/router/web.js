export default [
    {
        path: "/auth",
        name: "auth",
        redirect: { name: "login" },
        component: () => import("@/components/Layouts/Auth.vue"),
        meta: {
            title: "Login",
            sort: 0,
            requiresAuth: false,
            icon: "mdi-account-key",
        },
        children: [
            {
                path: "/login",
                name: "login",
                component: () => import("../Signin.vue"),
                meta: {
                    title: "Sign In",
                    sort: 0,
                    requiresAuth: false,
                    icon: "mdi-account-key",
                },
                beforeEnter: (to, from, next) => {
                    const isAuthenticated = localStorage.getItem("auth");
                    const isTemporaryPassword = localStorage.getItem(
                        "isTemporaryPassword",
                    );

                    if (isAuthenticated && isTemporaryPassword !== "false") {
                        let from = to.query.from || {
                            name: "dashboard",
                        };
                        return next(from);
                    } else if (
                        isAuthenticated &&
                        isTemporaryPassword === "true"
                    ) {
                        let from = { name: "change-password" };
                        return next(from);
                    } else {
                        return next();
                    }
                },
            },
            {
                path: "change-password",
                name: "change-password",
                component: () => import("../ChangePassword.vue"),
                meta: {
                    title: "Change Password",
                    sort: 6,
                    requiresAuth: true,
                    icon: "mdi-book-multiple-variant",
                },
                beforeEnter: (to, from, next) => {
                    const isAuthenticated = localStorage.getItem("auth");
                    const token = localStorage.getItem("auth_token");
                    const isTemporaryPassword = localStorage.getItem(
                        "isTemporaryPassword",
                    );

                    if (isAuthenticated === null && token === null) {
                        return next({ name: "login" });
                    }

                    if (
                        isAuthenticated &&
                        isTemporaryPassword !== "true" &&
                        token !== null
                    ) {
                        return next({ name: "dashboard" });
                    }

                    return next();
                },
            },
            {
                path: "/logout",
                name: "logout",
                beforeEnter: (to, from, next) => {
                    axios
                        .post("/logout")
                        .then(({ data }) => {
                            localStorage.removeItem("auth");
                            localStorage.removeItem("two_factor");
                            localStorage.removeItem("rail");
                            localStorage.removeItem("isTemporaryPassword");
                            localStorage.removeItem("auth_token");
                            next({ name: "login" });
                        })
                        .catch((err) => {
                            console.log(err);
                        });
                },
            },
        ],
    },
];
