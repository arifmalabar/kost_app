export function errorMsg(...params) {
    return Swal.fire({
        icon: "error",
        title: params[0],
        text: params[1],
    });
}