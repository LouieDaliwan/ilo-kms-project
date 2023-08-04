import { defineRule } from "vee-validate";
import { confirmed, email, min, required } from "@vee-validate/rules";

defineRule("required", {
    ...required,
    message: "The {_field_} field is required",
});

defineRule("email", {
    ...email,
    message: "The {_field_} field is not valid",
});

defineRule("min", {
    ...min,
    message: "The {_field_} field must have at least {length} characters long",
});

defineRule("confirmed", {
    ...confirmed,
    message: "The {_field_} must match with the {target} field",
});
