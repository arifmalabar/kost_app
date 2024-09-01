import { get_ruangan_bygedung } from "../config/EndPoint.js";

export function initData() {
  $("#sort-gedung").on("change", function (params) {
    fecthKamarByKode();
  });
}

async function fecthKamarByKode() {
  try {
    const kode = $("#sort-gedung").val();
    if (kode != 0) {
      let response = await fetch(`${get_ruangan_bygedung}/${kode}`);
      let data = await response.json();
      showListKamar(data);
    } else {
      window.location.href = "";
    }
  } catch (error) {
    console.log(error);
  }
}

function showListKamar(dt) {
  $("#example2").DataTable().clear().draw();
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
        data: "kode_kamar",
      },
      {
        data: "nama_gedung",
      },
      {
        data: "nama_ruang",
      },
      {
        data: "no_ruang",
      },
      {
        data: "kapasitas",
      },
      {
        data: null,
        render: function (data, type, row) {
          return showButtonOpsi(row);
        },
      },
    ],
  });
}
function showButtonOpsi(row) {
  return `
        <center>
            <button class="btn btn-outline-info btn-sm" data-toggle="modal"
                data-target="#editRuanganModal" data-kode="${row.kode_kamar}"
                data-gedung="${row.kode_gedung}"
                data-ruang="${row.nama_ruang}" data-nomor="${row.no_ruang}"
                data-kapasitas="${row.kapasitas}">
                <i class="fas fa-pencil-alt"></i>&nbsp;Ubah
            </button>
            <form action="{{ route('ruangan.delete', ${row.kode_kamar}) }}"
                method="POST" id="delete-form-{{ ${row.kode_kamar} }}"
                style="display:inline;">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">                                                        
                <input type="hidden" name="_method" value="DELETE">   
                <button type="button" class="btn btn-outline-danger btn-sm"
                    onclick="confirmDelete('{{ ${row.kode_kamar} }}')">
                    <i class="fas fa-trash-alt"></i>&nbsp;Hapus
                </button>
            </form>
            
        </center>
    `;
}
