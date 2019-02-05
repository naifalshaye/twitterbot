@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-md-offset-2">
                <div align="center">
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
                </div>
            </div>
            <div class="col-md-7 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size:16px; font-weight: bold; color:#565656;">Bot Configuration</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/conf') }}">
                            {{ csrf_field() }}
                            <div>Twitter API Keys</div>
                            <hr>
                            <div class="form-group">
                                <label for="consumer_key" class="col-md-3 control-label">Consumer Key</label>
                                <div class="col-md-4">
                                    <input type="text" name="consumer_key" style="width:400px;" value="{{$conf->consumer_key}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="consumer_secret" class="col-md-3 control-label">Consumer Secret</label>
                                <div class="col-md-4">
                                    <input type="text" name="consumer_secret" style="width:400px;" value="{{$conf->consumer_secret}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="access_token" class="col-md-3 control-label">Access Token</label>
                                <div class="col-md-4">
                                    <input type="text" name="access_token" style="width:400px;" value="{{$conf->access_token}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="access_secret" class="col-md-3 control-label">Access Secret</label>
                                <div class="col-md-4">
                                    <input type="text" name="access_secret" style="width:400px;" value="{{$conf->access_secret}}">
                                </div>
                            </div>
                            <hr>
                            <div>General Settings</div>

                            <div class="form-group">
                                <label for="bot_power" class="col-md-4 control-label">Bot</label>
                                <div class="col-md-6">
                                    <input type="checkbox" name="bot_power" data-group-cls="btn-group-sm" @if ($conf->bot_power) checked @endif>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="chat_power" class="col-md-4 control-label">Chat</label>
                                <div class="col-md-6">
                                    <input type="checkbox" name="chat_power" data-group-cls="btn-group-sm" @if ($conf->chat_power) checked @endif>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="archive_power" class="col-md-4 control-label">Archive</label>
                                <div class="col-md-6">
                                    <input type="checkbox" name="archive_power" data-group-cls="btn-group-sm" @if ($conf->archive_power) checked @endif>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="schedule_power" class="col-md-4 control-label">Schedule</label>
                                <div class="col-md-6">
                                    <input type="checkbox" name="schedule_power" data-group-cls="btn-group-sm" @if ($conf->schedule_power) checked @endif>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="onfollow_power" class="col-md-4 control-label">DM On Follow</label>
                                <div class="col-md-6">
                                    <input type="checkbox" name="onfollow_power" data-group-cls="btn-group-sm" @if ($conf->onfollow_power) checked @endif>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="stop_registration" class="col-md-4 control-label">Registration Form</label>
                                <div class="col-md-6">
                                    <input type="checkbox" name="stop_registration" data-group-cls="btn-group-sm" @if ($conf->stop_registration) checked @endif>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="user_id" class="col-md-4 control-label">Stop Registration</label>
                                <div class="col-md-6">
                                    <input type="checkbox" name="stop_register" data-group-cls="btn-group-sm" @if ($conf->stop_register) checked @endif>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="hide_error_log" class="col-md-4 control-label">Hide Error Log</label>
                                <div class="col-md-6">
                                    <input type="checkbox" name="hide_error_log" data-group-cls="btn-group-sm" @if ($conf->hide_error_log) checked @endif>
                                </div>
                            </div>

                            <div class="form-group">
                                <div align="center">
                                    <button type="submit" class="btn btn-success">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-7 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size:16px; font-weight: bold; color:#565656;">Change Password</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/change_password') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="current" class="col-md-4 control-label">Current Password</label>
                                <div class="col-md-6">
                                    <input id="current" type="password" class="form-control" name="current" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="new_pass" class="col-md-4 control-label">New Password</label>
                                <div class="col-md-6">
                                    <input id="new_pass" type="password" class="form-control" name="new_pass" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="confirm_pass" class="col-md-4 control-label">Confirm New Password</label>
                                <div class="col-md-6">
                                    <input id="confirm_pass" type="password" class="form-control" name="confirm_pass" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-5">
                                    <button type="submit" class="btn btn-danger">
                                        Change Passwrd
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection