import { get_gedung, get_gedung_byid, pembayaran_penghuni } from "../config/EndPoint.js";
import { errorMsg } from "../message/Message.js";

let sort_gedung = document.querySelector('#sort-gedung');
let btn_sort = document.querySelector(".button-sort");

export function initData() {
    btn_sort.addEventListener("click", function () {
        sortGedung(sort_gedung.value);
    })
}

export async function getPenghuni() { 
    await fetch(pembayaran_penghuni)
        .then(response => {
            return response.json();
        })
        .then(data => {
            showTables(data);
        })
        .catch(err => {
            console.log(err);
        });
}
export async function getGedung() {
    await fetch(get_gedung)
        .then(response => {
            return response.json();
        })
        .then(data => {
            showListGedung(data);
        })
        .catch(err => {
            console.log(err);
        })
}
async function sortGedung(id)
{
    await fetch(`${get_gedung_byid}/${id}`)
        .then(response => {
            if(response.ok)
            {
                return response.json();
            } else {
                throw new Error(response.json().error);
            }
        })
        .then(data => {
            console.log(data)
        })
        .catch(err => {
            errorMsg("Error", err);
        })
    //console.log(`${get_gedung_byid}/${id}`);
}
function showListGedung(e) {
    let data_gedung = ``;
    e.forEach(element => {
        data_gedung = data_gedung + `<option value="${element.kode_gedung}" hidden selected>${element.nama_gedung}</option>`
    });
    sort_gedung.innerHTML = data_gedung;
}
function showTables(dt)
{
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        data : dt,
        columns : [
            {data : 'NIK'},
            {data : 'nama'},
            {data : 'ruangan'},
            {data : 'gedung'},
            {
                data : null,
                render : function (data, type, row) {
                    return `
                        <a href="/bayar/${row.NIK}" class="btn btn-sm btn-outline-info">Bayar</a>
                    `;
                }
            }
        ]
    });
}