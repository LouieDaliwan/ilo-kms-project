import { createRouter, createWebHistory }  from 'vue-router';
import routes from '@js/routes.js'
// import store from '@/store'
// import metatags from '@/r outes/helpers/metatags'

const router = createRouter({
  history: createWebHistory(),
  routes,
});


/**
 * Modify data before routes render into page.
 *
 * @param to, from, next
 * @return void
 */
router.beforeEach((to, from, next) => {
    /**
     * This goes through the matched routes from last to first,
     * finding the closest route with a title.
     * eg. if we have /some/deep/nested/route
     * and /some, /deep, and /nested have titles, nested's will be chosen.
     */
    // metatags.set(to, from, next)

    if (!document.cookie && to.path !== '/login') {
        next();
    } else {
        next();
        // next({ params: { lang: 'en', from: window.location.pathname } })
    }
});


export default router;
