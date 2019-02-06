@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            @if (isset($trends))
                <div class="col-lg-4">
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
            @endif
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
                        <div>Schedules: {{$numbers->schedules}}</div>
                        <div>DM: {{$numbers->dm}}</div>

                    </div>
                </div>
            </div>
                
            <div class="col-lg-2">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size:16px; font-weight: bold;">Bot Status</div>
                    <div class="panel-body">
                        <div align="center" style="color:green;">@if ($settings->bot_power) <span class="fa fa-power-off" style="font-size:24px;"></span> Off @endif</div>
                        <div align="center" style="color:red;">@if (!$settings->bot_power) <span class="fa fa-power-off" style="font-size:24px;"></span> Off @endif</div>
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
                <div class="col-lg-8 @if (!isset($trends)) col-lg-offset-3 @endif">
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

        </div>
    </div>
</div>
@endsection
