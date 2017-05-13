@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (!$conf_exist)
                        <a href="/twitter" class="btn btn-primary">Login via Twitter</a>
                    @else
                        welcome {{$conf->name}}
                    @endif
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading" style="font-size:16px; font-weight: bold;">Running Processes
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

                <div class="panel-body">
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
@endsection
