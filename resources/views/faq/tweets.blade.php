@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading bg-light">
                    <div><strong>FAQ Tweets</strong></div>
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
                        @foreach($tweets as $tweet)
                            {{$tweet}}
                        @endforeach
                        <div align="center">{{$tweets->render()}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection