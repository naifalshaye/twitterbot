@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading bg-light">
                    <h2>FAQ</h2>
                    <a href="/faq/create" class="btn btn-success"><span class="fa fa-plus"> Add New FAQ</span></a>
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
                        <div class="col-lg-12 table-responsive">
                            <table id="example" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Keyword</th>
                                    <th>Reply</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($faqs as $faq)
                                    <tr>
                                        <td>{{ $faq->id }}</td>
                                        <td>{{ $faq->keyword }}</td>
                                        <td>{{ $faq->reply }}</td>
                                        <td>
                                            @if ($faq->disable == false)
                                                <a href="/faq/status/{{$faq->id}}"><span class="label label-success" style="font-size:12px;">Enabled</span></a>
                                            @else
                                                <a href="/faq/status/{{$faq->id}}"><span class="label label-danger" style="font-size:12px;">Disabled</span></a>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-xs-2">
                                                    <a href="/faq/{{ $faq->id }}/edit" class="btn btn-primary btn-sm">Edit</a>
                                                </div>
                                                <div class="col-xs-2">
                                                    <form id="form1" class="form-horizontal" method="post" role="form" action="/faq/{{$faq->id}}">
                                                        {!! csrf_field() !!}
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="submit" value="Delete" class="btn btn-danger btn-sm" onclick="return confirm('Delete FAG are you sure?');">
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div align="center">{{$faqs->render()}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection