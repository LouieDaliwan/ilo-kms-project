const routes = []

Object.values(
    import.meta.glob('../src/modules/*/config/sidebar.js', { eager: true })
).forEach((module) =>
    _.forEach(module.default, function(route, key) {
        routes.push(route);
    }
));

export default routes.sort((a, b) => a.meta.sort - b.meta.sort)
