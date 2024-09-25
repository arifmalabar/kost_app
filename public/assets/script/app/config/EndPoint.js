export let host = window.location.protocol + "//" + window.location.host;
export let path = window.location.pathname.split("/");
export let informasi_kost = `${host}/informasikost`;
export let pembayaran_penghuni = `${host}/get_penghuni`;
export let data_pembayaran = `${host}/get_bayar/${path[2]}`;
export let get_tahuntagihan = `${host}/get_tahun/${path[2]}`;
export let get_blntagihan = `${host}/get_bulan/${path[2]}`;
export let bayar_tagihan = `${host}/bayar_tagihan`;
export let get_gedung = `${host}/get_gedung`;
export let get_gedung_byid = `${host}/get_gedung_byid`;
export let get_tagihan = `${host}/data_tagihan`;
export let get_pembayaran_tagihan = `${host}/get_pembayaran_tagihan`;
export let tambah_tagihan = `${host}/tambah_tagihan`;
export let informasi_ruangan = `${host}/penghuni_ruang/status_ruangan`;
export let tambah_penghuni = `${host}/penghuni_ruang/store`;
export let get_detail_penghuni = `${host}/penghuni_ruang/getDetailPenghuniData/${path[3]}`;
export let update_penghuni = `${host}/penghuni_ruang/update`;
export let penghuni_ruang = `${host}/penghuni_ruang`;
export let halaman_update_penghuni = `${host}/penghuni_ruang/detail_penghuni`;
export let get_ruangan_bygedung = `${host}/setting_ruang`;
export let get_data_pendapatan = `${host}/data_pendapatan`;
