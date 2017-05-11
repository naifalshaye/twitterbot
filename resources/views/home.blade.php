@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
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
        </div>
    </div>
</div>
@endsection
