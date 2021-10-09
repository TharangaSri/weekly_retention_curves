<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
    </script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <title>Document</title>
</head>

<body>


    <div id="container" style="height: 400px"></div>

    <script>
        $(document).ready(function () {
            chart = new Highcharts.Chart(
                {
                    chart: {
                        type: "line",
                        renderTo: 'container',
                        events: {
                            load: requestData
                        }
                    },
                    title: {
                        text: "Weekly Retention Curve"
                    },
                    credits: {
                        enabled: false
                    },
                    xAxis: {
                        categories: [
                            '0 Weeks later',
                            '1 Weeks later',
                            '2 Weeks later',
                            '3 Weeks later',
                            '4 Weeks later',
                            '5 Weeks later',
                            '6 Weeks later',
                            '7 Weeks later',
                        ]
                    },
                    tooltip: {
                        valueSuffix: "%"
                    },
                    yAxis: {
                        title: {
                            text: "Total Onboarded"
                        },
                        labels: {
                            format: "{value}%"
                        },
                        min: 0,
                        max: 100
                    },
                    series: [
                    ]
                });
        });

    </script>
    <script>
        function requestData() {
            $.ajax({
                url: '/api/v1/chart/weeklyRetention',
                type: "GET",
                dataType: "json",
                success: function (jsonobject) {
                    console.log(jsonobject.data)
                    //jsonobject contains series
                    $.each(jsonobject.data, function (i, serie) {
                        console.log(serie)
                        chart.addSeries(serie, false);
                    });
                    chart.redraw();
                },
                cache: false
            });
        }
    </script>
</body>

</html>