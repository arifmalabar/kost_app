import { informasi_kost } from "../config/EndPoint.js";
import getRupiah from "../helper/NumberFormat.js";
export function initData() {
  //showGrafikHutangLunas();
}
export async function fetchDataInformasi() {
  try {
    const response = await fetch(informasi_kost);
    const data = await response.json();
    setJumlah(data.informasi_kost);
    setJumlahCicilan(data.cicilan);
    setJumlahLunas(data.lunas);
    setSisaBayar(data.sisa_bayar);
    showGrafikHutangLunas(data.grafik_lunas, data.grafik_terhutang);
    showTabelPenghuni(data.penghuni);
    showKetersediaanKamar(data.ketersediaan);
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
function showGrafikHutangLunas(...data) {
  let lunas = data[0];
  let hutang = data[1];
  //untuk data lunas
  let arrBlnLunas = [];
  let jmlLunas = [];
  //untuk data terhutang
  let jmlHutang = [];
  lunas.forEach((element) => {
    arrBlnLunas.push(element.bulan);
    jmlLunas.push(element.lunas);
  });
  hutang.forEach((element) => {
    jmlHutang.push(element.hutang);
  });
  //--------------
  //- AREA CHART -
  //--------------
  var bar_chart_data = {
    labels: arrBlnLunas,
    datasets: [
      {
        label: "Lunas",
        backgroundColor: "rgba(60,141,188,0.9)",
        borderColor: "rgba(60,141,188,0.8)",
        pointRadius: false,
        pointColor: "#3b8bba",
        pointStrokeColor: "rgba(60,141,188,1)",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(60,141,188,1)",
        data: jmlLunas,
      },
      {
        label: "Terhutang",
        backgroundColor: "rgba(210, 214, 222, 1)",
        borderColor: "rgba(210, 214, 222, 1)",
        pointRadius: false,
        pointColor: "rgba(210, 214, 222, 1)",
        pointStrokeColor: "#c1c7d1",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(220,220,220,1)",
        data: jmlHutang,
      },
    ],
  };

  var areaChartOptions = {
    maintainAspectRatio: false,
    responsive: true,
    legend: {
      display: false,
    },
    scales: {
      xAxes: [
        {
          gridLines: {
            display: false,
          },
        },
      ],
      yAxes: [
        {
          gridLines: {
            display: false,
          },
        },
      ],
    },
  };
  //-------------
  //- BAR CHART -
  //-------------
  var barChartCanvas = $("#barChart").get(0).getContext("2d");
  var barChartData = $.extend(true, {}, bar_chart_data);
  var temp0 = bar_chart_data.datasets[0];
  var temp1 = bar_chart_data.datasets[1];
  barChartData.datasets[0] = temp1;
  barChartData.datasets[1] = temp0;

  var barChartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    datasetFill: false,
  };

  new Chart(barChartCanvas, {
    type: "bar",
    data: barChartData,
    options: barChartOptions,
  });
}
function showTabelPenghuni(dt) {
  console.log(dt);
  let no = 1;
  $("#example2").DataTable({
    paging: true,
    lengthChange: false,
    searching: true,
    ordering: true,
    info: true,
    autoWidth: false,
    responsive: true,
    bDestroy: true,
    data: dt,
    columns: [
      {
        data: null,
        render: function (data, type, row) {
          return `${no++}`;
        },
      },
      { data: "nama" },
      { data: "nama_ruang" },
      { data: "nama_gedung" },
      {
        data: null,
        render: function (data, type, row) {
          return `<span class="badge badge-info">${row.tanggal_bergabung}</span>`;
        },
      },
    ],
  });
}
function showKetersediaanKamar(dt) {
  //-------------
  //- DONUT CHART -
  //-------------
  // Get context with jQuery - using jQuery's .get() method.
  var donutChartCanvas = $("#donutChart").get(0).getContext("2d");
  var donutData = {
    labels: ["Kosong", "Terisi"],
    datasets: [
      {
        data: [dt.kosong, dt.terisi],
        backgroundColor: ["#f56954", "#00a65a"],
      },
    ],
  };
  var donutOptions = {
    maintainAspectRatio: false,
    responsive: true,
  };
  //Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  new Chart(donutChartCanvas, {
    type: "doughnut",
    data: donutData,
    options: donutOptions,
  });
}
