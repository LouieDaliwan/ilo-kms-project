import _ from "lodash";

export default {
    install(app) {
        const componentFiles = import.meta.globEager("@/Components/**/*.vue");
        console.log(componentFiles);
        Object.entries(componentFiles).forEach(([path, component]) => {
            const componentName = _.upperFirst(
                _.camelCase(
                    path
                        .split("/")
                        .pop()
                        .replace(/\.\w+$/, ""),
                ),
            );
            console.log(componentName);
            app.component(componentName, component.default || component);
        });
    },
};
