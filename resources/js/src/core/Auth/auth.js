class Auth {
    constructor() {
        this.token = null;
        this.user = null;
        this.id = null;
    }

    authorize(token, user) {
        window.localStorage.setItem("token", token);
        window.localStorage.setItem("user", JSON.stringify(user));
        axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;

        this.token = token;
        this.user = user;
        this.id = user.id;
    }

    getUser() {
        return JSON.parse(window.localStorage.getItem("user") || "{}");
    }

    getId() {
        return this.getUser().id;
    }

    check() {
        return !!this.token;
    }

    hasPermission(permission) {
        return (
            permission === false ||
            window._.includes(this.getUser().permissions || [], permission)
        );
    }

    isSuperAdmin() {
        return this.getUser()["is:superadmin"] || false;
    }

    isNotSuperAdmin() {
        return !this.isSuperAdmin();
    }
}

export default new Auth();
