import {
  get_detail_bygedung,
  get_gedung,
  host,
  informasi_ruangan,
  tambah_penghuni,
} from "../../config/EndPoint.js";
import getRupiah from "../../helper/NumberFormat.js";
import {
  parseIntToRupiah,
  parseRupiahToInt,
} from "../../helper/RupiahFormFormat.js";
import { errorMsg, successMsg } from "../../message/Message.js";
let btn_cari = document.querySelector(".btn-cari");
let field_gedung = document.querySelector(".input-gedung");
let field_ruang = document.querySelector(".input-ruang");
let change_ruang = document.querySelector(".change-ruang");
//form

export function init() {
  $(".input-gedung").change(function () {});
  $(document).on("click", ".btn-pilih", function (event) {
    const button = $(event.target); // The button that was clicked
    const id = button.data("id"); // Get data-id attribute from button
    change_ruang.innerHTML = `Ruangan dipilih : ${id}-${button.val()}`;
    $(".field-ruangan").val(id);
  });
  $(".btn-cari").click(function () {
    getStatusRuangan($(".input-gedung").val());
  });
  $(".btn-simpan").click(function () {
    simpanPenghuni();
  });
  // Format harga dengan Rp. di form tambah
  $("#hargaInput").on("keyup", function (e) {
    this.value = parseIntToRupiah(this.value);
  });
  $(".toUp").on("keyup", function (params) {
    this.value = this.value.toUpperCase();
  });
  $(".next-btn").click(function () {
    validateForm();
  });
  $('input[name="files"]').on("change", function (params) {
    validasiKtp(this.files[0]);
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
function validasiKtp(obj) {
  const ukfile = (obj.size / 1024).toFixed(2);
  const allowedTypes = ["image/jpeg", "image/png", "image/gif"]; // Allowed image types
  if (!(ukfile >= 1500)) {
    ifValidError("Upload KTP tidak boleh melebihi 1.5mb");
    $('input[name="files"]').val("");
  } else if (!allowedTypes.includes(obj.type)) {
    ifValidError("Format gambar yang diminta JPG/PNG/GIF");
    $('input[name="files"]').val("");
  } else {
    return true;
  }
}
async function simpanPenghuni() {
  try {
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
    const kd_kamar = document.querySelector('input[name="kode_kamar"]').value;
    if (uploadktp === undefined) {
      const data = {
        NIK: NIK,
        nama: nama,
        email: email,
        harga: parseRupiahToInt(harga),
        no_telp: notelp,
        nama_wali: nm_wali,
        nama_kampus_kantor: nm_kampus,
        alamat_kampus_kantor: alamat_kampus,
        alamat: alamat_rumah,
        kode_kamar: kd_kamar,
        token: token,
        tanggal_bergabung: $(".tanggal_bergabung").val(),
        status: 1,
      };
      insertDataPenghuni(data, token);
    } else {
      const reader = new FileReader();
      reader.readAsDataURL(uploadktp);
      reader.onload = async function () {
        const base64file = reader.result.split(",")[1];
        const data = {
          NIK: NIK,
          nama: nama,
          email: email,
          harga: parseRupiahToInt(harga),
          no_telp: notelp,
          nama_wali: nm_wali,
          nama_kampus_kantor: nm_kampus,
          alamat_kampus_kantor: alamat_kampus,
          alamat: alamat_rumah,
          kode_kamar: kd_kamar,
          file: base64file,
          token: token,
          tanggal_bergabung: $(".tanggal_bergabung").val(),
          status: 1,
        };
        insertDataPenghuni(data, token);
      };
    }
  } catch (error) {
    console.log(error);
  }

  /*try {
    const response = await fetch(tambah_penghuni, {
      method: "POST",
      body: form_data,
      headers: {
        "X-CSRF-TOKEN": $(".token").val(),
      },
    });
    //const res = await response.json();
    if (response.ok) {
      console.log(res);
    }
  } catch (error) {
    alert(error);
  }*/
}
async function insertDataPenghuni(data, token) {
  await fetch(tambah_penghuni, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "X-CSRF-TOKEN": token,
    },
    body: JSON.stringify(data),
  })
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      console.log(data);
      if (data.status === "success") {
        successMsg(
          "Berhasil",
          "Data berhasil disimpan, proses pembayaran selanjutnya di entry pembayaran"
        ).then((e) => {
          if (e.isConfirmed) {
            window.location.href = `${host}/penghuni_ruang`;
          }
        });
      } else {
        throw new Error("Gagal menginput data");
      }
    })
    .catch((er) => {
      console.log(`Errror : ${er}`);
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
function validateForm() {
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
  const kd_kamar = document.querySelector('input[name="kode_kamar"]').value;
  const data = [];

  if (NIK === "") {
    ifValidError("NIK belum diisi");
  } else if (nama === "") {
    ifValidError("Nama belum diisi");
  } else if (email === "") {
    ifValidError("email belum diisi");
  } else if (harga === "") {
    ifValidError("Harga blum diisi");
  } else if (notelp === "") {
    ifValidError("notelp belum diisi");
  } else if (nm_wali === "") {
    ifValidError("Nama Wali belum diisi");
  } else if (nm_kampus === "") {
    ifValidError("Nama Kampus/instansi belum diisi");
  } else if (alamat_kampus === "") {
    ifValidError("Alamat Kampus/Instansi belum diisi");
  } else if (alamat_rumah === "") {
    ifValidError("Alamat Rumah belum diisi");
  } else {
    $(".is-invalid").removeClass("is-invalid");
    stepper.next();
  }
}
function ifInvalid(data) {
  $(`input[name="${data}"]`).addClass("is-invalid");
}
function ifValidError(msg) {
  errorMsg("Validiasi Error", msg);
}
