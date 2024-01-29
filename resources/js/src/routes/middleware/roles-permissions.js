import $auth from "@/core/Auth/auth";

export default function permissions(to, from, next) {
    if (!to.meta.requiresAuth) {
        return next();
    }

    if ($auth.isSuperAdmin()) {
        return next();
    }

    console.log("after superadmin");

    if ($auth.isAdmin()) {
        return next();
    }

    console.log("after admin");

    if (to.name && $auth.hasPermission(to.name)) {
        return next();
    }

    console.log("after permission");

    if (to.meta.roles && $auth.checkRoles(to.meta.roles)) {
        return next();
    }

    return next({
        name: "error.403",
        query: { from: window.location.pathname },
    });
}
