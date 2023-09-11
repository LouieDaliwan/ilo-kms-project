export default {
    loading: false,
    search: "",
    options: {
        page: 1,
        pageCount: 0,
        itemsPerPage: 10,
        sortDesc: [],
        sortBy: [],
        // rowsPerPage: [5, 10, 15, 20, 50, 100],
    },
    meta: {},
    modes: {
        bulkedit: false,
    },
    selected: [],
    headers: [
        {
            text: "Account Name",
            align: "left",
            value: "displayname",
            class: "text-no-wrap",
            key: "displayname",
        },
        {
            text: "Role",
            value: "role",
            class: "text-no-wrap",
            key: "role",
        },
        {
            text: "Last Modified",
            value: "modified_at",
            class: "text-no-wrap",
            key: "updated_at",
        },
        {
            text: "Actions",
            align: "center",
            value: "action",
            sortable: false,
            class: "muted--text text-no-wrap",
            key: "action",
        },
    ],
    data: [],
};
