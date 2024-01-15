import $auth from "@/core/Auth/auth";

export default function permissions(to, from, next) {
    if (!to.meta.authenticatable) {
        return next();
    }

    if ($auth.isSuperAdmin()) {
        return next();
    }

    if ($auth.isAdmin()) {
        return next();
    }

    if (to.name && $auth.hasPermission(to.name)) {
        return next();
    }

    return next({
        name: "error.403",
        query: { from: window.location.pathname },
    });
}
