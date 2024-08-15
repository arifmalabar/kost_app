
import { data_pembayaran, host } from "../config/EndPoint.js";
import getRupiah from "../helper/NumberFormat.js";
import { errorMsg } from "../message/Message.js";

let view_nik = document.querySelector('.view-nik');
let view_ktp = document.querySelector('.view-ktp');
let view_nama = document.querySelector('.view-nama');
let view_gedung = document.querySelector('.view-gedung');
let view_ruang = document.querySelector('.view-ruang');
let view_tagihan = document.querySelector('.view-tagihan');

const field_tahun = document.querySelector('.field-tahun');
const field_bulan = document.querySelector('.field-bulan');
const field_total = document.querySelector('.field-total');
let btn_proses = document.querySelector('.btn-proses');

let tgl_bergabung = "";

export function initData()
{
    btn_proses.addEventListener('click', function (params) {
        let tahun = field_tahun.value;
        let bulan = field_bulan.value;
        let total = field_total.value;
        let date = new Date(tgl_bergabung);
        console.log(`${tahun}-${bulan}-${date.getDate()}`);
    });
}

export async function fecthDataPembayaran() 
{
    await fetch(data_pembayaran)
        .then(response => {
            return response.json();
        })
        .then(response => {
            if(response != 0){
                setData(response.penghuni_detail);
                setTabel(response.list_pembayaran);
                setTahun();
            } else {
                errorMsg("Error", "NIK Tidak terdaftar di sistem").then((res) => {
                    if(res.isConfirmed)
                    {
                        window.location.href = `${host}/pembayaran`;
                    }
                });
                
            }
        })
        .catch(err => {
            console.log(err);
        });
}
function setTahun()
{
    let date = new Date(tgl_bergabung);
    let date_now = new Date().getUTCFullYear();
    let opt = ``;
    var i = date.getFullYear();
    while (i <= date_now) {
        opt = opt + `<option value="${i}">${i}</option>`
        i++;
    }
    field_tahun.innerHTML = opt;
}
async function bayarTagihan() {
    let tahun = field_tahun.value;
    let bulan = field_bulan.value;
    let total = field_total.value;
    console.log(tahun);
}

function setData(data) 
{
    view_nik.innerHTML = data.NIK;
    view_nama.innerHTML = data.nama;
    view_gedung.innerHTML = data.gedung;
    view_ruang.innerHTML = data.ruangan;
    view_tagihan.innerHTML = `<b>${getRupiah(data.harga)}</b>`;
    tgl_bergabung = data.tanggal_bergabung;
}
function setTabel(dt)
{
    var no = 1;
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
            {
                data : null,
                render: function (data, type, row) {
                    return no++; 
                }
            },
            {
                data : null,
                render: function (data, type, row) {
                    return getRupiah(row.jml_bayar);
                }
            },
            {
                data: null,
                render: function (data, type, row) {
                    return getRupiah(row.sisa_bayar)
                }
            },
            {
                data: null, 
                render: function (data, type, row) {
                    return waktuBayar(row.tanggal);
                }
            },{
                data : 'tanggal_tagihan'
            },
            {
                data: null,
                render: function (data, type, row) {
                    return statusBayar(row.status);
                },
                orderable: false,
                searchable: false
            },
            {
                data: null,
                render: function (data, type, row) {
                    return tombolCetak(row.status);
                },
                orderable: false,
                searchable: false
            }
        ]
    });
}
function waktuBayar(tgl) 
{
    let list_hari = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
    let list_bulan = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agt", "Sep", "Okt", "Nop", "Des"];
    let date = new Date(tgl);
    let hari = list_hari[date.getDay()];
    let bulan = list_bulan[date.getMonth()];
    let tahun = date.getFullYear();
    return `${hari}, ${date.getDate()} ${bulan} ${tahun}`;
}
function statusBayar(sts)
{
    let rd = '';
    switch (sts) {
        case 'lunas':
                rd = '<center><span class="badge badge-success">Lunas</span></center>';
            break;
        case 'terhutang':
                rd = `<center><span class="badge badge-danger">Terhutang</span></center>`;
            break;
        default:
                rd = `<center><span class="badge badge-danger">Terhutang</span></center>`;
            break;
    }
    return rd;
}
function tombolCetak(sts)
{
    let rd = '';
    switch (sts) {
        case 'lunas':
                rd = '<center><a href="" class="btn btn-primary btn-sm"><i class="fa fa-print"></i>&nbsp;Cetak Struk</a></center>';
            break;
        case 'terhutang':
                rd = `<i style="font-size: 13px">Pembayaran Belum Lunas</i>`;
            break;
        default:
                rd = ``;
            break;
    }
    return rd;
}
