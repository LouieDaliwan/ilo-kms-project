export default function isAuthenticated(to, from, next) {
    const isAuthenticated = localStorage.getItem("auth");

    if (isAuthenticated) {
        return next();
    }

    return next({ name: "login", query: { from: window.location.pathname } });
}
