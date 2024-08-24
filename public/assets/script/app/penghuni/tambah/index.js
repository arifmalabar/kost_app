import { getGedung, init, ketersediaanRuang } from "./Penghuni.js";
window.onload = function () {
  init();
  getGedung();
  ketersediaanRuang([]);
};
