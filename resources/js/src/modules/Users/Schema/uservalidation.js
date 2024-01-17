import * as yup from "yup";

export const userSchema = yup.object({
    firstname: yup.string().required().label("First Name"),
    lastname: yup.string().required().label("Last Name"),
    email: yup.string().email().required().label("Email"),
    suffixname: yup.string().nullable().label("Suffix"),
    prefixname: yup.string().nullable().label("Prefix"),
    avatar: yup.object().label("Avatar"),
    backgroundDetails: yup.array().nullable().label("Background Details"),
    username: yup.string().required().label("Username"),
    mobile_number: yup
        .string()
        .required()
        .matches(/^[0-9]+$/, "Must be only digits")
        .min(10)
        .max(11)
        .label("Mobile Number"),
    home_address: yup.string().required().label("Home Address"),
    password: yup.string().min(6).nullable().label("Password"),
    roles: yup.string().required().max(10).label("Roles"),
    confirm_password: yup
        .string()
        .nullable()
        .oneOf([yup.ref("password")], "Password do not match")
        .label("Confirm Password"),
});
