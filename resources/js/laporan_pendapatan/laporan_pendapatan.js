import ReactDOM from "react-dom";
import { get_pendapatan_gedung } from "../config/end_point";
import { useEffect, useState } from "react";
import Swal from "sweetalert2";
import getRupiah from "../../../public/assets/script/app/helper/NumberFormat";

function LaporanPendapatan() {
    let no = 1;
    let [data_pendapatan, setDataPendapatan] = useState([]);
    async function fecthPendapatanPergedung() {
        try {
            const response = await fetch("/data_pendapatan_gedung");
            if (response.ok) {
                const data = await response.json();
                setDataPendapatan(data);
            } else {
                throw new Error(response.statusText);
            }
        } catch (error) {
            Swal.fire({
                title: "Error",
                text: error,
                icon: "error",
            });
        }
    }
    useEffect(() => {
        fecthPendapatanPergedung();
        console.log(data_pendapatan);
    }, []);
    return data_pendapatan.map((e) => (
        <tr>
            <td>{no++}</td>
            <td>{e.nama_gedung}</td>
            <td>{getRupiah(e.pendapatan_saat_ini)}</td>
            <td>{getRupiah(e.pendapatan_seharusnya)}</td>
            <td>
                <a
                    className="btn btn-sm btn-primary"
                    href={`/laporan_pendapatan_gedung/${
                        e.kd_gedung
                    }/${new Date().getFullYear()}`}
                >
                    <i className="fa fa-info"></i> Detail
                </a>
            </td>
        </tr>
    ));
}
ReactDOM.render(
    <LaporanPendapatan />,
    document.getElementById("data-pendapatan-gedung")
);
