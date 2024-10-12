import { get_grafik_penghuni } from "../config/EndPoint.js";
let nm_gedung = [];
let terisi = [];
let kosong = [];
export function init() {
  fecthGrafikPenghuni();
}
async function fecthGrafikPenghuni() {
  try {
    const response = await fetch(get_grafik_penghuni);
    const data = await response.json();
    showTabel(data);
    data.forEach((element) => {
      nm_gedung.push(element.nama_gedung);
      terisi.push(element.total_penghuni);
      kosong.push(element.total_kamar_kosong);
    });
    showChart(data);
    console.log(data);
  } catch (error) {
    console.log(error);
  }
}
function showTabel(dt) {
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
          return no++;
        },
      },
      {
        data: "nama_gedung",
      },
      {
        data: "total_kamar",
      },
      {
        data: "total_kamar_kosong",
      },
      {
        data: null,
        render: function (data, type, row) {
          return `<span class="badge badge-success">${row.total_penghuni} Penghuni</span>`;
        },
      },
    ],
  });
}
function showChart(dt) {
  console.log(nm_gedung);
  var areaChartData = {
    labels: nm_gedung,
    datasets: [
      {
        label: "Terisi",
        backgroundColor: "rgba(60,141,188,0.9)",
        borderColor: "rgba(60,141,188,0.8)",
        pointRadius: false,
        pointColor: "#3b8bba",
        pointStrokeColor: "rgba(60,141,188,1)",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(60,141,188,1)",
        data: terisi,
      },
      {
        label: "Kosong",
        backgroundColor: "rgba(210, 214, 222, 1)",
        borderColor: "rgba(210, 214, 222, 1)",
        pointRadius: false,
        pointColor: "rgba(210, 214, 222, 1)",
        pointStrokeColor: "#c1c7d1",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(220,220,220,1)",
        data: kosong,
      },
    ],
  };
  //---------------------
  //- STACKED BAR CHART -
  //---------------------
  var barChartData = $.extend(true, {}, areaChartData);
  var temp0 = areaChartData.datasets[0];
  var temp1 = areaChartData.datasets[1];
  barChartData.datasets[0] = temp1;
  barChartData.datasets[1] = temp0;
  var stackedBarChartCanvas = $("#stackedBarChart").get(0).getContext("2d");
  var stackedBarChartData = $.extend(true, {}, barChartData);

  var stackedBarChartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
      xAxes: [
        {
          stacked: true,
        },
      ],
      yAxes: [
        {
          stacked: true,
        },
      ],
    },
  };

  new Chart(stackedBarChartCanvas, {
    type: "bar",
    data: stackedBarChartData,
    options: stackedBarChartOptions,
  });
}
