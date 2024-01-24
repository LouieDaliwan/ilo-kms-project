import * as yup from "yup";

export const uploadSchema = yup.object({
    file_upload: yup.mixed()
    .required('File is required')
    .test('fileFormat', 'Invalid file format', (value) => {
        console.log(value[0].type); return value[0] && ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'text/csv', 'application/vnd.ms-excel'].includes(value[0].type);
      })
});
