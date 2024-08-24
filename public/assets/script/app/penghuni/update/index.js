import { getData, init } from "./PenghuniEdit.js";
import { getGedung, ketersediaanRuang } from "../tambah/Penghuni.js";

window.onload = function () {
  init();
  getData();
  getGedung();
  ketersediaanRuang([]);
};
