export default {
    name: "page",
    computed: {
        heading: function () {
            const route = this.$route.currentRoute;

            return {
                description: route.meta.description,
                icon: route.meta.icon,
                text: route.meta.description,
                title: route.meta.title,
            };
        },
    },
};
