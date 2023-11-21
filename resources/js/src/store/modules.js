// import * as _h from '@/core/helpers'

const modules = {};
const requireModules = {};

Object.values(
    import.meta.glob("/(modules|components)/w+/store/w+.js/", { eager: true }),
).forEach((module) =>
    _.forEach(module.default, function (route, key) {
        requireModules.push(route);
    }),
);

console.log(requireModules);

// requireModules.keys().forEach((filename) => {
//     const namespace = _h.strip_extension(_h.basename(filename, "/"));
//     modules[namespace] =
//         requireModules(filename).default || requireModules(filename);
// });

export default modules;
