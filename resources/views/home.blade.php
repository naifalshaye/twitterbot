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
                        <div>Archive Keywords: {{$numbers->archive}}</div>
                        <div>Chat Tweets: {{$numbers->chat_tweets}}</div>
                        <div>
                            Archive Tweets:
                            @if ($archive_tweet)
                                {{$archive_tweet->count()}}
                            @else
                                0
                            @endif
                        </div>
                        <div>Schedules: {{$numbers->schedules}}</div>
                        <div>DM: {{$numbers->dm}}</div>

                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size:16px; font-weight: bold;">User Info</div>
                    <div class="panel-body">
                        <div>
                            <div><img src="{{$user_info->profile_image_url}}" class="img-circle" style="height: 65px !important;"></div>
                            <div style="margin-top:-40px; margin-left:80px; color:black; font-weight: bold; font-size:18px;">{{$user_info->name}}</div>
                            <div style="margin-left:80px;">
                                <a href="https://twitter.com/{{$user_info->screen_name}}" target="_blank" style="color:#657786 !important;">{{'@'.$user_info->screen_name}}</a>
                            </div>
                            <div style="margin-top:20px;">
                                <table>
                                    <tr>
                                        <td style="padding-right:20px; color:#6B7D8B !important;">Tweets</td>
                                        <td style="padding-right:20px; color:#6B7D8B !important;">Following</td>
                                        <td style="padding-right:20px; color:#6B7D8B !important;">Followers</td>
                                    </tr>
                                    <tr>
                                        <td style="color:#1CA1F2 !important; padding-right:20px; font-weight: bold;">{{$user_info->statuses_count}}</td>
                                        <td style="color:#1CA1F2 !important; padding-right:20px; font-weight: bold;">{{$user_info->friends_count}}</td>
                                        <td style="color:#1CA1F2 !important; padding-right:20px; font-weight: bold;">{{$user_info->followers_count}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size:16px; font-weight: bold;">Services Status</div>
                    <div class="panel-body">
                        <div align="center" style="text-align: left;"><span class="fa fa-power-off" style="font-size:20px; color:@if ($settings->bot_power) green @else red @endif;"></span> Bot</div>
                        <div align="center" style="text-align: left;"><span class="fa fa-power-off" style="font-size:20px; color:@if ($settings->chat_power) green @else red @endif;"></span> Chat</div>
                        <div align="center" style="text-align: left;"><span class="fa fa-power-off" style="font-size:20px; color:@if ($settings->archive_power) green @else red @endif;"></span> Archive</div>
                        <div align="center" style="text-align: left;"><span class="fa fa-power-off" style="font-size:20px; color:@if ($settings->schedule_power) green @else red @endif;"></span> Schedule</div>
                        <div align="center" style="text-align: left;"><span class="fa fa-power-off" style="font-size:20px; color:@if ($settings->onfollow_power) green @else red @endif;"></span> DM on follow</div>
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
            @if (isset($archive_tweet))
                <div class="col-lg-8 @if (!isset($trends)) col-lg-offset-3 @endif">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="font-size:16px; font-weight: bold;">Archive Latest Tweet</div>
                        <div class="panel-body">
                            Time: {{$archive_tweet->created_at}}<br>
                            Tweet: {{$archive_tweet->tweet_text}}<br>
                            From: <a href="http://twitter.com/{{ $archive_tweet->user_screen_name }}" target="_blank">{{ $archive_tweet->user_screen_name }}</a><br>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>
@endsection
