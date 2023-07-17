import { createRouter, createWebHistory }  from 'vue-router';

const Home = { template: '<div>Home</div>' }
const About = { template: '<div>About</div>' }


const routes = [
    { path: '/', component: Home },
    { path: '/about', component: About },
];

Object.values(
    import.meta.glob('../src/modules/*/router/*.js', { eager: true })
).forEach((module) =>
    _.forEach(module.default, function(route, key) {
        routes.push(route);
    }
));

Object.values(
    import.meta.glob('./error.js', { eager: true})
).forEach((module) =>
    _.forEach(module.default, function(route, key) {
        routes.push(router)
    })
)

const router = createRouter({
    // 4. Provide the history implementation to use. We are using the hash history for simplicity here.
    history: createWebHistory(),
    routes, // short for `routes: routes`
});


export default router;


