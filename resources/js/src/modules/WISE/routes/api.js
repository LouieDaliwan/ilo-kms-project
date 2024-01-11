export default {
    overall() {
        return "/api/v1/wise-overall";
    },

    list() {
        return "/api/v1/wise-participants";
    },

    participant(id = null) {
        return `/api/v1/wise-participants/${id}`;
    },

    participantActivity(id = null) {
        return `/api/v1/wise-participants/${id}/activity-plus`;
    },

    participantEvaluation(id = null) {
        return `/api/v1/wise-participants/${id}/evaluations`;
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
