export default {
    name: "trans",
    methods: {
        trans: function (string, defaultString) {
            return this.$i18n.tc(string, 1, defaultString);
        },

        __: function (string, defaultString) {
            return this.trans(string, defaultString);
        },

        trans_choice: function (string, choice, stringVariable) {
            return this.$i18n.tc(string, choice, stringVariable);
        },
    },
};
