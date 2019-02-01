@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading bg-light">
                    <div style="font-size:16px; font-weight: bold; color:#565656;">Streaming Tweets</div>
                </div>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{session('success')}}
                    </div>
                @endif
                <div class="panel-body">
                    <div class="row" align="center">
                        <div class="col-lg-12">
                            <form class="form-inline" enctype="multipart/form-data" role="form" method="GET" action="{{ url('tweets') }}">
                                <div class="form-group">
                                    <input type="date" class="form-control" name="date" placeholder="Date">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="user_screen_name" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="user_name" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="tweet_text" placeholder="Tweet Text">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="bio" placeholder="Bio">
                                </div>
                                <button type="submit" class="btn btn-default">Search</button>
                            </form>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-lg-12 table-responsive">
                            <table id="example" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered hover">
                                <thead>
                                <tr>
                                    <th style="text-align: center; width:90px;">Date</th>
                                    <th style="text-align: center; width:400px;">Tweet</th>
                                    <th style="text-align: center; width:90px;">User Since</th>
                                    <th style="text-align: center; width:110px;">Username</th>
                                    <th style="text-align: center; width:170px;">Full Name</th>
                                    <th style="text-align: center; width:40px;">Photo</th>
                                    <th style="text-align: center; width:170px;">Location</th>
                                    <th style="text-align: center; width:170px;">Bio</th>
                                    <th style="text-align: center; width:60px;">Followers</th>
                                    <th style="text-align: center; width:60px;">Following</th>
                                    <th style="text-align: center; width:60px;">Tweets</th>
                                    <th style="text-align: center; width:50px;">Lang</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tweets as $tweet)
                                    <tr>
                                        <td style="text-align: center;">{{ \Carbon\Carbon::createFromTimeString($tweet->tweet_created_at)->toDateString() }}</td>
                                        <td style="text-align: center;">{{ $tweet->tweet_text }}</td>
                                        <td style="text-align: center;">{{ \Carbon\Carbon::createFromTimeString($tweet->user_created_at)->toDateString() }}</td>
                                        <td style="text-align: center;">
                                            <a href="https://twitter.com/{{ $tweet->user_screen_name }}" target="_blank">{{ $tweet->user_screen_name }}</a>
                                        </td>
                                        <td style="text-align: center;">{{ $tweet->user_name }}</td>
                                        <td style="text-align: center;">
                                            <a href="{{ $tweet->profile_image_url }}" target="_blank">
                                                <img src="{{ $tweet->profile_image_url }}" style="width:45px;">
                                            </a>
                                        </td>
                                        <td style="text-align: center;">{{ $tweet->location }}</td>
                                        <td style="text-align: center;">{{ $tweet->description }}</td>
                                        <td style="text-align: center;">{{ $tweet->followers_count }}</td>
                                        <td style="text-align: center;">{{ $tweet->friends_count }}</td>
                                        <td style="text-align: center;">{{ $tweet->statuses_count }}</td>
                                        <td style="text-align: center;">{{ $tweet->lang }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        <div align="center">{{$tweets->render()}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection