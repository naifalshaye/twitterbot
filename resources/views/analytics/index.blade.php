@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size:16px; font-weight: bold; color:#565656;">Top 10 Streaming Keywords</div>
                    <div class="panel-body">
                        <div class="col-lg-8">
                            <div id="top_chat" style="width: 600px; height: 400px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart2);

    function drawChart2() {
        var top_chat = <?php echo json_encode($top_chat_chart); ?>;

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Keyword');
        data.addColumn('number', 'Tweets');
        data.addRows(top_chat);

        var options = {
            title: '',
            hAxis: {
                title: 'Keywords',
                minValue: 0
            },
            vAxis: {
                title: 'Tweets'
            },

            colors:['#478EC7']
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('top_chat'));

        chart.draw(data, options);
    }
</script>