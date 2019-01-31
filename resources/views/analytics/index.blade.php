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
                    <div class="panel-heading" style="font-size:16px; font-weight: bold; color:#565656;">Top 10 Streaming Tweets Users</div>
                    <div class="panel-body">
                        <div id="top_stream_users" style="width: 500px; height: 400px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size:16px; font-weight: bold; color:#565656;">Top 10 Direct Messages Users</div>
                    <div class="panel-body">
                        <div id="top_dm_users" style="width: 500px; height: 400px;"></div>
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
    google.charts.setOnLoadCallback(drawTopChatKeywordsChart);
    google.charts.setOnLoadCallback(drawTopChatUsersChart);
    google.charts.setOnLoadCallback(drawTopSteamUsersChart);
    google.charts.setOnLoadCallback(drawTopDMUsersChart);

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
        var top_stream_users = <?php echo json_encode($top_chat_users); ?>;
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'User');
        data.addColumn('number', 'Tweets');
        data.addRows(top_stream_users);

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
            colors:['#F3BB8C']
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('top_stream_users'));
        chart.draw(data, options);
    }

    function drawTopDMUsersChart() {
        var top_dm_users = <?php echo json_encode($top_dm_users); ?>;
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'User');
        data.addColumn('number', 'Total');
        data.addRows(top_dm_users);

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
                title: 'Direct MessagesT '
            },
            colors:['#D39290']
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('top_dm_users'));
        chart.draw(data, options);
    }
</script>