import * as yup from "yup";

export const changePasswordValidation = yup.object({
    password: yup.string().min(6).required().label("Password"),
    current_password: yup.string().min(6).required().label("Current Password"),
    password_confirmation: yup
        .string()
        .required()
        .oneOf([yup.ref("password")], "Password do not match")
        .label("Confirm New Password"),
});
