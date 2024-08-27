import { get_tagihan } from "../config/EndPoint.js";
import getRupiah from "../helper/NumberFormat.js";
var bulan = [
  "Januari",
  "Februari",
  "Maret",
  "April",
  "Mei",
  "Juni",
  "Juli",
  "Agustus",
  "September",
  "Oktober",
  "Nopember",
  "Desember",
];
export async function fecth_tagihan() {
  await fetch(get_tagihan)
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

function showTables(dt) {
  var no = 1;

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
          return no++;
        },
      },
      {
        data: "nama",
      },
      {
        data: "nama_gedung",
      },
      {
        data: "nama_ruang",
      },
      {
        data: null,
        render: function (data, type, row) {
          return getTglTagihan(row);
        },
      },
      {
        data: null,
        render: function (data, type, row) {
          return getJmlTagihan(row);
        },
      },
      {
        data: null,
        render: function (data, type, row) {
          if (row.total != 0) {
            return `<span class="badge badge-danger">Terhutang</span>`;
          } else {
            return `<span class="badge badge-success">Lunas</span>`;
          }
        },
      },
      {
        data: null,
        render: function (data, type, row) {
          if (row.total != 0) {
            return showButtonAksi(row);
          } else {
            return `<i style='font-size: 12px'>Pembayaran Sdh Lunas</i>`;
          }
        },
      },
    ],
  });
}
function covertIntNum(num) {
  return `+62${num.slice(1)}`;
}
function showButtonAksi(dt) {
  return `<center>
            <a href="/bayar" class="btn btn-outline-info btn-sm"><i
                    class="fas fa-dollar-sign"></i>&nbsp;Bayar</a>
            <a target="_blank" href="https://wa.me/${covertIntNum(
              dt.no_telp
            )}?text=*Pembayaran Kost A.N ${
    dt.nama
  }* total tagihan ${getJmlTagihan(dt)} dengan tanggal tagihan ${getTglTagihan(
    dt
  )} Segera lunasi pembayaran"
                class="btn btn-sm btn-outline-success"><i class="fa fa-phone"></i>
                Hubungi</a>
        </center>`;
}
function getJmlTagihan(row) {
  try {
    if (row.tagihan === null) {
      return getRupiah(row.harga);
    } else {
      return getRupiah(row.tagihan);
    }
  } catch (error) {
    return error;
  }
}
function getTglTagihan(row) {
  let tgl = new Date(row.tanggal_bergabung);
  return `${tgl.getDate()} ${
    bulan[tgl.getMonth()]
  } ${new Date().getFullYear()}`;
}
