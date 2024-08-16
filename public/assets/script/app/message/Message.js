export function errorMsg(...params) {
    return Swal.fire({
        icon: "error",
        title: params[0],
        text: params[1],
    });
}
export function successMsg(...params)
{
    return Swal.fire({
        title: params[0],
        text: params[1],
        icon: "success"
    });
}