<script setup>
import ProfileInformation from "./cards/Information.vue";
import ChangePassword from "./ChangePassword.vue";
</script>
<template>
    <admin>
        <metatag :title="'User Profile'"></metatag>
        <ProfileInformation />
        <ChangePassword />
    </admin>
</template>
