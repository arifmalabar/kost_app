import { getData, init } from "./PenghuniEdit.js";
import { getGedung, ketersediaanRuang } from "../tambah/Penghuni.js";
import { parseIntToRupiah } from "../../helper/RupiahFormFormat.js";

window.onload = function () {
  init();
  getData();
  getGedung();
  ketersediaanRuang([]);
};
