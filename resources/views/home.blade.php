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
                            @foreach ($trends[0]->trends as $trend)
                                <li>
                                    @if (str_contains($trend->name,'#'))
                                        <a href="https://twitter.com/hashtag/{{str_replace('#','',$trend->name)}}" target="_blank">{{$trend->name}}</a>
                                    @else
                                        <a href="https://twitter.com/search?q={{$trend->name}}" target="_blank">{{$trend->name}}</a>
                                    @endif
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
            <div class="row">
            <div class="col-lg-3">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size:16px; font-weight: bold;">Numbers</div>
                    <div class="panel-body">
                        <div>Chat Keywords: {{$numbers->chat}}</div>
                        <div>Stream Keywords: {{$numbers->stream}}</div>
                        <div>Chat Tweets: {{$numbers->chat_tweets}}</div>
                        <div>
                            Stream Tweets:
                            @if ($stream_tweet)
                                {{$stream_tweet->count()}}
                            @else
                                0
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            @if (isset($chat_tweet))
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="font-size:16px; font-weight: bold;">Chat Latest Tweet</div>
                        <div class="panel-body">
                             Time: {{$chat_tweet->created_at}}<br>
                            keyword: {{$chat_tweet->keyword}}<br>
                            Tweet: {{$chat_tweet->tweet_text}}<br>
                            From: <a href="http://twitter.com/{{ $chat_tweet->user_screen_name }}" target="_blank">{{ $chat_tweet->user_name }}</a><br>
                            Reply: {{$chat_tweet->reply}}
                        </div>
                    </div>
                </div>
            @endif
            @if (isset($stream_tweet))
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="font-size:16px; font-weight: bold;">Stream Latest Tweet</div>
                        <div class="panel-body">
                            Time: {{$stream_tweet->created_at}}<br>
                            Tweet: {{$stream_tweet->tweet_text}}<br>
                            From: <a href="http://twitter.com/{{ $stream_tweet->user_screen_name }}" target="_blank">{{ $stream_tweet->user_screen_name }}</a><br>
                        </div>
                    </div>
                </div>
            @endif


            <div class="col-lg-8">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size:16px; font-weight: bold;">Stats</div>
                    <div class="panel-body" align="center">
                        <div id="top_chat" style="width: 600px; height: 400px;"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

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

            var chart = new google.visualization.ColumnChart(document.getElementById('top_chat'));

            chart.draw(data, options);
        }
    </script>
@endsection
