@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size:16px; font-weight: bold; color:#565656;">Daily Chat Tweets</div>
                    <div class="panel-body">
                        <div id="daily_chat_tweets" style="height: 400px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size:16px; font-weight: bold; color:#565656;">Daily Direct Messages On Follow</div>
                    <div class="panel-body">
                        <div id="daily_dm" style="height: 400px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size:16px; font-weight: bold; color:#565656;">Top 10 Chat Keywords</div>
                    <div class="panel-body">
                        <div id="top_chat_keywords" style="width: 500px; height: 400px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size:16px; font-weight: bold; color:#565656;">Top 10 Chat Users</div>
                    <div class="panel-body">
                        <div id="top_chat_users" style="width: 500px; height: 400px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size:16px; font-weight: bold; color:#565656;">Top 10 Archived Tweets Users</div>
                    <div class="panel-body">
                        <div id="top_archive_users" style="width: 500px; height: 400px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size:16px; font-weight: bold; color:#565656;">Current Year Schedules</div>
                    <div class="panel-body">
                        <div id="current_year_schedules" style="width: 500px; height: 400px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawDailyChatTweetsChart);
    google.charts.setOnLoadCallback(drawDailyDMChart);
    google.charts.setOnLoadCallback(drawTopChatKeywordsChart);
    google.charts.setOnLoadCallback(drawTopChatUsersChart);
    google.charts.setOnLoadCallback(drawTopSteamUsersChart);
    google.charts.setOnLoadCallback(drawCurrentYearSchedulesChart);

    function drawDailyChatTweetsChart() {
        var daily_chat_tweets = <?php echo json_encode($daily_chat_tweets); ?>;
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Day');
        data.addColumn('number', 'Tweets');

        data.addRows(daily_chat_tweets);

        var options = {
            title: '',
            hAxis: {
                title: 'Day',
                minValue: 0
            },
            vAxis: {
                title: 'Tweets'
            },
            colors:['#538ACF']
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('daily_chat_tweets'));
        chart.draw(data, options);
    }

    function drawDailyDMChart() {
        var daily_dm = <?php echo json_encode($daily_dm); ?>;
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Day');
        data.addColumn('number', 'Direct Messages');

        data.addRows(daily_dm);

        var options = {
            title: '',
            hAxis: {
                title: 'Day',
                minValue: 0
            },
            vAxis: {
                title: 'Direct Messages'
            },
            colors:['#00BABE']
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('daily_dm'));
        chart.draw(data, options);
    }

    function drawTopChatKeywordsChart() {
        var top_chat_keywords = <?php echo json_encode($top_chat_keywords); ?>;
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Keyword');
        data.addColumn('number', 'Tweets');
        data.addRows(top_chat_keywords);

        var options = {
            title: '',
            hAxis: {
                title: 'Keywords',
                minValue: 0,
                direction:-1,
                slantedText:true,
                slantedTextAngle:40
            },
            vAxis: {
                title: 'Tweets'
            },
            colors:['#8FC7D7']
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('top_chat_keywords'));
        chart.draw(data, options);
    }

    function drawTopChatUsersChart() {
        var top_chat_users = <?php echo json_encode($top_chat_users); ?>;
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'User');
        data.addColumn('number', 'Tweets');
        data.addRows(top_chat_users);

        var options = {
            title: '',
            hAxis: {
                title: 'Users',
                minValue: 0,
                direction:-1,
                slantedText:true,
                slantedTextAngle:40
            },
            vAxis: {
                title: 'Tweets'
            },
            colors:['#BDCF96']
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('top_chat_users'));
        chart.draw(data, options);
    }


    function drawTopSteamUsersChart() {
        var top_archive_users = <?php echo json_encode($top_chat_users); ?>;
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'User');
        data.addColumn('number', 'Tweets');
        data.addRows(top_archive_users);

        var options = {
            title: '',
            hAxis: {
                title: 'Users',
                minValue: 0,
                direction:-1,
                slantedText:true,
                slantedTextAngle:40
            },
            vAxis: {
                title: 'Tweets'
            },
            colors:['#A54341']
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('top_archive_users'));
        chart.draw(data, options);
    }

    function drawCurrentYearSchedulesChart() {
        var current_year_schedules = <?php echo json_encode($current_year_schedules); ?>;
        var data = new google.visualization.DataTable();
        data.addColumn('number', 'Month');
        data.addColumn('number', 'Schedules');

        for(var i=0; i< current_year_schedules.length; i++) {
            var arr = [];
            for(var j=0; j< current_year_schedules[i].length; j++) {
                arr.push(parseFloat(current_year_schedules[i][j]));
            }
            data.addRow(arr);
        }

        var options = {
            title: '',
            hAxis: {
                title: 'Months',
                minValue: 0,
                direction: -1,
                slantedText: true,
                slantedTextAngle: 40
            },
            vAxis: {
                title: 'Schedules'
            },
            colors: ['#DC6743']
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('current_year_schedules'));
        chart.draw(data, options);
    }

</script>