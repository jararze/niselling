const leadsCount = (() => {
    const state = {
        self: null,
        rendered: false,
    };

    const setupChart = (state) => {
        const chartElement = document.getElementById("leadsCount");

        if (chartElement) {
            const chartHeight = parseInt(KTUtil.css(chartElement, "height"));
            const borderColor = KTUtil.getCssVariableValue("--bs-border-dashed-color");
            const strokeColor = KTUtil.getCssVariableValue("--bs-gray-800");

            const leadsData = window.Laravel.totalLeads;
            const values = Object.values(leadsData);
            const dates = Object.keys(leadsData);

            console.log(leadsData)

            const chartOptions = {
                series: [{name: "Leads", data: values}],
                chart: {fontFamily: "inherit", type: "area", height: chartHeight, toolbar: {show: false}},
                legend: {show: false},
                dataLabels: {enabled: false},
                fill: {type: "solid", opacity: 0},
                stroke: {curve: "smooth", show: true, width: 2, colors: [strokeColor]},
                xaxis: {
                    categories: dates,
                    axisBorder: {show: false},
                    axisTicks: {show: false},
                    labels: {show: false},
                    crosshairs: {position: "front", stroke: {color: strokeColor, width: 1, dashArray: 3}},
                    tooltip: {enabled: true, formatter: void 0, offsetY: 0, style: {fontSize: "12px"}}
                },
                yaxis: {labels: {show: false}},
                states: {
                    normal: {filter: {type: "none", value: 0}},
                    hover: {filter: {type: "none", value: 0}},
                    active: {allowMultipleDataPointsSelection: false, filter: {type: "none", value: 0}}
                },
                tooltip: {
                    style: {fontSize: "12px"},
                    x: {
                        formatter: function (val) {
                            // Esta linea obtiene la fecha correspondiente al indice
                            const date = dates[val];

                            const [year, month, day] = date.split('-').map(Number);
                            const d = new Date(year, month - 1, day);
                            const formattedMonth = d.toLocaleString('default', {month: 'long'});
                            const formattedDay = d.getDate();
                            return `${formattedMonth} ${formattedDay}`;
                        }
                    },
                    y: {
                        formatter: (value) => `${value}`
                    }
                },
                colors: [KTUtil.getCssVariableValue("--bs-success")],
                grid: {
                    borderColor: borderColor,
                    strokeDashArray: 4,
                    padding: {top: 0, right: -20, bottom: -20, left: -20},
                    yaxis: {lines: {show: true}}
                },
                markers: {strokeColor: strokeColor, strokeWidth: 2}
            };

            state.self = new ApexCharts(chartElement, chartOptions);

            setTimeout(() => {
                state.self.render();
                state.rendered = true;
            }, 200);
        }
    };

    return {
        init: () => {
            setupChart(state);

            KTThemeMode.on("kt.thememode.change", () => {
                if (state.rendered) {
                    state.self.destroy();
                }
                setupChart(state);
            });
        }
    };
})();

if (typeof module !== "undefined") {
    module.exports = leadsCount;
}

KTUtil.onDOMContentLoaded(() => {
    leadsCount.init();
});

const quotesWithPayment = function () {
    let widget = {
        self: null,
        rendered: false
    };

    const totalWithPayment = window.Laravel.totalWithPayment;
    const valuesWithPayment = Object.values(totalWithPayment);
    const datesWithPayment = Object.keys(totalWithPayment);

    const generateChartParameters = (height, strokeColor, borderColor) => ({
        series: [{name: "Pagos", data: valuesWithPayment}],
        chart: {fontFamily: "inherit", type: "area", height: height, toolbar: {show: false}},
        legend: {show: false},
        dataLabels: {enabled: false},
        fill: {type: "solid", opacity: 0},
        stroke: {curve: "smooth", show: true, width: 2, colors: [strokeColor]},
        xaxis: {
            categories: datesWithPayment,
            axisBorder: {show: false},
            axisTicks: {show: false},
            labels: {show: false},
            crosshairs: {position: "front", stroke: {color: strokeColor, width: 1, dashArray: 3}},
            tooltip: {enabled: true, formatter: void 0, offsetY: 0, style: {fontSize: "12px"}}
        },
        yaxis: {labels: {show: false}},
        states: {
            normal: {filter: {type: "none", value: 0}},
            hover: {filter: {type: "none", value: 0}},
            active: {allowMultipleDataPointsSelection: false, filter: {type: "none", value: 0}}
        },
        tooltip: {
            style: {fontSize: "12px"},
            x: {
                formatter: function (val) {
                    // Esta linea obtiene la fecha correspondiente al indice
                    const date = datesWithPayment[val];

                    const [year, month, day] = date.split('-').map(Number);
                    const d = new Date(year, month - 1, day);
                    const formattedMonth = d.toLocaleString('default', {month: 'long'});
                    const formattedDay = d.getDate();
                    return `${formattedMonth} ${formattedDay}`;
                }
            },
            y: {
                formatter: (value) => `${value}` * 200 + '$us (' + `${value}` + ')'
            }
        },
        colors: [KTUtil.getCssVariableValue("--bs-success")],
        grid: {
            borderColor: borderColor,
            strokeDashArray: 4,
            padding: {top: 0, right: -20, bottom: -20, left: -20},
            yaxis: {lines: {show: true}}
        },
        markers: {strokeColor: strokeColor, strokeWidth: 2}
    });

    const renderChart = (widget) => {
        const chart = document.getElementById("quotesWithPayment");
        if (chart) {
            let height = parseInt(KTUtil.css(chart, "height"));
            let borderColor = KTUtil.getCssVariableValue("--bs-border-dashed-color");
            let strokeColor = KTUtil.getCssVariableValue("--bs-gray-800");

            let parameters = generateChartParameters(height, strokeColor, borderColor);

            widget.self = new ApexCharts(chart, parameters);
            setTimeout(() => {
                widget.self.render();
                widget.rendered = true;
            }, 200);
        }
    };

    return {
        init: function () {
            renderChart(widget);
            KTThemeMode.on("kt.thememode.change", () => {
                if (widget.rendered) {
                    widget.self.destroy();
                    renderChart(widget);
                }
            });
        }
    };
}();

if (typeof module !== 'undefined') {
    module.exports = quotesWithPayment;
}

KTUtil.onDOMContentLoaded(function () {
    quotesWithPayment.init();
});


var typeOfContact = {
    init: function () {
        let contactCard = document.getElementById("typeOfContact");

        if (contactCard) {
            let settings = getSettings(contactCard);

            let totalTypeContact = window.Laravel.totalTypeContact;
            for (let key in totalTypeContact) {
                totalTypeContact[key] = parseFloat(totalTypeContact[key]);
            }

            let canvas = document.createElement("canvas");
            let spanElement = document.createElement("span");

            if ("undefined" != typeof G_vmlCanvasManager) {
                G_vmlCanvasManager.initElement(canvas);
            }

            let context = canvas.getContext("2d");

            canvas.width = canvas.height = settings.size;

            context.translate(settings.size / 2, settings.size / 2);
            context.rotate((settings.rotate / 180 - 0.5) * Math.PI);

            let radius = (settings.size - settings.lineWidth) / 2;

            context.save();

            let totalAngle = 0;

            let colorCodes = {
                online: KTUtil.getCssVariableValue("--bs-primary"),
                whatsapp: KTUtil.getCssVariableValue("--bs-success"),
                phone: "#E4E6EF",
                null: "#869EA4"
            };

            for (let [type, value] of Object.entries(totalTypeContact)) {
                let color = colorCodes[type];

                // Calculate arc end angle.
                let endAngle = totalAngle + value * 2 * Math.PI;

                drawArc(context, radius, color, settings.lineWidth, totalAngle, endAngle);
                totalAngle = endAngle;
            }


            contactCard.appendChild(spanElement);
            contactCard.appendChild(canvas);
        }
    }
};

function drawArc(context, radius, color, lineWidth, startAngle, endAngle) {
    context.beginPath();
    context.arc(0, 0, radius, startAngle, endAngle, false);
    context.lineWidth = lineWidth;
    context.strokeStyle = color;
    context.stroke();
}

function getSettings(element) {
    return {
        size: element.getAttribute("data-kt-size") ? parseInt(element.getAttribute("data-kt-size")) : 70,
        lineWidth: element.getAttribute("data-kt-line") ? parseInt(element.getAttribute("data-kt-line")) : 11,
        rotate: element.getAttribute("data-kt-rotate") ? parseInt(element.getAttribute("data-kt-rotate")) : 145
    }
}

if ("undefined" != typeof module) {
    module.exports = typeOfContact;
}

KTUtil.onDOMContentLoaded(function () {
    typeOfContact.init();
});
