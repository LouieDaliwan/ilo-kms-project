export default function isAuthenticated(to, from, next) {
    const isAuthenticated = localStorage.getItem("auth");

    console.log("isAuthenticated", isAuthenticated);
    if (isAuthenticated) {
        return next();
    }

    return next({ name: "login", query: { from: window.location.pathname } });
}
