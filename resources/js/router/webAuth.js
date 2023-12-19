const routes = [];

Object.values(
    import.meta.glob("../src/modules/*/router/webAuth.js", { eager: true }),
).forEach((module) =>
    _.forEach(module.default, function (route, key) {
        routes.push(route);
    }),
);

export default {
    path: "/auth",
    name: "webAuth",
    component: () => import("@/Components/Layouts/Admin.vue"),
    meta: { title: "Auth", requiresAuth: true },
    children: routes,
};
