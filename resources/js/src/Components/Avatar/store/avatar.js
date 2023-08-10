import { defineStore } from "pinia";

export const useAvatarStore = defineStore("avatar", {
    state: () => {
        return {
            uploadAvatar: {},
        };
    },
    getters: {
        getUploadAvatar: (state) => state.uploadAvatar,
    },
    actions: {
        update(payload) {
            this.uploadAvatar = Object.assign(this.uploadAvatar, payload);
        },
    },
});
