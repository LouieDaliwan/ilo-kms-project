import { defineRule } from "vee-validate";
import { confirmed, email, min } from "@vee-validate/rules";

defineRule("required", (value) => {
    console.log(value);
});
defineRule("email", email);
defineRule("min", min);
defineRule("confirmed", confirmed);

defineRule("minMax", (value, [min, max]) => {
    // The field is empty so it should pass
    if (!value || !value.length) {
        return true;
    }
    const numericValue = Number(value);
    if (numericValue < min) {
        return `This field must be greater than ${min}`;
    }
    if (numericValue > max) {
        return `This field must be less than ${max}`;
    }
    return true;
});
