const routes = [
    {
        path: "/admin/score",
        name: "score.index",
        component: () => import("@root/App.vue"),
        meta: {
            title: "Score",
            sort: 6,
            requiresAuth: true,
            icon: "mdi-book-multiple-variant",
        },
        children: [
            {
                path: "dashboard",
                name: "score.dashboard",
                component: () => import("../Index.vue"),
                meta: {
                    title: "Score Dashboard",
                    sort: 6,
                    requiresAuth: true,
                    //   permission: 'customers.index',
                    icon: "mdi-book-multiple-variant",
                },
            },
            {
                path: "indicator-one",
                name: "score.indicator_one",
                component: () => import("../IndicatorOne.vue"),
                meta: {
                    title: "Score Indicator One",
                    sort: 7,
                    requiresAuth: true,
                    //   permission: 'customers.index',
                    icon: "mdi-book-multiple-variant",
                },
            },
            {
                path: "indicator-two",
                name: "score.indicator_two",
                component: () => import("../IndicatorTwo.vue"),
                meta: {
                    title: "Score Indicator Two",
                    sort: 7,
                    requiresAuth: true,
                    //   permission: 'customers.index',
                    icon: "mdi-book-multiple-variant",
                },
            },
            {
                path: "indicator-three",
                name: "score.indicator_three",
                component: () => import("../IndicatorThree.vue"),
                meta: {
                    title: "Score Indicator Three",
                    sort: 7,
                    requiresAuth: true,
                    //   permission: 'customers.index',
                    icon: "mdi-book-multiple-variant",
                },
            },
        ],
    },
];

export default routes;
