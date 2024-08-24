import { get_gedung, informasi_ruangan } from "../config/EndPoint.js";
let btn_cari = document.querySelector(".btn-cari");
let field_gedung = document.querySelector(".input-gedung");
let field_ruang = document.querySelector(".input-ruang");
let change_ruang = document.querySelector(".change-ruang");

export function init() {
  $(".input-gedung").change(function () {});
  $(document).on("click", ".btn-pilih", function (event) {
    const button = $(event.target); // The button that was clicked
    const id = button.data("id"); // Get data-id attribute from button
    change_ruang.innerHTML = `Ruangan dipilih : ${id}-${button.val()}`;
  });
  $(".btn-cari").click(function () {
    getStatusRuangan($(".input-gedung").val());
  });
  $(".btn-simpan").click(function () {
    Swal.fire({
      icon: "question",
      title: "Konfirmasi",
      text: "Apakah data yang diinput sudah benar",
      showCancelButton: true,
      confirmButtonText: "Data Sudah Benar",
      cancelButtonText: "Batal!",
    }).then((res) => {});
  });
}

export async function getStatusRuangan(id) {
  await fetch(`${informasi_ruangan}/${id}`)
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      ketersediaanRuang(data);
      if (data.length == 0) {
        Swal.fire({
          icon: "error",
          title: "Oops!",
          text: `Maaf data yang ada minta tidak tersedia`,
        });
      }
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
function showListGedung(dt) {
  let opsi = ``;
  dt.forEach((element) => {
    opsi =
      opsi +
      `<option value="${element.kode_gedung}">${element.nama_gedung}</option>`;
  });
  field_gedung.innerHTML = opsi;
}
export function ketersediaanRuang(dt) {
  /*let data = ``;
    dt.forEach(e => {
        if(e.status === "tersedia"){
            data = data + `<option value="${e.kode_ruang}">${e.nama_ruang}</option>`
        } else {
            data = data + `<option value="${e.kode_ruang}">${e.nama_ruang} - (Tidak Tersedia)</option>`
        }
    }); 
    field_ruang.innerHTML = data;*/

  let no = 1;
  $("#example2").DataTable({
    paging: true,
    lengthChange: false,
    searching: false,
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
          return no++;
        },
      },
      {
        data: "nama_gedung",
      },
      {
        data: null,
        render: function (data, type, row) {
          return `Ruangan ${row.nama_ruang}`;
        },
      },
      {
        data: null,
        render: function (data, type, row) {
          if (row.status === "tersedia") {
            return `<span class='badge badge-success'>${row.status}</span>`;
          } else {
            return `<span class='badge badge-danger'>${row.status}</span>`;
          }
        },
      },
      {
        data: null,
        render: function (data, type, row) {
          if (row.status === "tersedia") {
            return `<button class="btn btn-success btn-pilih" data-id="${row.kode_kamar}" value="${row.nama_ruang}">Pilih Kamar</button>`;
          } else {
            return `<i>Saat ini kamar tidak tersedia</i>`;
          }
        },
      },
    ],
  });
}
