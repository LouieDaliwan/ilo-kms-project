import slugify from "slugify";

export default {
    name: "slugify",
    methods: {
        slugify: function (string, separator = "-") {
            return slugify(string, {
                replacement: separator,
                lower: true,
            });
        },
    },
};
