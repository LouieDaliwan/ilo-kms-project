const routes = [];

Object.values(
    import.meta.glob('../src/modules/*/router/admin.js', { eager: true })
).forEach((module) =>
    _.forEach(module.default, function(route, key) {
        routes.push(route);
    }
));

export default {
    path: '/admin',
    name: 'admin',
    redirect: {name: 'dashboard'},
    component: () => import('@/Components/Layouts/Dashboard.vue') ,
    meta: { title: 'Admin', requiresAuth: false },
    children: routes,
};
