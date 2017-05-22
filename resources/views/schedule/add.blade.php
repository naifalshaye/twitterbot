@extends('layouts.app')
@section('content')
    <div class='row'>
        <div class="col-lg-4 col-lg-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">Add Keyword</div>
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
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/schedule') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="date" class="col-md-4 control-label">Date</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="date" value="{{ old('date') }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="time" class="col-md-4 control-label">Time</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="time" value="{{ old('time') }}" required>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="text" class="col-md-4 control-label">Tweet Text</label>
                            <div class="col-md-6">
                                <textarea class="form-control" name="text" oninput="countChar(this.value);" required rows="5">{{ old('text') }}</textarea>
                                <div style="color:darkred;" id="tweet_length"></div>
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
<script>
    function countChar(val) {
        var left = 140 - val.length;
        document.getElementById('tweet_length').innerHTML = left;

    }
    $(document).ready(function(){
        $('#time').timepicker({
            showInputs: false
        });
    });

</script>
@endsection