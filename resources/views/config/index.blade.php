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
                            <div class="form-group">
                                <label for="user_id" class="col-md-4 control-label">Stop Registration</label>
                                <div class="col-md-6">
                                    <input type="checkbox" name="stop_register" data-group-cls="btn-group-sm" @if ($conf->stop_register) checked @endif>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="user_id" class="col-md-4 control-label">Turn Bot Off</label>
                                <div class="col-md-6">
                                    <input type="checkbox" class="green" name="turn_off" id="turn_off" data-group-cls="btn-group-sm" @if ($conf->turn_off) checked @endif>
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