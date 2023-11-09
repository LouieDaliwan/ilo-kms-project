import $api from "@/routes/api.js";

export default function tokenVerifier(to, from, next) {
    return new Promise((resolve, reject) => {
        window.axios
            .post($api.validate.token)
            .then((response) => {
                next();
                resolve(response);
            })
            .catch((error) => {
                localStorage.removeItem("user");
                localStorage.removeItem("token");
                next({
                    name: "login",
                    query: { from: window.location.pathname },
                });
            });
    });
}
