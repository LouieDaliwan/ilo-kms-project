export default function tokenVerifier(to, from, next) {
    const token = localStorage.getItem("auth_token");

    if (!token) {
        localStorage.removeItem("auth");
        localStorage.removeItem("auth_token");
        localStorage.removeItem("rail");
        localStorage.removeItem("two_factor");
        localStorage.removeItem("isTemporaryPassword");
        next({
            name: "logout",
            query: { from: window.location.pathname },
        });
    }

    next();
}
