const routes = [];

Object.values(
    import.meta.glob('../src/modules/*/router/admin.js', { eager: true })
).forEach((module) =>
    _.forEach(module.default, function(route, key) {
        routes.push(route);
    }
));

export default {
    path: '/dashboard',
    name: 'dashboard',
    redirect: {name: 'dashboard'},
    component: () => import('@/Components/Layouts/Dashboard.vue') ,
    meta: { requiresAuth: false },
    children: routes,
};
