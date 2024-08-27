export function init() {
  showChart();
  showTabel();
}
function showTabel() {
  $("#example2").DataTable({
    paging: true,
    lengthChange: false,
    searching: true,
    ordering: true,
    info: true,
    autoWidth: true,
    responsive: true,
  });
}
function showChart() {
  var areaChartData = {
    labels: ["BSST", "Rogonoto", "Banjararum"],
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
        data: [28, 48, 40, 19, 86, 27, 90],
      },
      {
        label: "Penuh",
        backgroundColor: "rgba(210, 214, 222, 1)",
        borderColor: "rgba(210, 214, 222, 1)",
        pointRadius: false,
        pointColor: "rgba(210, 214, 222, 1)",
        pointStrokeColor: "#c1c7d1",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(220,220,220,1)",
        data: [65, 59, 80, 81, 56, 55, 40],
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
