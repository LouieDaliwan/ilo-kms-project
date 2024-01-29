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
        return JSON.parse(window.localStorage.getItem("auth") || "{}");
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

    checkRoles(roles) {
        return window._.includes(roles, this.role());
    }

    isSuperAdmin() {
        return this.role() === "Superadmin" || false;
    }

    isAdmin() {
        return this.role() === "Admin" || false;
    }

    isNotSuperAdmin() {
        return !this.isSuperAdmin();
    }

    role() {
        return this.getUser().roles[0].name || "";
    }
}

export default new Auth();
