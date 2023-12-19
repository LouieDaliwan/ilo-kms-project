export default class User {
    constructor() {
        this.loading = false;
        this.isPrestine = true;
        this.isValid = true;
        this.errors = [];
        this.password = null;

        this.data = {
            prefixname: "",
            firstname: "",
            middlename: "",
            lastname: "",
            suffixname: "",
            username: "",
            email: "",
            password: "",
            password_confirmation: "",
            mobile_phone: "",
            home_address: "",
            photo: "",
            modified: "",
            details: {
                Gender: {
                    key: "Gender",
                    value: "",
                    icon: "",
                },
                Birthday: {
                    key: "Birthday",
                    value: "",
                    icon: "mdi-cake-variant",
                },
                "Marital Status": {
                    key: "Marital Status",
                    value: "",
                    icon: "",
                },
                "Mobile Phone": {
                    key: "Mobile Phone",
                    value: "",
                    icon: "mdi-cellphone-android",
                },
                "Home Address": {
                    key: "Home Address",
                    value: "",
                    icon: "mdi-map-marker",
                },
                others: [],
            },
            roles: [],
        };

        this.gender = {
            items: [
                {
                    color: "gray",
                    icon: "mdi-help",
                    key: "Gender",
                    value: "None",
                },
                {
                    color: "blue",
                    icon: "mdi-gender-male",
                    key: "Gender",
                    value: "Male",
                },
                {
                    color: "pink",
                    icon: "mdi-gender-female",
                    key: "Gender",
                    value: "Female",
                },
                {
                    color: "gray",
                    icon: "mdi-gender-male-female",
                    key: "Gender",
                    value: "Unspecified",
                },
            ],
        };

        this.maritalStatus = {
            items: [
                {
                    icon: "mdi-checkbox-blank-circle-outline",
                    key: "Marital Status",
                    value: "Unspecified",
                },
                {
                    icon: "mdi-human-handsup",
                    key: "Marital Status",
                    value: "Single",
                },
                {
                    icon: "mdi-human-male-female",
                    key: "Marital Status",
                    value: "Married",
                },
                { icon: "mdi-ring", key: "Marital Status", value: "Widowed" },
                {
                    icon: "mdi-heart-broken",
                    key: "Marital Status",
                    value: "Separated",
                },
            ],
        };
    }

    changeMaritalStatusIcon(item) {
        return (item && item.icon) || "mdi-checkbox-blank-circle-outline";
    }

    changeGenderIcon(item) {
        return (item && item.icon) || "mdi-gender-male-female";
    }
}
