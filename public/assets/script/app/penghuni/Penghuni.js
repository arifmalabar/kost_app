import { get_gedung, informasi_ruangan } from "../config/EndPoint.js";

let field_gedung = document.querySelector(".input-gedung");
let btn_cari = document.querySelector(".btn-pilihgdg");
let btn_pilih = document.querySelectorAll('.btn-pilih');

export async function getStatusRuangan() {
    
    await fetch(`${informasi_ruangan}/${field_gedung.value}`)
        .then(response => {
            return response.json();
        })
        .then(data => {
            ketersediaanRuang(data);
        })
        .catch(err => {
            console.log(err);
        }) 
}
export async function getGedung() {
    await fetch(get_gedung)
        .then(response => {
            return response.json();
        })
        .then(data => {
            showListGedung(data);
            console.log("oe")
        })
        .catch(err => {
            console.log(err);
        }) 
}
function showListGedung(dt) {
    let opsi = ``;
    dt.forEach(element => {
        opsi = opsi + `<option value="${element.kode_gedung}">${element.nama_gedung}</option>`
    });
    field_gedung.innerHTML = opsi;
}
export function ketersediaanRuang(dt)
{
    let no = 1;
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "bDestroy": true,
        data: dt,
        columns: [
            {
                data: null,
                render: function (data, type, row) {
                    return no++;
                }
            },
            {
                data: 'nama_gedung'
            },
            {
                data: null,
                render: function (data, type, row) {
                    return `Ruangan ${row.nama_ruang}`
                }
            },
            {
                data: null,
                render: function (data, type, row) {
                    if(row.status === "tersedia")
                    {
                        return `<span class='badge badge-success'>${row.status}</span>`;
                    } else {
                        return `<span class='badge badge-danger'>${row.status}</span>`
                    }
                }
            },
            {
                data: null,
                render: function (data, type, row) {
                    if(row.status === "tersedia")
                    {
                        return `<button class="btn btn-success btn-pilih" onclick="changekamar()" value="${row.nama_ruang}">Pilih Kamar</button>`;
                    } else {
                        return `<i>Saat ini kamar tidak tersedia</i>`
                    }
                }
            }
        ]
    });
}