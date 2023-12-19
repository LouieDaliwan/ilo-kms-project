const modules = {};
const requireModules = [];

const modulesFiles = import.meta.glob("../(modules|Components)/*/store/*.js");

Object.keys(modulesFiles).forEach((modulePath) => {
    const moduleName = modulePath.replace(/^.*[\\\/]/, "").split(".")[0];
    requireModules.push(moduleName);
    modules[moduleName] = modulesFiles[modulePath];
});

export default modules;
