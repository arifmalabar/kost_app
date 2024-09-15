import { informasi_kost } from "../config/EndPoint.js";
import getRupiah from "../helper/NumberFormat.js";
export function initData() {}
export async function fetchDataInformasi() {
  try {
    const response = await fetch(informasi_kost);
    const data = await response.json();
    setJumlah(data.informasi_kost);
    setJumlahCicilan(data.cicilan);
    setJumlahLunas(data.lunas);
    setSisaBayar(data.sisa_bayar);
    console.log(data);
  } catch (error) {
    console.log(error);
  }
}
function setJumlah(informasi) {
  $(".jml-penghuni").html(informasi.jml_penghuni);
  $(".jml-rumahkost").html(informasi.jml_gedung);
  $(".jml-kamarkost").html(informasi.jml_kamar);
}
function setJumlahCicilan(cicilan) {
  $(".jml-cicilan").html(getRupiah(cicilan));
}
function setJumlahLunas(lunas) {
  $(".jml-lunas").html(getRupiah(lunas));
}
function setSisaBayar(sisa) {
  $(".jml-sisa").html(getRupiah(sisa));
}
