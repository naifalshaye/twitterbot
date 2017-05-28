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
                    <div class="panel-heading" style="font-size:16px; font-weight: bold;">Numbers</div>
                    <div class="panel-body">
                        <div>FAQ Keywords: {{$numbers->faq}}</div>
                        <div>Stream Keywords: {{$numbers->faq}}</div>
                        <div>FAQ Tweets: {{$numbers->faq_tweets}}</div>
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

            @if (isset($faq_tweet))
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="font-size:16px; font-weight: bold;">FAQ Latest Tweet</div>
                        <div class="panel-body">
                             Time: {{$faq_tweet->created_at}}<br>
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
                    <div class="panel-heading" style="height: 45px;">
                        <div class="row">
                            <div class="btn btn-sm pull-left" style="font-size:16px; font-weight: bold;  margin-top:-6px;">Running Processes</div>
                            <div class="btn btn-sm pull-right" style="margin-top:-12px;"><a href="/run_stream" class="btn btn-success btn-md">Run Stream</a></div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div align="right">
                            <form class="form-inline" role="form" method="POST" action="{{ url('/kill') }}">
                                {{ csrf_field() }}

                                <div class="form-inline">
                                    <input type="number" class="form-control" name="pid" style="width:100px;" placeholder="PID">
                                    <button type="submit" class="btn btn-danger">
                                        Kill
                                    </button>
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
        google.charts.setOnLoadCallback(drawChart2);


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
