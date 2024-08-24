import {
  get_detail_penghuni,
  host,
  informasi_ruangan,
  update_penghuni,
} from "../../config/EndPoint.js";

let old_kdruang = "";
let last_kdruang = "";
let change_ruang = document.querySelector(".change-ruang");

export function init() {
  $(".input-gedung").change(function () {});
  $(document).on("click", ".btn-pilih", function (event) {
    const button = $(event.target); // The button that was clicked
    const id = button.data("id"); // Get data-id attribute from button
    last_kdruang = id;
    change_ruang.innerHTML = `Ruangan dipilih : ${last_kdruang}-${button.val()}`;
  });
  $(".btn-cari").click(function () {
    getStatusRuangan($(".input-gedung").val());
  });
  $(".btn-simpan").click(function () {
    updateData();
  });
  // Format harga dengan Rp. di form tambah
}
export async function getData() {
  try {
    const response = await fetch(get_detail_penghuni);
    const data = await response.json();
    showDetailPenghuni(data.biodata);
    showKtp(data.foto_ktp);
  } catch (error) {
    console.log(error);
  }
}
async function updateData() {
  const NIK = document.querySelector('input[name="NIK"]').value;
  const nama = document.querySelector('input[name="nama"]').value;
  const email = document.querySelector('input[name="email"]').value;
  const harga = document.querySelector('input[name="harga"]').value;
  const notelp = document.querySelector('input[name="no_telp"]').value;
  const nm_wali = document.querySelector('input[name="nama_wali"]').value;
  const nm_kampus = document.querySelector(
    'input[name="nama_kampus_kantor"]'
  ).value;
  const uploadktp = document.querySelector('input[name="files"]').files[0];
  const alamat_kampus = document.querySelector(".alamat_kampus").value;
  const alamat_rumah = document.querySelector(".alamat_rumah").value;
  const token = document.querySelector(".token").value;
  if (uploadktp == undefined) {
    let data = {
      NIK: NIK,
      nama: nama,
      email: email,
      harga: harga,
      no_telp: notelp,
      nama_wali: nm_wali,
      nama_kampus_kantor: nm_kampus,
      alamat_kampus_kantor: alamat_kampus,
      alamat: alamat_rumah,
      kode_kamar: last_kdruang === "" ? old_kdruang : last_kdruang,
      token: $(".token").val(),
    };
    fecthEditPenghuni(data);
  } else {
    const reader = new FileReader();
    reader.readAsDataURL(uploadktp);
    reader.onload = async function () {
      const base64file = reader.result.split(",")[1];
      let data = {
        NIK: NIK,
        nama: nama,
        email: email,
        harga: harga,
        no_telp: notelp,
        nama_wali: nm_wali,
        nama_kampus_kantor: nm_kampus,
        alamat_kampus_kantor: alamat_kampus,
        alamat: alamat_rumah,
        kode_kamar: last_kdruang === "" ? old_kdruang : last_kdruang,
        file: base64file,
        token: $(".token").val(),
      };
      fecthEditPenghuni(data);
    };
  }
}
async function fecthEditPenghuni(data) {
  await fetch(update_penghuni, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "X-CSRF-TOKEN": $(".token").val(),
    },
    body: JSON.stringify(data),
  })
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      console.log(data);
    })
    .catch((er) => {
      console.log(`Errror : ${er}`);
    });
}
function showDetailPenghuni(data) {
  document.querySelector('input[name="NIK"]').value = data.NIK;
  document.querySelector('input[name="nama"]').value = data.nama;
  document.querySelector('input[name="email"]').value = data.email;
  document.querySelector('input[name="harga"]').value = data.harga;
  document.querySelector('input[name="no_telp"]').value = data.no_telp;
  document.querySelector('input[name="nama_wali"]').value = data.nama_wali;
  document.querySelector('input[name="nama_kampus_kantor"]').value =
    data.nama_kampus_kantor;
  document.querySelector(".alamat_kampus").value = data.alamat_kampus_kantor;
  document.querySelector(".alamat_rumah").value = data.alamat;
  document.querySelector(
    ".old-ruang"
  ).innerHTML = `Ruangan Sebelumnya : ${data.kode_kamar} - ${data.nama_ruang}`;
  old_kdruang = data.kode_kamar;
}
function showKtp(data) {
  document.querySelector(".foto-ktp").src = `data:image/png;base64, ${data}`;
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
export function ketersediaanRuang(dt) {
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
function showListGedung(dt) {
  let opsi = ``;
  dt.forEach((element) => {
    opsi =
      opsi +
      `<option value="${element.kode_gedung}">${element.nama_gedung}</option>`;
  });
  field_gedung.innerHTML = opsi;
}
