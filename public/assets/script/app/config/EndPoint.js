export let host = window.location.protocol + "//" + window.location.host;
export let path = window.location.pathname.split('/');
export let pembayaran_penghuni = `${host}/get_penghuni`;
export let data_pembayaran = `${host}/get_bayar/${path[2]}`;
export let bayar_tagihan = `${host}/bayar_tagihan`;