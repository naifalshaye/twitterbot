@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading bg-light" style="height: 45px; padding-top:0px;">
                    <div class="row">
                        <div class="btn btn-sm pull-left" style="font-size:16px; font-weight: bold; color:#565656; margin-top:4px;">Keywords</div>
                        <div class="btn btn-sm pull-right"><a href="/keyword/create" class="btn btn-success btn-sm"><span class="fa fa-plus"> Add Keyword</span></a></div>
                    </div>
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
                    <div align="left" class="desc">Add keywords and replies that you want the bot to listen to. e.g Your company FAQs</div>

                    <div class="row">

                        <div class="col-lg-12 table-responsive">
                            <table id="example" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered hover">
                                <thead>
                                <tr>
                                    <th width="60">ID</th>
                                    <th width="200">Keyword</th>
                                    <th width="150">Status</th>
                                    <th width="130">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($keywords as $keyword)
                                    <tr>
                                        <td>{{ $keyword->id }}</td>
                                        <td>{{ $keyword->str }}</td>
                                        <td>
                                            @if ($keyword->disable == false)
                                                <a href="/keyword/status/{{$keyword->id}}"><span class="label label-success" style="font-size:12px;">Enabled</span></a>
                                            @else
                                                <a href="/keyword/status/{{$keyword->id}}"><span class="label label-danger" style="font-size:12px;">Disabled</span></a>
                                            @endif
                                        </td>
                                        <th>
                                            <div class="row">
                                                <div class="col-lg-5">
                                                    <a href="/keyword/{{ $keyword->id }}/edit" class="btn btn-primary btn-xs">Edit</a>
                                                </div>
                                                <div class="col-lg-2">
                                                    <form id="form1" class="form-horizontal" method="post" role="form" action="/keyword/{{$keyword->id}}">
                                                        {!! csrf_field() !!}
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="submit" value="Delete" class="btn btn-danger btn-xs" onclick="return confirm('Delete Keyword are you sure?');">
                                                    </form>
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div align="center">{{$keywords->render()}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection