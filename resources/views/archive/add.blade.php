@extends('layouts.app')
@section('content')
    <div class='row'>
        <div class="col-lg-4 col-lg-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">Add Archive Keyword</div>
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
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/archive') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="str" class="col-md-4 control-label">Keyword</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="str" value="{{ old('str') }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="disable" class="col-md-4 control-label">Disable</label>
                            <div class="col-md-6">
                                <input type="checkbox" class="form-control" name="disable">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                     Add
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection