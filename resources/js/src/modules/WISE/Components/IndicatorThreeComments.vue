<script setup>
import { onMounted, ref } from "vue";
import $api from "../routes/api.js";

const loading = ref(false);
const nextItem = ref(1);
const items = ref([]);
const offset = ref(0);
const limit = ref(5);

const loadMore = () => {
    loading.value = true;
    setTimeout((e) => {
        axios
            .get($api.indicatorThreeComments(), {
                params: {
                    offset: offset.value,
                    limit: limit.value,
                },
            })
            .then(({ data }) => {
                items.value.length === 0
                    ? (items.value = data)
                    : items.value.push(...data);
            })
            .catch((err) => {
                console.log(err);
            });

        loading.value = false;
    }, 200);
    /**************************************/
};

onMounted(() => {
    // Detect when scrolled to bottom.
    const listElm = document.querySelector("#infinite-list");
    listElm.addEventListener("scroll", (e) => {
        if (listElm.scrollTop + listElm.clientHeight >= listElm.scrollHeight) {
            offset.value += 5;
            loadMore();
        }
    });

    // Initially load some items.
    loadMore();
});
</script>

<template>
    <div class="pa-5 mt-10 workplan-completion rounded">
        <h2 class="text-tertiary-color">Comments in Training</h2>
        <div class="list-group-wrapper mt-3">
            <transition name="fade">
                <div v-show="loading" class="loading">
                    <span class="fa fa-spinner fa-spin"></span> Loading
                </div>
            </transition>
            <ul id="infinite-list" class="list-group">
                <div v-for="item in items">
                    <v-card class="mb-1">
                        <v-card-title>
                            <p>I know my rights related to OSH</p>
                        </v-card-title>

                        <v-card-text>
                            <small class="text-muted">{{ item.first_question_comment }}</small>
                        </v-card-text>
                    </v-card>

                    <v-card class="mb-1">
                        <v-card-title>
                            <p>I know my duties related to OSH</p>
                        </v-card-title>

                        <v-card-text>
                            <small class="text-muted">{{ item.second_question_comment }}</small>
                        </v-card-text>
                    </v-card>

                    <v-card class="mb-1">
                        <v-card-title>
                            <p>I am able to use my rights related to OSH</p>
                        </v-card-title>

                        <v-card-text>
                            <small>{{ item.third_question_comment }}</small>
                        </v-card-text>
                    </v-card>

                    <v-card class="mb-1">
                        <v-card-title>
                            <p>I am able to carry out my duties related to OSH</p>
                        </v-card-title>

                        <v-card-text>
                            <small>{{ item.fourth_question_comment }}</small>
                        </v-card-text>
                    </v-card>
                </div>
            </ul>
        </div>
    </div>
</template>

<style scoped>
body {
    background-color: #5c4084;
    padding: 50px;
}

.container {
    padding: 80px 50px 15px 80px;
    background-color: #fff;
    border-radius: 8px;
    max-width: 100vw;
}

.list-group-wrapper {
    position: relative;
}

.list-group {
    overflow: auto;
    height: 100vh;
    /* border: 2px solid #dce4ec; */
    border-radius: 5px;
}

.list-group-item {
    margin-top: 1px;
    border-left: none;
    border-right: none;
    border-top: none;
    border-bottom: 2px solid #dce4ec;
}

.loading {
    text-align: center;
    position: absolute;
    color: #fff;
    z-index: 9;
    background: #5c4084;
    padding: 8px 18px;
    border-radius: 5px;
    left: calc(50% - 45px);
    top: calc(50% - 18px);
}

.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s;
}

.fade-enter,
.fade-leave-to {
    opacity: 0;
}
</style>
