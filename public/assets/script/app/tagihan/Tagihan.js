import { get_tagihan } from "../config/EndPoint.js";
import getRupiah from "../helper/NumberFormat.js";

export async function fecth_tagihan()
{
    await fetch(get_tagihan)
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

function showTables(dt)
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
        "bDestroy" : true,
        data : dt,
        columns: [
            { 
                data : null,
                render: function (data, type, row ){
                    return no++;
                }
            },
            {
                data : 'nama'
            },
            {
                data : 'nama_gedung'
            },
            {
                data : 'nama_ruang'
            },
            {
                data: null,
                render: function (data, type, row) {
                    try {
                        if(row.tagihan === null)
                        {
                            return getRupiah(row.harga);
                        } else {
                            return getRupiah(row.tagihan);
                        }
                    } catch (error) {
                        return error;                        
                    }
                }
            },
            {
                data : null,
                render: function (data, type, row) {
                    if(row.total != 0)
                    {
                        return `<span class="badge badge-danger">Terhutang</span>`
                    } else {
                        return `<span class="badge badge-success">Lunas</span>`
                    }
                }
            },
            {
                data : null,
                render: function (data, type, row) {
                    var date_now = new Date();
                    var tgl_tagihan = new Date(row.tanggal_bergabung);
                    if((tgl_tagihan.getMonth() == date_now.getMonth()) && tgl_tagihan.getDate() == date_now.getDate()){
                        if(row.total != 0)
                        {  
                            return showButtonAksi();
                        } else {
                            return `<i>Pembayaran Sudah Lunas</i>`;
                        }
                    } else {
                        return ``;
                    }
                }
            }
        ]

    });
}
function showButtonAksi()
{
    return `<center>
            <a href="/bayar" class="btn btn-outline-info btn-sm"><i
                    class="fas fa-dollar-sign"></i>&nbsp;Bayar</a>
            <a href="https://wa.me/+6283192962102?text=*Pembayaran Kost A.N Ridho Belum Lunas* Segera lunasi pembayaran"
                class="btn btn-sm btn-outline-success"><i class="fa fa-phone"></i>
                Hubungi</a>
        </center>`;
}