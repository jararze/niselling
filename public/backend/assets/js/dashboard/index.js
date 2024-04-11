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

            // console.log(leadsData)

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


const typeOfContact = {
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

class topModelSell {
    data = {self: null, rendered: false};

    constructor() {
        this.init();
    }

    chartConfig() {
        const a = KTUtil.getCssVariableValue("--bs-gray-800");
        const l = KTUtil.getCssVariableValue("--bs-border-dashed-color");

        let categories = window.Laravel.topSellingModels.map(item => item.model_of_car.name);
        let salesData = window.Laravel.topSellingModels.map(item => item.count);

        // console.log(window.Laravel.topSellingModels)
        // console.log(categories)

        return {
            series: [{name: "Venta", data: salesData}],
            chart: {fontFamily: "inherit", type: "bar", height: 350, toolbar: {show: false}},
            plotOptions: {
                bar: {
                    borderRadius: 8,
                    horizontal: true,
                    distributed: true,
                    barHeight: 50,
                    dataLabels: {position: "bottom"}
                }
            },
            dataLabels: {
                enabled: true, textAnchor: "start", offsetX: 0, formatter: function (e, t) {

                    return wNumb({thousand: ","}).to(e)
                }, style: {fontSize: "14px", fontWeight: "600", align: "left"}
            },
            legend: {show: false},
            colors: ["#3E97FF", "#F1416C", "#50CD89", "#FFC700", "#7239EA"],
            xaxis: {
                categories: categories,
                labels: {
                    formatter: function (e) {
                        return e
                    },
                    style: {colors: [a], fontSize: "14px", fontWeight: "600", align: "left"}
                },
                axisBorder: {show: false}
            },
            yaxis: {
                labels: {
                    formatter: function (e, t) {
                        return Number.isInteger(e) ? e + " - " + parseInt(100 * e / 18).toString() + "%" : e
                    }, style: {colors: a, fontSize: "14px", fontWeight: "600"}, offsetY: 2, align: "left"
                }
            },
            grid: {borderColor: l, xaxis: {lines: {show: true}}, yaxis: {lines: {show: false}}, strokeDashArray: 4},
            tooltip: {
                style: {fontSize: "12px"}, y: {
                    formatter: function (e) {
                        return e
                    }
                }
            }
        };
    }

    renderChart(target) {
        const t = document.getElementById(target);

        if (t) {
            this.data.self = new ApexCharts(t, this.chartConfig());
            setTimeout(() => {
                this.data.self.render();
                this.data.rendered = true;
            }, 200);
        }
    }

    init() {
        this.renderChart("topModelSell");
        // console.log(window.Laravel.topSellingModels)
        KTThemeMode.on("kt.thememode.change", () => {
            if (this.data.rendered) {
                this.data.self.destroy();
                this.renderChart("topModelSell");
            }
        });
    }
}

KTUtil.onDOMContentLoaded(() => {
    new topModelSell();
});

const topSellingModels = {
    init: function () {
        (function initiateChartWidget() {
            if (typeof am5 !== "undefined") {
                const chartElement = document.getElementById("kt_charts_widget_17_chart");
                if (chartElement) {
                    let root, chartSetupFunction = function () {
                        root = am5.Root.new(chartElement);
                        root.setThemes([am5themes_Animated.new(root)]);

                        let pieChart = root.container.children.push(am5percent.PieChart.new(root, {
                            startAngle: 180,
                            endAngle: 360,
                            layout: root.verticalLayout,
                            innerRadius: am5.percent(50)
                        }));

                        let pieSeries = pieChart.series.push(am5percent.PieSeries.new(root, {
                            startAngle: 180,
                            endAngle: 360,
                            valueField: "value",
                            categoryField: "category",
                            alignLabels: false
                        }));

                        pieSeries.labels.template.setAll({
                            fontWeight: "400",
                            fontSize: 13,
                            fill: am5.color(KTUtil.getCssVariableValue("--bs-gray-500"))
                        });

                        pieSeries.states.create("hidden", {
                            startAngle: 180,
                            endAngle: 180
                        });

                        pieSeries.slices.template.setAll({cornerRadius: 5});
                        pieSeries.ticks.template.setAll({forceHidden: true});
                        // console.log(window.Laravel.topSellingGrades)
                        let colorList = ["--bs-primary", "--bs-success", "--bs-danger", "--bs-warning", "--bs-info", "--bs-secondary","--bs-blue", "--bs-indigo", "--bs-purple", "--bs-pink", "--bs-red" , "--bs-orange" , "--bs-yellow" , "--bs-green" , "--bs-teal"];
                        pieSeries.data.setAll(window.Laravel.topSellingGrades.map((item, index) => {
                            return {
                                value: item.count,
                                category: item.grade_of_car.name,
                                fill: am5.color(KTUtil.getCssVariableValue(colorList[index % colorList.length]))
                            };
                        }));

                        pieSeries.appear(1000, 100);
                    };

                    am5.ready(chartSetupFunction);
                    KTThemeMode.on("kt.thememode.change", function () {
                        root.dispose(), chartSetupFunction()
                    });
                }
            }
        })();
    }
};

if ("undefined" !== typeof module) {
    module.exports = topSellingModels;
}

KTUtil.onDOMContentLoaded(() => {
    topSellingModels.init();
});

const vehiclesMoreView = {
    init: function () {
        (function () {
            if (typeof am5 !== "undefined") {
                const chartContainer = document.getElementById("vehiclesMoreView");
                let myData = window.Laravel.modelQuotesCount;

                myData.sort((a, b) => b.quotes_count - a.quotes_count);

                if (chartContainer) {
                    let chartRoot;

                    const initializeChart = function () {
                        chartRoot = am5.Root.new(chartContainer);
                        chartRoot.setThemes([am5themes_Animated.new(chartRoot)]);

                        const chart = chartRoot.container.children.push(am5xy.XYChart.new(chartRoot, {
                            panX: false,
                            panY: false,
                            wheelX: "panX",
                            wheelY: "zoomX",
                            layout: chartRoot.verticalLayout
                        }));

                        const data = myData.map(obj => ({
                            country: obj.model_name,
                            visits: obj.quotes_count
                        }));

                        (function () {
                            const totalVisits = data.reduce(function (acc, item) {
                                return acc + item.visits;
                            }, 0);

                            let cumulativeVisits = 0;
                            data.forEach(function (item) {
                                cumulativeVisits += item.visits;
                                item.pareto = (cumulativeVisits / totalVisits) * 100;
                            });
                        })();

                        const xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(chartRoot, {
                            categoryField: "country",
                            renderer: am5xy.AxisRendererX.new(chartRoot, {minGridDistance: 30})
                        }));

                        xAxis.get("renderer").labels.template.setAll({
                            paddingTop: 10,
                            fontWeight: "400",
                            fontSize: 13,
                            fill: am5.color(KTUtil.getCssVariableValue("--bs-gray-500"))
                        });

                        xAxis.get("renderer").grid.template.setAll({
                            disabled: true,
                            strokeOpacity: 0
                        });

                        xAxis.data.setAll(data);

                        const yAxis = chart.yAxes.push(am5xy.ValueAxis.new(chartRoot, {
                            renderer: am5xy.AxisRendererY.new(chartRoot, {})
                        }));

                        yAxis.get("renderer").labels.template.setAll({
                            paddingLeft: 10,
                            fontWeight: "400",
                            fontSize: 13,
                            fill: am5.color(KTUtil.getCssVariableValue("--bs-gray-500"))
                        });

                        yAxis.get("renderer").grid.template.setAll({
                            stroke: am5.color(KTUtil.getCssVariableValue("--bs-gray-300")),
                            strokeWidth: 1,
                            strokeOpacity: 1,
                            strokeDasharray: [3]
                        });

                        const secondaryYAxis = chart.yAxes.push(am5xy.ValueAxis.new(chartRoot, {
                            renderer: am5xy.AxisRendererY.new(chartRoot, {opposite: true}),
                            min: 0,
                            max: 100,
                            strictMinMax: true,
                            numberFormat: "#'%"
                        }));

                        secondaryYAxis.get("renderer").labels.template.setAll({
                            fontWeight: "400",
                            fontSize: 13,
                            fill: am5.color(KTUtil.getCssVariableValue("--bs-gray-500"))
                        });

                        const columnSeries = chart.series.push(am5xy.ColumnSeries.new(chartRoot, {
                            xAxis: xAxis,
                            yAxis: yAxis,
                            valueYField: "visits",
                            categoryXField: "country"
                        }));

                        columnSeries.columns.template.setAll({
                            tooltipText: "{categoryX}: {valueY}",
                            tooltipY: 0,
                            strokeOpacity: 0,
                            cornerRadiusTL: 6,
                            cornerRadiusTR: 6
                        });

                        columnSeries.columns.template.adapters.add("fill", function (fill, target) {
                            return chart.get("colors").getIndex(columnSeries.dataItems.indexOf(target.dataItem));
                        });

                        const lineSeries = chart.series.push(am5xy.LineSeries.new(chartRoot, {
                            xAxis: xAxis,
                            yAxis: secondaryYAxis,
                            valueYField: "pareto",
                            categoryXField: "country",
                            stroke: am5.color(KTUtil.getCssVariableValue("--bs-dark")),
                            maskBullets: false
                        }));

                        lineSeries.bullets.push(function () {
                            return am5.Bullet.new(chartRoot, {
                                locationY: 1,
                                sprite: am5.Circle.new(chartRoot, {
                                    radius: 5,
                                    fill: am5.color(KTUtil.getCssVariableValue("--bs-primary")),
                                    stroke: am5.color(KTUtil.getCssVariableValue("--bs-dark"))
                                })
                            });
                        });

                        columnSeries.data.setAll(data);
                        lineSeries.data.setAll(data);
                        columnSeries.appear();
                        chart.appear(1000, 100);
                    };

                    am5.ready(function () {
                        initializeChart();
                    });

                    KTThemeMode.on("kt.thememode.change", function () {
                        chartRoot.dispose();
                        initializeChart();
                    });
                }
            }
        })();
    }
};

if (typeof module !== "undefined") {
    module.exports = vehiclesMoreView;
}

KTUtil.onDOMContentLoaded(function() {
    vehiclesMoreView.init();
});


const KTChartsWidget10 = (function () {

    const initChart = function (chartConfig, tabSelector, chartSelector, data, renderImmediately) {
        const chartElement = document.querySelector(chartSelector);
        if (chartElement) {
            const height = parseInt(KTUtil.css(chartElement, "height"));
            const gray900 = KTUtil.getCssVariableValue("--bs-gray-900");
            const dashedBorderColor = KTUtil.getCssVariableValue("--bs-border-dashed-color");

            const options = {
                series: [{name: "Cotizaciones:", data: data}],
                chart: {
                    fontFamily: "inherit",
                    type: "bar",
                    height: height,
                    toolbar: {show: false}
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: "22%",
                        borderRadius: 5,
                        dataLabels: {position: "top"},
                        startingShape: "flat"
                    }
                },
                legend: {show: false},
                dataLabels: {
                    enabled: true,
                    offsetY: -30,
                    style: {fontSize: "13px", colors: [gray900]},
                    formatter: function (val) {
                        return val;
                    }
                },
                stroke: {show: true, width: 2, colors: ["transparent"]},
                xaxis: {
                    categories: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
                    axisBorder: {show: false},
                    axisTicks: {show: false},
                    labels: {
                        style: {
                            colors: KTUtil.getCssVariableValue("--bs-gray-500"),
                            fontSize: "13px"
                        }
                    },
                    crosshairs: {
                        fill: {
                            gradient: {
                                opacityFrom: 0,
                                opacityTo: 0
                            }
                        }
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: KTUtil.getCssVariableValue("--bs-gray-500"),
                            fontSize: "13px"
                        },
                        formatter: function (val) {
                            return parseInt(val);
                        }
                    }
                },
                fill: {opacity: 1},
                states: {
                    normal: {filter: {type: "none", value: 0}},
                    hover: {filter: {type: "none", value: 0}},
                    active: {allowMultipleDataPointsSelection: false, filter: {type: "none", value: 0}}
                },
                tooltip: {
                    style: {fontSize: "12px"},
                    y: {
                        formatter: function (val) {
                            return val;
                        }
                    }
                },
                colors: [KTUtil.getCssVariableValue("--bs-primary"), KTUtil.getCssVariableValue("--bs-primary-light")],
                grid: {
                    borderColor: dashedBorderColor,
                    strokeDashArray: 4,
                    yaxis: {lines: {show: true}}
                }
            };

            chartConfig.self = new ApexCharts(chartElement, options);
            const tabElement = document.querySelector(tabSelector);

            if (renderImmediately) {
                setTimeout(function () {
                    chartConfig.self.render();
                    chartConfig.rendered = true;
                }, 200);
            }

            tabElement.addEventListener("shown.bs.tab", function () {
                if (!chartConfig.rendered) {
                    chartConfig.self.render();
                    chartConfig.rendered = true;
                }
            });
        }
    };

    console.log(window.Laravel.typesMonth)
    let charts = {};
    let counter = 1;

    for (let [key, value] of Object.entries(window.Laravel.typesMonth)) {
        let chart = { self: null, rendered: false };
        let quotesArray = Object.values(value.quotes);
        charts[`chart${counter}`] = chart;
        initChart(chart, `#kt_charts_widget_10_tab_${counter}`, `#kt_charts_widget_10_chart_${counter}`, quotesArray, counter === 1);
        counter++;
    }
    console.log(charts)
    console.log(counter)


    return {
        init: function () {
            KTThemeMode.on("kt.thememode.change", function () {
                Object.values(charts).forEach(function (chart) {
                    if (chart.rendered) {
                        chart.self.destroy();
                    }
                    initChart(chart, chart.tabSelector, chart.chartSelector, chart.data, chart.rendered);
                });
            });
        }
    };
})();

if (typeof module !== "undefined") {
    module.exports = KTChartsWidget10;
}

KTUtil.onDOMContentLoaded(function() {
    KTChartsWidget10.init();
});

