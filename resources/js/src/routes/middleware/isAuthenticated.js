export default function isAuthenticated(to, from, next) {
    const isAuthenticated = false;

    if (isAuthenticated) {
        return next();
    }

    return next({ name: "login", query: { from: window.location.pathname } });
}
