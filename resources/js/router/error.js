const NotFound = { template: "<div>Not Found</div>" };

export default [
    {
        path: "/:pathMatch(.*)*",
        redirect: { name: "error.404" },
        component: () => import("@/components/Errors/404.vue"),
        meta: {
            title: "404 Not Found",
            excludeInMenu: true,
            sort: 10000,
            external: true,
            excludeFromRoot: true,
            authenticatable: false,
        },
    },
    {
        path: "/403",
        name: "error.403",
        component: () => import("@/components/Errors/403.vue"),
        meta: {
            title: "403 Unauthorized",
            excludeInMenu: true,
            sort: 9999,
            external: true,
            excludeFromRoot: true,
            authenticatable: false,
        },
    },
    {
        path: "/404",
        name: "error.404",
        component: () => import("@/components/Errors/404.vue"),
        meta: {
            title: "404 Not Found",
            excludeInMenu: true,
            sort: 10000,
            external: true,
            excludeFromRoot: true,
            authenticatable: false,
        },
    },
];
