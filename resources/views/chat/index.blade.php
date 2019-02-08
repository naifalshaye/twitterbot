@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading" style="height: 45px; padding-top:1px;">
                    <div class="row">
                        <div class="btn btn-sm pull-left" style="font-size:16px; font-weight: bold; color:#565656; margin-top:4px;">Chat</div>
                        <div class="btn btn-sm pull-right"><a href="{{url('chat/create')}}" class="btn btn-success btn-sm"><span class="fa fa-plus"> Add Chat keyword</span></a></div>
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
                    <div align="center" class="alert alert-info">Add a keyword or a phrase that you want to reply to and interact with.</div>
                    <div class="row">
                        <div class="col-lg-12 table-responsive">
                            <table id="example" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered hover">
                                <thead>
                                <tr>
                                    <th width="60">ID</th>
                                    <th width="190">Keyword</th>
                                    <th>Reply</th>
                                    <th width="150">Status</th>
                                    <th width="140">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($chat as $row)
                                    <tr>
                                        <td>{{ $row->id }}</td>
                                        <td>{{ $row->keyword }}</td>
                                        <td>{{ $row->reply }}</td>
                                        <td>
                                            @if ($row->disable == false)
                                                <a href="{{ url('chat/status/'.$row->id) }}"><span class="label label-success" style="font-size:12px;">Enabled</span></a>
                                            @else
                                                <a href="{{url('chat/status/'.$row->id) }}"><span class="label label-danger" style="font-size:12px;">Disabled</span></a>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-lg-5">
                                                    <a href="{{ url('chat/'. $row->id )}}/edit" class="btn btn-primary btn-xs">Edit</a>
                                                </div>
                                                <div class="col-lg-3">
                                                    <form id="form1" class="form-horizontal" method="post" role="form" action="{{ url('chat/'.$row->id) }}">
                                                        {!! csrf_field() !!}
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="submit" value="Delete" class="btn btn-danger btn-xs" onclick="return confirm('Delete chat keyword are you sure?');">
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div align="center">{{$chat->render()}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection