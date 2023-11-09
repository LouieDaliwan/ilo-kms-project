const routes = [];

Object.values(
    import.meta.glob("../src/modules/*/router/public.js", { eager: true }),
).forEach((module) =>
    _.forEach(module.default, function (route, key) {
        routes.push(route);
    }),
);

export default {
    path: "/:lang?",
    // name: "web",
    // component: () => import("@/Components/Layouts/Public.vue"),
    // meta: { title: "Admin", requiresAuth: false },
    children: routes.sort((a, b) => (a.meta.order > b.meta.order ? 1 : -1)),
};
