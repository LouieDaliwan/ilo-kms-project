export default {
    list() {
        return "/api/v1/wise-participants";
    },

    participant(id = null) {
        return `/api/v1/wise-participants/${id}`;
    },

    evaluations() {
        return "/api/v1/wise-evaluations";
    },

    activityReports() {
        return "/api/v1/wise-activity-plus";
    },

    activityReport(id = null) {
        return `/api/v1/wise-activity-plus/${id}`;
    },

    uploadParticipants() {
        return "/api/v1/upload-wise-participants";
    },
    uploadActivityPlus() {
        return "/api/v1/upload-wise-activity-plus";
    },
    uploadEvaluation() {
        return "/api/v1/upload-wise-evaluation";
    },
};
