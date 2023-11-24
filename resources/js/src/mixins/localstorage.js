export default {
    name: "localstorage",
    methods: {
        localstorage(key, value) {
            // Check if `key` is object,
            // then store the object on localstorage
            if (typeof key === "object") {
                return Object.keys(key).forEach((k) => {
                    return window.localStorage.setItem(k, key[k]);
                });

                // else retrieve,
                // if non retrieve, will default to `value`
            } else {
                return window.localStorage.getItem(key) !== null
                    ? window.localStorage.getItem(key)
                    : value;
            }
        },
    },
};
