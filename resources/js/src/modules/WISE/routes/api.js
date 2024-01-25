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

    indicatorOneData() {
        return "/api/v1/wise-indicator-one-data";
    },

    uploadIndicatorOne() {
        return "/api/v1/upload-wise-indicator-one";
    },

    indicatorTwoData() {
        return "/api/v1/wise-indicator-two-data";
    },

    indicatorTwoComments() {
        return "/api/v1/wise-indicator-two-comments";
    },

    uploadIndicatorTwo() {
        return "/api/v1/upload-wise-indicator-two";
    },

    indicatorThreeData() {
        return "/api/v1/wise-indicator-three-data";
    },

    indicatorThreeComments() {
        return "/api/v1/wise-indicator-three-comments";
    },

    uploadIndicatorThree() {
        return "/api/v1/upload-wise-indicator-three";
    },
};
