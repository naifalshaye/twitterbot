@extends('layouts.app')
@section('content')
    <div class='row'>
        <div class="col-lg-6 col-lg-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Scheduled Tweet</div>
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
                        <form class="form-horizontal" method="post" role="form" action="{{ url('schedule/'.$schedule->id) }}">
                            <input type="hidden" name="_method" value="PUT">
                            <fieldset>
                            {!! csrf_field() !!}

                                <div class="form-group">
                                    <label for="date" class="col-md-4 control-label">Date</label>
                                    <div class="col-md-6">
                                        <input type="date" class="form-control" name="date" value="{{ $schedule->date }}" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="time" class="col-md-4 control-label">Time</label>
                                    <div class="col-md-6">
                                        <input type="time" class="form-control" name="time" value="{{ $schedule->time }}" required>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="text" class="col-md-4 control-label">Time</label>
                                    <div class="col-md-6">
                                        <textarea class="form-control" name="text" required>{{ $schedule->text}}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="disable" class="col-md-4 control-label">Disable</label>
                                    <div class="col-md-6">
                                        <input type="checkbox" class="form-control" name="disable" @if ($schedule->disable) checked @endif>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="add_role_btn"></label>
                                    <div class="col-md-4">
                                        <button name="btn" class="btn btn-primary" type="submit">Edit</button>
                                    </div>
                                </div>

                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection