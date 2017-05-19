@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-3">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-weight: bold;">Trending</div>

                    <div class="panel-body">
                        <ol>
                            @foreach ($trends as $trend)
                                <li>{{$trend->name}}</li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
            <div class="row">
            <div class="col-lg-3">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size:16px; font-weight: bold;">Stream</div>
                    <div class="panel-body">
                        <a href="#" class="btn btn-success" disabled="">Run Stream</a>
                        <a href="#" class="btn btn-danger" disabled="disabled" readonly="">Stop Stream</a>
                    </div>
                </div>
            </div>

            @if (isset($faq_tweet))
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="font-size:16px; font-weight: bold;">RESTful Latest Tweet</div>
                        <div class="panel-body">
                            keyword: {{$faq_tweet->keyword}}<br>
                            Tweet: {{$faq_tweet->tweet_text}}<br>
                            From: <a href="http://twitter.com/{{ $faq_tweet->user_screen_name }}" target="_blank">{{ $faq_tweet->user_name }}</a><br>
                            Reply: {{$faq_tweet->reply}}
                        </div>
                    </div>
                </div>
            @endif
            @if (isset($stream_tweet))
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="font-size:16px; font-weight: bold;">Streaming Latest Tweet</div>
                        <div class="panel-body">
                            Tweet: {{$stream_tweet->tweet_text}}<br>
                            From: <a href="http://twitter.com/{{ $stream_tweet->user_screen_name }}" target="_blank">{{ $stream_tweet->user_screen_name }}</a><br>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-lg-8">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size:16px; font-weight: bold;">Running Processes</div>
                    <div class="panel-body">
                        <div align="right">
                            <form class="form-inline" role="form" method="POST" action="{{ url('/kill') }}">
                                {{ csrf_field() }}

                                <div class="form-inline">
                                    <input type="number" class="form-control" name="pid" style="width:100px;" placeholder="PID">
                                    <button type="submit" class="btn btn-warning">
                                        Kill
                                    </button>

                                    <form class="form-inline" role="form" method="POST" action="{{ url('/killall') }}">
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger">
                                            Kill All
                                        </button>
                                    </form>
                                </div>
                            </form>
                        </div>
                        @if (isset($ps))
                            @foreach($ps as $p)
                                {{$p}}.'<br>'
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size:16px; font-weight: bold;">Stats</div>
                    <div class="panel-body" align="center">
                        <div id="total_tweets" style="width: 600px; height: 400px;"></div>
                        <div id="top_faq" style="width: 600px; height: 400px;"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        google.charts.setOnLoadCallback(drawChart2);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Type', 'Tweets'],
                ['FAQ',     11],
                ['Stream',   2]
            ]);

            var options = {
                title: 'Total Tweets',
                is3D: true,
                width:600,
                colors:['#436CA0','#A1B4D4']
            };

            var chart = new google.visualization.PieChart(document.getElementById('total_tweets'));

            chart.draw(data, options);
        }


        function drawChart2() {
            var top_faq = <?php echo json_encode($top_faq_chart); ?>;

            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Keyword');
            data.addColumn('number', 'Tweets');
            data.addRows(top_faq);

            var options = {
                title: 'Top 10 keywords',
                hAxis: {
                    title: 'Keywords',
                    minValue: 0
                },
                vAxis: {
                    title: 'Tweets'
                },

                colors:['#478EC7']
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('top_faq'));

            chart.draw(data, options);
        }
    </script>

@endsection
