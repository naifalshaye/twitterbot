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
            @if (isset($faq_tweet))
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="font-size:16px; font-weight: bold;">Streaming Latest Tweet</div>
                        <div class="panel-body">
                            keyword: {{$faq_tweet->keyword}}<br>
                            Tweet: {{$faq_tweet->tweet_text}}<br>
                            From: <a href="http://twitter.com/{{ $faq_tweet->user_screen_name }}" target="_blank">{{ $faq_tweet->user_name }}</a><br>
                            Reply: {{$faq_tweet->reply}}
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

        </div>
    </div>
</div>
@endsection
