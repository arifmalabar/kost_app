import { get_detail_bygedung } from "../config/EndPoint.js";

export function init() {
  $("#sort-gedung").on("change", function (params) {
    fecthKamarByKode();
  });
}
async function fecthKamarByKode() {
  try {
    const resp = await fetch(
      `${get_detail_bygedung}/${$("#sort-gedung").val()}`
    );
    if (resp.ok) {
      const data = await resp.json();
      console.log(data);
      setTable(data);
    } else {
      console.log(resp.statusText);
    }
  } catch (error) {
    console.log(error);
  }
}
function setTable(dt) {
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
        data: "NIK",
      },
      {
        data: "nama",
      },
      {
        data: "email",
      },
      {
        data: "no_telp",
      },
      {
        data: null,
        render: function (data, type, row) {
          return `
                <center>
                    <a href="/penghuni_ruang/detail_penghuni/${row.NIK}"
                        class="btn btn-outline-info btn-sm">
                        <i class="fas fa-pencil-alt"></i>&nbsp;Ubah
                    </a>
                    <!-- Form Hapus -->
                    <button type="button" class="btn btn-outline-danger btn-sm"
                            onclick="confirmDelete('${row.NIK}')">
                        <i class="fas fa-trash-alt"></i>&nbsp;Non Aktifkan
                    </button>
                    <form action="/penghuni_ruang/${row.NIK}/delete" method="POST"
                        id="delete-form-${row.NIK}" style="display:inline;">
                        <input type="hidden" name="_token" value="${window.token}">                                                        
                        <input type="hidden" name="_method" value="DELETE">
                        
                    </form>
                </center>
            `;
        },
      },
    ],
  });
}
