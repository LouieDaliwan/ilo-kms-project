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
                    return next({
                        name: "change-password",
                        query: { from: window.location.pathname },
                    });
                } else {
                    return next({
                        name: "login",
                        query: { from: window.location.pathname },
                    });
                }
            })
            .catch((error) => {
                if (error.response.status === 401)
                    return next({
                        name: "logout",
                        query: { from: window.location.pathname },
                    });
            });

        return data;
    };

    getAuthCheck();
}
