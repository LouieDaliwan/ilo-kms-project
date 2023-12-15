export default function isAuthenticated(to, from, next) {
    const getAuthCheck = async () => {
        const data = await axios
            .get("/api/auth-check", {
                Accept: "application/json",
            })
            .then((response) => {
                const isAuthenticated = true;
                const isTemporaryPassword =
                    response.data.auth.isTemporaryPassword;
                if (isAuthenticated && isTemporaryPassword !== "true") {
                    return next();
                } else if (isAuthenticated && isTemporaryPassword === "true") {
                    nextChangePassword();
                } else {
                    nextLogin();
                }
            })
            .catch((error) => {
                if (error.response.status === 401) nextLogout();
                else {
                    return next({
                        name: "login",
                        query: { from: window.location.pathname },
                    });
                }
            });

        return data;
    };

    const nextLogout = async () => {
        return next({
            name: "logout",
            query: { from: window.location.pathname },
        });
    };

    const nextLogin = async () => {
        return next({
            name: "login",
            query: { from: window.location.pathname },
        });
    };

    const nextChangePassword = async () => {
        return next({
            name: "change-password",
            query: { from: window.location.pathname },
        });
    };

    getAuthCheck();
}
