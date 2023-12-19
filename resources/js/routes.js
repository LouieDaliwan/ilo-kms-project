import a from "./router/admin.js";
import w from "./router/web.js";
import p from "./router/public.js";
import e from "./router/error.js";

const routes = [].concat([a], w, [p], e);

export default routes;
