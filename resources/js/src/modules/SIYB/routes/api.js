export default {
    list() {
        return "/api/v1/siyb-agencies";
    },

    uploadAgency() {
        return "/api/v1/upload-siyb-status-agency";
    },

    summaryAgency() {
        return "/api/v1/siyb-agency-summary-data";
    },

    uploadClients() {
        return "/api/v1/upload-siyb-clients";
    },

    listClients() {
        return "/api/v1/siyb-clients";
    },

    summaryClients() {
        return "/api/v1/siyb-clients-summary-data";
    },

    client(id = null) {
        return `/api/v1/siyb-clients/${id}`;
    },
};
