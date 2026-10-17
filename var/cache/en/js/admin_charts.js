/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
var current_multirow = 0;
function createGradient(ctx, chartArea) {
  const gradient = ctx.createLinearGradient(
    0,
    chartArea.bottom,
    0,
    chartArea.top,
  );

  gradient.addColorStop(0, "rgba(76, 175, 80, 0.1)");
  gradient.addColorStop(0.5, "rgba(76, 175, 80, 0.6)");
  gradient.addColorStop(1, "rgba(76, 175, 80, 1)");

  return gradient;
}

function formatMonthLabels(dates) {
  const monthLabels = dates.map((date) => {
    const d = new Date(date);
    return d.toLocaleString("en", { month: "short" });
  });

  return monthLabels.map((month, index, array) => {
    return index === 0 || month !== array[index - 1] ? month : "";
  });
}

const CHART_COLORS = {
  white: "#fff",
  green: "#fff",
  purple: "#A265FF",
  yellow: "#FFB202",
  pink: "#ED02AD",
  blue: "#218EF5",
  lightBlue: "#4A8EFF",
  red: "#EF364F",
  cyan: "#38C1F2",
  orange: "#F19B36",
  lightGreen: "#32E28B",
};

const TOOLTIP_SETTINGS = {
  titleColor: "rgb(255, 255, 255)",
  bodyColor: "rgb(255, 255, 255)",
  borderWidth: 1,
  borderColor: "#fff",
  borderRadius: 10,
  padding: 15,
  titleFontSize: 16,
  bodyFontSize: 20,
  bodyWeight: "bold",
};

const GRID_SETTINGS = {
  color: "#6ccf70",
};

const LINE_CHART_CONFIG = {
  data: {
    labels: ["2024-05-05", "2024-06-02", "2024-07-01", "2024-08-02"],
    values: [100000, 125000, 116000, 260000],
  },

  display: {
    lineColor: CHART_COLORS.green,
    tension: 0.25,
    pointRadius: 0,
    pointHoverRadius: 6,
    pointHoverColor: "#fff",
    pointHoverBorderColor: "#FFFFFF",
  },

  scaleY: {
    min: 0,
    //    max: 200000,
    //    stepSize: 25000,
    //allowedValues: [100000, 125000, 150000, 200000],
    format: (value) => "$" + Math.floor(value * 100) / 100, // / 1000 + "k",
  },
};

const verticalLinePlugin = {
  id: "verticalLinePlugin",
  beforeDatasetsDraw: function (chart) {
    if (chart.tooltip._active && chart.tooltip._active.length) {
      const ctx = chart.ctx;
      const activePoint = chart.tooltip._active[0];
      const x = activePoint.element.x;
      const y = activePoint.element.y;
      const chartArea = chart.chartArea;

      ctx.save();

      const gradient = ctx.createLinearGradient(x, chartArea.bottom, x, y);
      gradient.addColorStop(1, "rgba(255, 255, 255, 1)");
      gradient.addColorStop(1, "rgba(255, 255, 255, 0.4)");
      gradient.addColorStop(1, "rgba(255, 255, 255, 1)");

      ctx.beginPath();
      ctx.moveTo(x - 1, chartArea.bottom);
      ctx.lineTo(x - 1, y);
      ctx.lineTo(x + 1, y);
      ctx.lineTo(x + 1, chartArea.bottom);
      ctx.closePath();

      ctx.fillStyle = gradient;
      ctx.fill();

      ctx.restore();
    }
  },
};

const gradientTooltipPlugin = {
  id: "gradientTooltip",
  beforeDraw: function (chart) {
    const tooltip = chart.tooltip;
    if (tooltip._active && tooltip._active.length) {
      const ctx = chart.ctx;
      const tooltipModel = tooltip;

      const gradient = ctx.createLinearGradient(
        tooltipModel.x,
        tooltipModel.y - tooltipModel.height,
        tooltipModel.x,
        tooltipModel.y,
      );

      gradient.addColorStop(0.5, "#0c6f10");
      gradient.addColorStop(1, "#4caf50");

      tooltipModel.gradientBackground = gradient;
    }
  },
};

function init_chart_line() {
  const canvas = document.getElementById("chart-line");
  const ctx = canvas.getContext("2d");
  var labels = [],
    values = [],
    json = $.parseJSON($(".income_all_chart").html());

  for (var x in json) {
    labels[labels.length] = x;
    values[values.length] = json[x];
  }
  //console.log(labels);
  //console.log(values);
  const chartConfig = {
    type: "line",
    data: {
      labels: labels,
      datasets: [
        {
          label: "",
          data: values,
          borderColor: LINE_CHART_CONFIG.display.lineColor,
          backgroundColor: function (context) {
            const chart = context.chart;
            const { ctx, chartArea } = chart;
            return chartArea ? createGradient(ctx, chartArea) : null;
          },
          fill: true,
          tension: LINE_CHART_CONFIG.display.tension,
          pointBackgroundColor: "transparent",
          pointBorderColor: "transparent",
          pointHoverBackgroundColor: LINE_CHART_CONFIG.display.pointHoverColor,
          pointHoverBorderColor:
            LINE_CHART_CONFIG.display.pointHoverBorderColor,
          pointHoverRadius: LINE_CHART_CONFIG.display.pointHoverRadius,
        },
      ],
    },
    plugins: [verticalLinePlugin, gradientTooltipPlugin],
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        y: {
          min: LINE_CHART_CONFIG.scaleY.min,
          max: LINE_CHART_CONFIG.scaleY.max,
          ticks: {
            callback: function (value) {
              const allowedValues = LINE_CHART_CONFIG.scaleY.allowedValues;

              if (!allowedValues) {
                return LINE_CHART_CONFIG.scaleY.format(value);
              } else if (allowedValues.includes(value)) {
                return LINE_CHART_CONFIG.scaleY.format(value);
              } else {
                return null;
              }
            },
            stepSize: LINE_CHART_CONFIG.scaleY.stepSize,
            color: CHART_COLORS.white,
          },
          grid: { color: GRID_SETTINGS.color },
        },
        x: {
          grid: { color: GRID_SETTINGS.color },
          ticks: { color: CHART_COLORS.white, autoSkip: false },
        },
      },
      plugins: {
        tooltip: {
          titleFont: { size: TOOLTIP_SETTINGS.titleFontSize },
          titleAlign: "center",
          bodyFont: {
            size: TOOLTIP_SETTINGS.bodyFontSize,
            weight: TOOLTIP_SETTINGS.bodyWeight,
          },
          bodyAlign: "center",
          callbacks: {
            title: function (context) {
              const fullDate = new Date(
                LINE_CHART_CONFIG.data.labels[context[0].dataIndex],
              );
              return "";
              return fullDate.toLocaleDateString("en", {
                day: "numeric",
                month: "long",
              });
            },
            label: function (context) {
              return LINE_CHART_CONFIG.scaleY.format(context.parsed.y);
            },
          },
          backgroundColor: function (context) {
            return context.chart.tooltip.gradientBackground;
          },
          titleColor: TOOLTIP_SETTINGS.titleColor,
          bodyColor: TOOLTIP_SETTINGS.bodyColor,
          borderColor: TOOLTIP_SETTINGS.borderColor,
          borderWidth: TOOLTIP_SETTINGS.borderWidth,
          displayColors: false,
          cornerRadius: TOOLTIP_SETTINGS.borderRadius,
          padding: TOOLTIP_SETTINGS.padding,
        },
        legend: { display: false },
      },
      interaction: {
        intersect: false,
        mode: "index",
      },
    },
  };

  new Chart(ctx, chartConfig);
}

function init_statistics_charts(canvas, chart_id) {
  const ctx = canvas.getContext("2d");
  var labels = [],
    values = [],
    json = $.parseJSON($('.'+chart_id).html());

  for (var x in json) {
    labels[labels.length] = x;
    values[values.length] = json[x];
  }
  //console.log(labels);
  //console.log(values);
  const chartConfig = {
    type: "line",
    data: {
      labels: labels,
      datasets: [
        {
          label: "",
          data: values,
          borderColor: LINE_CHART_CONFIG.display.lineColor,
          backgroundColor: function (context) {
            const chart = context.chart;
            const { ctx, chartArea } = chart;
            return chartArea ? createGradient(ctx, chartArea) : null;
          },
          fill: true,
          tension: LINE_CHART_CONFIG.display.tension,
          pointBackgroundColor: "transparent",
          pointBorderColor: "transparent",
          pointHoverBackgroundColor: LINE_CHART_CONFIG.display.pointHoverColor,
          pointHoverBorderColor:
            LINE_CHART_CONFIG.display.pointHoverBorderColor,
          pointHoverRadius: LINE_CHART_CONFIG.display.pointHoverRadius,
        },
      ],
    },
    plugins: [verticalLinePlugin, gradientTooltipPlugin],
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        y: {
          min: LINE_CHART_CONFIG.scaleY.min,
          max: LINE_CHART_CONFIG.scaleY.max,
          ticks: {
            callback: function (value) {
              const allowedValues = LINE_CHART_CONFIG.scaleY.allowedValues;

              if (!allowedValues) {
                return LINE_CHART_CONFIG.scaleY.format(value);
              } else if (allowedValues.includes(value)) {
                return LINE_CHART_CONFIG.scaleY.format(value);
              } else {
                return null;
              }
            },
            stepSize: LINE_CHART_CONFIG.scaleY.stepSize,
            color: CHART_COLORS.white,
          },
          grid: { color: GRID_SETTINGS.color },
        },
        x: {
          grid: { color: GRID_SETTINGS.color },
          ticks: { color: CHART_COLORS.white, autoSkip: false },
        },
      },
      plugins: {
        tooltip: {
          titleFont: { size: TOOLTIP_SETTINGS.titleFontSize },
          titleAlign: "center",
          bodyFont: {
            size: TOOLTIP_SETTINGS.bodyFontSize,
            weight: TOOLTIP_SETTINGS.bodyWeight,
          },
          bodyAlign: "center",
          callbacks: {
            title: function (context) {
              const fullDate = new Date(
                LINE_CHART_CONFIG.data.labels[context[0].dataIndex],
              );
              return "";
              return fullDate.toLocaleDateString("en", {
                day: "numeric",
                month: "long",
              });
            },
            label: function (context) {
              return LINE_CHART_CONFIG.scaleY.format(context.parsed.y);
            },
          },
          backgroundColor: function (context) {
            return context.chart.tooltip.gradientBackground;
          },
          titleColor: TOOLTIP_SETTINGS.titleColor,
          bodyColor: TOOLTIP_SETTINGS.bodyColor,
          borderColor: TOOLTIP_SETTINGS.borderColor,
          borderWidth: TOOLTIP_SETTINGS.borderWidth,
          displayColors: false,
          cornerRadius: TOOLTIP_SETTINGS.borderRadius,
          padding: TOOLTIP_SETTINGS.padding,
        },
        legend: { display: false },
      },
      interaction: {
        intersect: false,
        mode: "index",
      },
    },
  };

  new Chart(ctx, chartConfig);
}