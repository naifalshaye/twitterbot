@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Bot Configuration</div>

                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/conf') }}">
                            {{ csrf_field() }}
                            <h3 align="left">API User Details</h3>
                            <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
                                <label for="user_id" class="col-md-4 control-label">User ID</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="user_id" value="{{ $conf->user_id }}" disabled>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('screen_name') ? ' has-error' : '' }}">
                                <label for="screen_name" class="col-md-4 control-label">User Name</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="screen_name" value="{{ $conf->screen_name }}" disabled>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" value="{{ $conf->name }}" disabled>
                                </div>
                            </div>

                            <h3 align="left">RESTful</h3>
                            <div class="form-group{{ $errors->has('TWITTER_CONSUMER_KEY') ? ' has-error' : '' }}">
                                <label for="TWITTER_CONSUMER_KEY" class="col-md-4 control-label">Consumer Key</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="TWITTER_CONSUMER_KEY" value="{{ $conf->TWITTER_CONSUMER_KEY }}">

                                    @if ($errors->has('TWITTER_CONSUMER_KEY'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('TWITTER_CONSUMER_KEY') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('TWITTER_CONSUMER_SECRET') ? ' has-error' : '' }}">
                                <label for="TWITTER_CONSUMER_SECRET" class="col-md-4 control-label">Consumer Secret</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="TWITTER_CONSUMER_SECRET" value="{{ $conf->TWITTER_CONSUMER_SECRET }}">

                                    @if ($errors->has('TWITTER_CONSUMER_SECRET'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('TWITTER_CONSUMER_SECRET') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('TWITTER_ACCESS_TOKEN') ? ' has-error' : '' }}">
                                <label for="TWITTER_ACCESS_TOKEN" class="col-md-4 control-label">Access Token</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="TWITTER_ACCESS_TOKEN" value="{{ $conf->TWITTER_ACCESS_TOKEN }}">

                                    @if ($errors->has('TWITTER_ACCESS_TOKEN'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('TWITTER_ACCESS_TOKEN') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('TWITTER_ACCESS_TOKEN_SECRET') ? ' has-error' : '' }}">
                                <label for="TWITTER_ACCESS_TOKEN_SECRET" class="col-md-4 control-label">Access Token Secret</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="TWITTER_ACCESS_TOKEN_SECRET" value="{{ $conf->TWITTER_ACCESS_TOKEN_SECRET }}">

                                    @if ($errors->has('TWITTER_ACCESS_TOKEN_SECRET'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('TWITTER_ACCESS_TOKEN_SECRET') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <hr>
                            <h3 align="left">Streaming</h3>
                            <div class="form-group{{ $errors->has('STREAM_TWITTER_CONSUMER_KEY') ? ' has-error' : '' }}">
                                <label for="STREAM_TWITTER_CONSUMER_KEY" class="col-md-4 control-label">Consumer Key</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="STREAM_TWITTER_CONSUMER_KEY" value="{{ $conf->STREAM_TWITTER_CONSUMER_KEY }}">

                                    @if ($errors->has('STREAM_TWITTER_CONSUMER_KEY'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('STREAM_TWITTER_CONSUMER_KEY') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('STREAM_TWITTER_CONSUMER_SECRET') ? ' has-error' : '' }}">
                                <label for="STREAM_TWITTER_CONSUMER_SECRET" class="col-md-4 control-label">Consumer Secret</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="STREAM_TWITTER_CONSUMER_SECRET" value="{{ $conf->STREAM_TWITTER_CONSUMER_SECRET }}">

                                    @if ($errors->has('STREAM_TWITTER_CONSUMER_SECRET'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('STREAM_TWITTER_CONSUMER_SECRET') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('STREAM_TWITTER_ACCESS_TOKEN') ? ' has-error' : '' }}">
                                <label for="STREAM_TWITTER_ACCESS_TOKEN" class="col-md-4 control-label">Access Token</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="STREAM_TWITTER_ACCESS_TOKEN" value="{{ $conf->STREAM_TWITTER_ACCESS_TOKEN }}">

                                    @if ($errors->has('STREAM_TWITTER_ACCESS_TOKEN'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('STREAM_TWITTER_ACCESS_TOKEN') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('STREAM_TWITTER_ACCESS_TOKEN_SECRET') ? ' has-error' : '' }}">
                                <label for="STREAM_TWITTER_ACCESS_TOKEN_SECRET" class="col-md-4 control-label">Access Token Secret</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="STREAM_TWITTER_ACCESS_TOKEN_SECRET" value="{{ $conf->STREAM_TWITTER_ACCESS_TOKEN_SECRET }}">

                                    @if ($errors->has('STREAM_TWITTER_ACCESS_TOKEN_SECRET'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('STREAM_TWITTER_ACCESS_TOKEN_SECRET') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <div align="center">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection