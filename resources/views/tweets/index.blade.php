@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading bg-light">
                    <div style="font-size:16px; font-weight: bold; color:#565656;">FAQ Tweets</div>
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
                    <div class="row">
                        <div class="col-lg-12 table-responsive">
                            <table id="example" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered hover">
                                <thead>
                                <tr>
                                    <th style="text-align: center; width:170px;">User ID</th>
                                    <th style="text-align: center; width:170px;">Username</th>
                                    <th style="text-align: center; width:400px;">Tweet</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tweets as $tweet)
                                    <tr>
                                        <td style="text-align: center;">{{ $tweet->user_id }}</td>
                                        <td style="text-align: center;">{{ $tweet->user_screen_name }}</td>
                                        <td style="text-align: center;">{{ $tweet->tweet_text }}</td>
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