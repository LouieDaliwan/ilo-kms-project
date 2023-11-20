import * as yup from "yup";

export const loginSchema = yup.object({
    email: yup.string().required().label("Email/Username"),
    password: yup.string().min(6).required().label("Password"),
    current_password: yup.string().min(6).required().label("Current Password"),
    confirm_password: yup
        .string()
        .required()
        .oneOf([yup.ref("password")], "Password do not match")
        .label("Confirm Password"),
});
