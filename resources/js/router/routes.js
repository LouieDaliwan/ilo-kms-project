import { createRouter, createWebHistory }  from 'vue-router';

const Home = { template: '<div>Home</div>' }
const About = { template: '<div>About</div>' }
const NotFound = {template: '<div>Not Found</div>'}

const routes = [
    { path: '/', component: Home },
    { path: '/about', component: About },
    { path: '/:pathMatch(.*)*', name: 'NotFound', component: NotFound },
];

Object.values(
    import.meta.glob('../src/modules/*/router/*.js', { eager: true })
).forEach((module) =>
    _.forEach(module.default, function(route, key) {
        routes.push(route);
    }
));

const router = createRouter({
    // 4. Provide the history implementation to use. We are using the hash history for simplicity here.
    history: createWebHistory(),
    routes, // short for `routes: routes`
});


export default router;


