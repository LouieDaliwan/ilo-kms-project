import * as yup from "yup";

export const useInformationSchema = yup.object({
    firstname: yup.string().required().label("First Name"),
    middlename: yup.string().nullable().notRequired().label("Middle Name"),
    lastname: yup.string().required().label("Last Name"),
    email: yup.string().email().required().label("Email"),
    suffixname: yup.string().nullable().notRequired().label("Suffix"),
    prefixname: yup.string().nullable().notRequired().label("Prefix"),
    backgroundDetails: yup.array().label("Background Details"),
    username: yup.string().required().label("Username"),
    mobile_number: yup
        .string()
        .notRequired()
        .matches(/^[0-9]+$/, "Must be only digits")
        .min(10)
        .max(11)
        .label("Mobile Number"),
    home_address: yup.string().notRequired().label("Home Address"),
});
