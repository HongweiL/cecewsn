@extends('layouts.sidebar')

@section('content')
    <link rel="stylesheet" href="css/dash.css?version=1.2">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
    <script type="text/javascript" src="js/chart.js"></script>
    @if (!\App\User::isApproved())
        <p style="background-color: coral; color: whitesmoke">Your account is inactive, please wait for the administrator to approve it.</p>
    @endif
    <nav class="upper-header">
            <div class="title">
                <h1>CECEWSN - Dashboard</h1>
            </div>
            <div class="extra"></div>
        </nav>
        <section class="main-chart">
            <div id="container2" style="height: 100%; width:45%; float:left;margin-left:5%"></div>
            <div id="container1" style="height: 100%; width:25%; float:right;"></div>
            <div id="container" style="height: 100%; width:25%; float:right;"></div>
        </section>

        <section class="quick-access">
            <div class="row">
                <h2>Quick Access</h2>
                <hr class="style1">
            </div>
            <div class="row quick-button">
                <div class="quick-upload item">
                    <h2><a href="upload">Upload</a></h2>
                </div>
                <div class="quick-search item">
                    <h2><a href="view">Reports</a></h2>
                </div>
                <div class="quick-forum item">
                    <h2><a>Forum</a></h2>
                </div>
            </div>
        </section>

        <section class="activity">
            <div class="row">
                <h2>About CECEWSN</h2>
                <hr class="style1">
            </div>
            <div class="row activity-list">
                CECEWSN is web based application that allows scientific researchers especially 
                environmental chemists to upload HRMS data to improve the speed of calculation 
                on state-of-the art algorithms; archiving and storage; and collaboration with 
                other environmental chemists. More importantly, it will also be used as a 
                platform for interpretation and visualisation of chemical statistics on 
                different meta-data. The system aims to benefit general environmental monitoring 
                and discovery of Chemicals of Emerging Concern.
            </div>
        </section>
        <script type="text/javascript">
            var dom = document.getElementById("container");
            var dom2 = document.getElementById("container2");
            var dom3 = document.getElementById("container1");
            var myChart = echarts.init(dom);
            var app = {};
            option = null;
            option = {
                title: {
                    text: "Real-time usage",
                },
                tooltip : {
                    formatter: "{a} <br/>{b} : {c}%"
                },
                series: [
                    {
                        name: 'Usage',
                        type: 'gauge',
                        detail: {formatter:'{value}%'},
                        data: [{value: 0, name: 'CPU'}]
                    }
                ]
            };
            var myChart2 = echarts.init(dom2);
            $.ajax({
                url:"uploadStat",
                success:function(stat) {
                    stat = $.parseJSON(stat);
                    option2 = null;
                    option2 = {
                        title: {
                            text: "Daily Uploads",
                        },
                        xAxis: {
                            type: 'category',
                            boundaryGap: false,
                            data: stat.date,
                        },
                        yAxis: {
                            type: 'value'
                        },
                        series: [{
                            data: stat.main,
                            type: 'line',
                            areaStyle: {}
                            }]
                    };
                    myChart2.setOption(option2, true);
                }
            });
            var myChart3 = echarts.init(dom3);
            option3 = null;
            option3 = {
                tooltip : {
                    formatter: "{a} <br/>{b} : {c}%"
                },
                series: [
                    {
                        name: 'Usage',
                        type: 'gauge',
                        detail: {formatter:'{value}%'},
                        data: [{value: 0, name: 'RAM'}]
                    }
                ]
            };
            myChart3.setOption(option3, true);
            getUsage();
            setInterval(getUsage,10000);
            ;
            if (option && typeof option === "object") {
                myChart.setOption(option, true);
            };
            function getUsage() {
                $.ajax({
                    url:"cpuUsage",
                    success: function(data){
                        option.series[0].data[0].value = data.cpu.substring(0,data.cpu.indexOf(".")+3);
                        myChart.setOption(option, true);
                        option3.series[0].data[0].value = data.ram.substring(0,data.ram.indexOf(".")+3)*100;
                        myChart3.setOption(option3, true);
                    }
                })
            }
       </script>
@endsection
