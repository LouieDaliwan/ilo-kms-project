export default function isAuthenticated(to, from, next) {
    const isAuthenticated = localStorage.getItem("auth");
    const isTemporaryPassword = localStorage.getItem("isTemporaryPassword");

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
}
