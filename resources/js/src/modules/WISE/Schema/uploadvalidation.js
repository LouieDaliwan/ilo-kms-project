import * as yup from "yup";

export const uploadSchema = yup.object({
    file_upload: yup.mixed().required('File is required')

});
