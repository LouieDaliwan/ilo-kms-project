export function basename(str, sep) {
    return str.substr(str.lastIndexOf(sep) + 1);
}

export function strip_extension(str) {
    return str.substr(0, str.lastIndexOf("."));
}
