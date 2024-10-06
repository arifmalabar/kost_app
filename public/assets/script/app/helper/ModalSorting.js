const tahun = document.querySelector(".field-tahun");
const bulan = document.querySelector(".field-bulan");
const submit = document.querySelector(".btn-submit");

export function init() {
  submit.addEventListener("click", function () {
    fecthData();
  });
}

export async function fecthData() {
  let data = {
    tahun: tahun.value,
    bulan: bulan.value,
  };
}
