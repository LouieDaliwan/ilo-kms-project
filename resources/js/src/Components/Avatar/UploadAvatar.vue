<script>
export default {
    name: "UploadAvatar",
    props: ["value", "name", "thumbnail", "avatar"],
    emits: ["update:value", "change"],
    data(vm) {
        return {
            file: null,
            preview: JSON.parse(JSON.stringify(vm.value || "")),
            previewWasFromFileBrowser: false,
        };
    },
    computed: {
        hasPreview() {
            return !window._.isEmpty(this.preview);
        },
        parsedAvatar() {
            return this.avatar ? this.avatar : "avatar";
        },
    },
    methods: {
        openFileBrowser() {
            this.$refs["fileupload"].click();
        },
        clearPreview() {
            this.preview = null;
            this.file = null;
        },
        onFileChange(e) {
            this.file = e.target.files[0];
            if (this.file) {
                this.previewWasFromFileBrowser = true;
                this.preview = URL.createObjectURL(this.file);
            }
        },
    },
    watch: {
        value(val) {
            if (!this.previewWasFromFileBrowser) {
                this.preview = val;
            }
        },
        file(val) {
            this.$emit("update:value", val);
            this.$emit("change", val);
        },
    },
};
</script>
<template>
    <div
        :style="`background-image:url(${preview})`"
        class="dt-avatar-preview selects"
    >
        <div class="d-flex justify-end ml-5 mt-4">
            <div class="mt-11" style="margin-right: -58px">
                <v-btn v-if="hasPreview" fab x-small @click="clearPreview">
                    <v-icon color="muted" small>mdi-close</v-icon>
                </v-btn>
            </div>
            <div>
                <v-btn fab small @click="openFileBrowser">
                    <v-icon color="muted" small>mdi-upload</v-icon>
                </v-btn>
            </div>
            <input
                ref="fileupload"
                :name="name"
                accept="image/x-png,image/gif,image/jpeg"
                class="d-none"
                type="file"
                @change="onFileChange"
            />
            <input v-model="preview" :name="parsedAvatar" type="hidden" />
        </div>
    </div>
</template>
