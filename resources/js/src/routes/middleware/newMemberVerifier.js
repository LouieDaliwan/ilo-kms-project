export default function newMemberVerifier(to, from, next) {
    const isTemporaryPassword = localStorage.getItem("isTemporaryPassword");

    if (isTemporaryPassword === "true") {
        next({
            name: "change-password",
        });

        return "true";
    }

    next();
}
