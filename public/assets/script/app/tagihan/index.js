import {
  fecth_tagihan,
  init,
  getGedung as getGedungAtForm,
} from "./Tagihan.js";
import { getGedung } from "../Pembayaran/Pembayaran.js";

init();
fecth_tagihan();
getGedung();
getGedungAtForm();
