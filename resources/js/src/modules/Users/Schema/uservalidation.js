import * as yup from "yup";

export const userSchema = yup.object({
    firstname: yup.string().required().label("First Name"),
    lastname: yup.string().required().label("Last Name"),
    suffix: yup.string().required().label("Suffix"),
    email: yup.string().email().required().label("Email"),
    username: yup.string().required().label("Username"),
    mobile: yup.number().required().min(11).max(11).label("Mobile Number"),
    homeAddress: yup.string().required().label("Home Address"),
    password: yup.string().min(6).required().label("Password"),
    roles: yup.string().required().max(10).label("Roles"),
    confirm_password: yup
        .string()
        .required()
        .oneOf([yup.ref("password")], "Password do not match")
        .label("Confirm Password"),
});
