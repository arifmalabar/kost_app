const loc = document.querySelector(".sortmodal-loc");
const tahun = document.querySelector(".field-tahun");
const bulan = document.querySelector(".field-bulan");
const token = document.querySelector(".field-token");
const submit = document.querySelector(".btn-submit");

export async function fecthDataSorting(url) {
  let sortData = {
    tahun: tahun.value,
    bulan: bulan.value,
  };
  try {
    const response = await fetch(url, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": token.value,
      },
      body: JSON.stringify(sortData),
    });
    const data = await response.json();
    return data;
  } catch (error) {
    const resp = { iserror: true, msg: error };
    return resp;
  }
}
