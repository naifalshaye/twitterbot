@extends('layouts.app')
@section('content')
    <div class='row'>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Category</div>
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
                        <form class="form-horizontal" method="post" role="form" action="/faq/{{$faq->id}}">
                            <input type="hidden" name="_method" value="PUT">
                            <fieldset>
                            {!! csrf_field() !!}

                                <div class="form-group">
                                    <label for="keyword" class="col-md-4 control-label">Keyword</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="keyword" value="{{ $faq->keyword }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="reply" class="col-md-4 control-label">Reply</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="reply" value="{{ $faq->reply }}">
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