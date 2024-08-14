import { data_pembayaran } from "../config/EndPoint.js";
import getRupiah from "../helper/NumberFormat.js";

let view_nik = document.querySelector('.view-nik');
let view_ktp = document.querySelector('.view-ktp');
let view_nama = document.querySelector('.view-nama');
let view_gedung = document.querySelector('.view-gedung');
let view_ruang = document.querySelector('.view-ruang');
let view_tagihan = document.querySelector('.view-tagihan');

export default async function fecthDataPembayaran() 
{
    await fetch(data_pembayaran)
        .then(response => {
            return response.json();
        })
        .then(response => {
            setData(response.penghuni_detail);
            setTabel(response.list_pembayaran);
        })
        .catch(err => {
            console.log(err);
        });
}

function setData(data) 
{
    view_nik.innerHTML = data.NIK;
    view_nama.innerHTML = data.nama;
    view_gedung.innerHTML = data.gedung;
    view_ruang.innerHTML = data.ruangan;
    view_tagihan.innerHTML = `<b>${getRupiah(data.harga)}</b>`;
}
function setTabel(dt)
{

}

