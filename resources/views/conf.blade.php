@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Bot Configuration</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/conf') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('TWITTER_CONSUMER_KEY') ? ' has-error' : '' }}">
                            <label for="TWITTER_CONSUMER_KEY" class="col-md-4 control-label">TWITTER_CONSUMER_KEY</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="TWITTER_CONSUMER_KEY" value="{{ $conf-TWITTER_CONSUMER_KEY }}">

                                @if ($errors->has('TWITTER_CONSUMER_KEY'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('TWITTER_CONSUMER_KEY') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('TWITTER_CONSUMER_SECRET') ? ' has-error' : '' }}">
                            <label for="TWITTER_CONSUMER_SECRET" class="col-md-4 control-label">TWITTER_CONSUMER_SECRET</label>

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
                            <label for="TWITTER_ACCESS_TOKEN" class="col-md-4 control-label">TWITTER_ACCESS_TOKEN</label>

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
                            <label for="TWITTER_ACCESS_TOKEN_SECRET" class="col-md-4 control-label">TWITTER_ACCESS_TOKEN_SECRET</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="TWITTER_ACCESS_TOKEN_SECRET" value="{{ $conf->TWITTER_ACCESS_TOKEN_SECRET }}">

                                @if ($errors->has('TWITTER_ACCESS_TOKEN_SECRET'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('TWITTER_ACCESS_TOKEN_SECRET') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div align="center">
                                <button type="submit" class="btn btn-success">تحديث</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
