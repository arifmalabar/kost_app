import {
  get_gedung,
  get_gedung_byid,
  pembayaran_penghuni,
} from "../config/EndPoint.js";
import { errorMsg } from "../message/Message.js";

let sort_gedung = document.querySelector("#sort-gedung");

export function initData() {
  $("#sort-gedung").on("change", function (params) {
    sortGedung($("#sort-gedung").val());
  });
}

export async function getPenghuni() {
  await fetch(pembayaran_penghuni)
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      showTables(data);
    })
    .catch((err) => {
      console.log(err);
    });
}
export async function getGedung() {
  await fetch(get_gedung)
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      showListGedung(data);
    })
    .catch((err) => {
      console.log(err);
    });
}
async function sortGedung(id) {
  await fetch(`${get_gedung_byid}/${id}`)
    .then((response) => {
      if (response.ok) {
        return response.json();
      } else {
        throw new Error(response.json().error);
      }
    })
    .then((data) => {
      console.log(data);
      showTables(data);
    })
    .catch((err) => {
      errorMsg("Error", err);
    });
  //console.log(`${get_gedung_byid}/${id}`);
}
function showListGedung(e) {
  let data_gedung = `<option value="0" selected>Pilih Gedung</option>`;
  e.forEach((element) => {
    data_gedung =
      data_gedung +
      `<option value="${element.kode_gedung}" hidden>${element.nama_gedung}</option>`;
  });
  sort_gedung.innerHTML = data_gedung;
}
function showTables(dt) {
  //$('#example2').DataTable().clear().draw();
  console.log(dt);
  $("#example2").DataTable({
    paging: true,
    lengthChange: false,
    searching: true,
    ordering: true,
    info: true,
    autoWidth: false,
    responsive: true,
    bDestroy: true,
    data: dt,
    columns: [
      {
        data: null,
        render: function (data, type, row) {
          return `${row.NIK.toString()}`;
        },
      },
      { data: "nama" },
      { data: "ruangan" },
      { data: "gedung" },
      {
        data: null,
        render: function (data, type, row) {
          return `
                        <a href="/bayar/${row.NIK}" class="btn btn-sm btn-outline-info">Bayar</a>
                    `;
        },
      },
    ],
  });
}
