const routes = [];

import multiguard from "vue-router-multiguard";

Object.values(
    import.meta.glob("../src/modules/*/router/admin.js", { eager: true }),
).forEach((module) =>
    _.forEach(module.default, function (route, key) {
        routes.push(route);
    }),
);

export default {
    path: "/admin",
    name: "admin",
    redirect: { name: "dashboard" },
    component: () => import("@/Components/Layouts/Dashboard.vue"),
    meta: { title: "Admin", requiresAuth: true },
    children: routes,
    beforeEnter: multiguard([]),
};
