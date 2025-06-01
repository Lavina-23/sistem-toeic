import "./bootstrap";

import Alpine from "alpinejs";

// import './../../vendor/power-components/livewire-powergrid/dist/powergrid';

window.Alpine = Alpine;

Alpine.start();

// import '../css/powergrid-custom.css';

document.addEventListener("DOMContentLoaded", () => {
    fetch("/peserta/score-datas")
        .then((response) => response.json())
        .then((data) => {
            const scoreData = data[0];
            console.log(data);
            const options = {
                chart: {
                    height: "90%",
                    maxWidth: "100%",
                    type: "line",
                    fontFamily: "Inter, sans-serif",
                    dropShadow: {
                        enabled: false,
                    },
                    toolbar: {
                        show: false,
                    },
                },
                tooltip: {
                    enabled: true,
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    width: 6,
                },
                grid: {
                    show: true,
                    strokeDashArray: 4,
                    padding: {
                        left: 2,
                        right: 2,
                        top: -26,
                    },
                },
                series: [
                    {
                        name: "Score Total",
                        data: [scoreData.last_score_total, scoreData.score_total],
                        color: "#134e4a",
                    },
                    {
                        name: "Score Reading",
                        data: [scoreData.last_score_r, scoreData.score_r],
                        color: "#14b8a6",
                    },
                    {
                        name: "Score Listening",
                        data: [scoreData.last_score_l, scoreData.score_l],
                        color: "#0f766e",
                    },
                ],
                legend: {
                    show: false,
                },
                stroke: {
                    curve: "smooth",
                },
                xaxis: {
                    categories: ["Last Score", "Current Score"],
                    labels: {
                        show: true,
                        style: {
                            fontFamily: "Inter, sans-serif",
                            cssClass:
                                "text-xs font-normal fill-gray-500 dark:fill-gray-400",
                        },
                    },
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false,
                    },
                },
                yaxis: {
                    show: false,
                },
            };
            if (
                document.getElementById("line-chart") &&
                typeof ApexCharts !== "undefined"
            ) {
                const chart = new ApexCharts(
                    document.getElementById("line-chart"),
                    options
                );
                chart.render();
            }
        });
});
