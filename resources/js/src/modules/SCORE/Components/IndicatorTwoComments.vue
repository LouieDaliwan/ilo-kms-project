<script setup>
import { onMounted, ref } from "vue";

const loading = ref(false);
const nextItem = ref(1);
const items = ref([]);

const loadMore = () => {
    /** This is only for this demo, you could
     * replace the following with code to hit
     * an endpoint to pull in more data. **/
    loading.value = true;
    setTimeout((e) => {
        for (var i = 0; i < 20; i++) {
            items.value.push("Item " + nextItem.value++);
        }
        loading.value = false;
    }, 200);
    /**************************************/
};

onMounted(() => {
    // Detect when scrolled to bottom.
    const listElm = document.querySelector("#infinite-list");
    listElm.addEventListener("scroll", (e) => {
        if (listElm.scrollTop + listElm.clientHeight >= listElm.scrollHeight) {
            loadMore();
        }
    });

    // Initially load some items.
    loadMore();
});
</script>

<template>
    <div class="container">
        <div class="list-group-wrapper">
            <transition name="fade">
                <div v-show="loading" class="loading">
                    <span class="fa fa-spinner fa-spin"></span> Loading
                </div>
            </transition>
            <ul id="infinite-list" class="list-group">
                <li
                    v-for="item in items"
                    class="list-group-item"
                    v-text="item"
                ></li>
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
    height: 40vh;
    border: 2px solid #dce4ec;
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
