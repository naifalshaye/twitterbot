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
                                    <input type="text" class="form-control" name="user_id" value="@if (isset($conf)) {{ $conf->user_id }}@endif" disabled>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('screen_name') ? ' has-error' : '' }}">
                                <label for="screen_name" class="col-md-4 control-label">User Name</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="screen_name" value="@if (isset($conf)) {{ $conf->screen_name }} @endif" disabled>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" value="@if (isset($conf)) {{ $conf->name }} @endif" disabled>
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