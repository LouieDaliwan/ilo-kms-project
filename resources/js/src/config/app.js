const app = {
    title: window.$app.meta["app:title"] || "Default Title",
    tagline: window.$app.meta["app:tagline"] || "Default Tagline",
    copyright: window.$app.meta["app:copyright"] || "Default Copyright",
    email: window.$app.meta["app:email"] || "Default Email",
    year: window.$app.meta["app:year"] || "Default Year",
    author: window.$app.meta["app:author"] || "Default Authot",
    logo: window.$app.logo || "Default Logo",
    locale: window.$app.locale || "Default Locale",
};

export default app;
