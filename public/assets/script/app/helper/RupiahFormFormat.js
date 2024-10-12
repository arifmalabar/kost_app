export function parseIntToRupiah(angka, prefix = "Rp. ") {
  let value = angka.replace(/[^0-9]/g, "");
  return value ? "Rp. " + value.replace(/\B(?=(\d{3})+(?!\d))/g, ".") : "";
}

export function parseRupiahToInt(rupiah) {
  // Hapus "Rp." dan tanda titik dari format Rupiah, lalu konversi ke integer
  return parseInt(rupiah.replace(/[^,\d]/g, ""));
}
