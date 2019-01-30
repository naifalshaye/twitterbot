@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size:16px; font-weight: bold; color:#565656;">Bot Configuration</div>
                    <div class="panel-body">
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
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/conf') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="user_id" class="col-md-4 control-label">Stop Registration</label>
                                <div class="col-md-6">
                                    <input type="checkbox" name="stop_register" id="stop_register" @if ($conf->stop_register) checked @endif>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="user_id" class="col-md-4 control-label">Turn Bot Off</label>
                                <div class="col-md-6">
                                    <input type="checkbox" name="turn_off" id="turn_off" @if ($conf->turn_off) checked @endif>
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