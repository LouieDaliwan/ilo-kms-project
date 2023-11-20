import * as yup from "yup";

export const loginSchema = yup.object({
    email: yup.string().required().label("Email/Username"),
    password: yup.string().min(6).required().label("Password"),
});
