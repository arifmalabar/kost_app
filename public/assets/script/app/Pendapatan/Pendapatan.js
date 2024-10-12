import { get_data_pendapatan } from "../config/EndPoint.js";
import getRupiah from "../helper/NumberFormat.js";

export default async function fecthDataPendapatan(params) {
  try {
    const response = await fetch(get_data_pendapatan);
    const data = await response.json();
    showBarChart(data);
    showPendapatanTables(data);
  } catch (error) {
    console.log(error);
  }
}

function showBarChart(dt) {
  let bulan = [];
  let total_pendapatan = [];
  let pendapatan_seharusnya = [];
  dt.forEach((element) => {
    bulan.push(element.bulan);
    total_pendapatan.push(element.pendapatan);
    pendapatan_seharusnya.push(element.pendapatan_seharusnya);
  });
  var data_chart = {
    labels: bulan,
    datasets: [
      {
        label: "Pendapatan Seharusnya",
        backgroundColor: "rgba(60,141,188,0.9)",
        borderColor: "rgba(60,141,188,0.8)",
        pointRadius: false,
        pointColor: "#3b8bba",
        pointStrokeColor: "rgba(60,141,188,1)",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(60,141,188,1)",
        data: pendapatan_seharusnya,
      },
      {
        label: "Pendapatan",
        backgroundColor: "rgba(210, 214, 222, 1)",
        borderColor: "rgba(210, 214, 222, 1)",
        pointRadius: false,
        pointColor: "rgba(210, 214, 222, 1)",
        pointStrokeColor: "#c1c7d1",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(220,220,220,1)",
        data: total_pendapatan,
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
  var barChartData = $.extend(true, {}, data_chart);
  var temp0 = data_chart.datasets[0];
  var temp1 = data_chart.datasets[1];
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
function showPendapatanTables(dt) {
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
      { data: "bulan" },
      { data: "tahun" },
      {
        data: null,
        render: function (data, type, row) {
          return getRupiah(row.pendapatan_seharusnya);
        },
      },
      {
        data: null,
        render: function (data, type, row) {
          return getRupiah(row.pendapatan);
        },
      },
      {
        data: null,
        render: function (data, type, row) {
          if (row.status <= 0) {
            return `<span class="badge badge-success">Sesuai</span>`;
          } else {
            return `<span class="badge badge-danger">Kurang</span>`;
          }
        },
      },
    ],
  });
}
