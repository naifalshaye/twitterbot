@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="height: 45px; padding-top:1px;">
                    <div class="row">
                        <div class="btn btn-sm pull-left" style="font-size:16px; font-weight: bold; color:#565656; margin-top:4px;">FAQ</div>
                        <div class="btn btn-sm pull-right"><a href="/faq/create" class="btn btn-success btn-sm"><span class="fa fa-plus"> Add FAQ</span></a></div>
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
                    <div class="row">
                        <div class="col-lg-12 table-responsive">
                            <table id="example" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered hover">
                                <thead>
                                <tr>
                                    <th width="60">ID</th>
                                    <th>Keyword</th>
                                    <th>Reply</th>
                                    <th width="150">Status</th>
                                    <th width="200"></th>
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
                                                <div class="col-lg-2">
                                                    <a href="/faq/{{ $faq->id }}/edit" class="btn btn-primary btn-xs">Edit</a>
                                                </div>
                                                <div class="col-lg-2">
                                                    <form id="form1" class="form-horizontal" method="post" role="form" action="/faq/{{$faq->id}}">
                                                        {!! csrf_field() !!}
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="submit" value="Delete" class="btn btn-danger btn-xs" onclick="return confirm('Delete FAG are you sure?');">
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