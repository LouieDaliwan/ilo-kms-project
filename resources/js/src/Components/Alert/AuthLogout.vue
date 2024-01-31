<script>
import { useRouter } from "vue-router";

export default {
    name: "AutoLogout",
    data: function () {
        return {
            events: [
                "click",
                "mousemove",
                "mousedown",
                "scroll",
                "keypress",
                "load",
            ],
            warningTimer: null,
            logoutTimer: null,
            warningZone: false,
        };
    },
    setup() {
        const router = useRouter();
        return {
            router,
        };
    },
    mounted() {
        this.events.forEach(function (event) {
            window.addEventListener(event, this.resetTimer);
        }, this);
        this.setTimers();
        this.authEmpty();
    },
    destroyed() {
        this.events.forEach(function (event) {
            window.removeEventListener(event, this.resetTimer);
        }, this);
        this.resetTimer();
    },
    methods: {
        setTimers: function () {
            this.warningTimer = setTimeout(this.warningMessage, 7140000); // 14 minutes - 14 * 60 * 1000
            this.logoutTimer = setTimeout(this.logoutUser, 2 * 60 * 60 * 1000); // 2hrs
            this.warningZone = false;
        },
        warningMessage: function () {
            // this.warningZone = true;
            window.alert("You will be logged out automatically in 1 minute");
        },
        logoutUser: function () {
            // Laravel
            this.router.push({
                name: "logout",
            });
        },
        resetTimer: function () {
            clearTimeout(this.warningTimer);
            clearTimeout(this.logoutTimer);
            this.setTimers();
        },
        authEmpty: function () {
            if (localStorage.getItem("auth") === "") {
                return this.logoutUser()
            }
        }
    },
};
</script>

<template>
    <div v-if="warningZone">Are you still with us?</div>
</template>
