import { pembayaran_penghuni } from "../config/EndPoint.js";


export default async function getPenghuni() { 
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