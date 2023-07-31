import { defineStore } from "pinia";

export const useToolbarStore = defineStore("toolbar", {
    state: () => {
        return {
            toolbar: {
                model: "",
                title: "",
                tooltipName: "",
                filter: false,
                sort: false,
                listGridView: true,
                toggleview: true,
                showBulk: false,
                verticaldiv: true,
            },
        };
    },
    getters: {
        getToolbar: (state) => state.toolbar,
    },
    actions: {
        emptyState() {
            this.toolbar = null;
        },

        updateToolbar(payload) {
            this.toolbar = Object.assign(this.toolbar, payload);
        },
    },
});
