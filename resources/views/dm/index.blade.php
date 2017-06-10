@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading bg-light">
                    <div style="font-size:16px; font-weight: bold; color:#565656;">Direct Message On Follow Log</div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 table-responsive">
                            <table id="example" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered hover">
                                <thead>
                                <tr>
                                    <th style="text-align: center; width:180px;">User Name</th>
                                    <th style="text-align: center; width:170px;">Name</th>
                                    <th style="text-align: center; width:400px;">Msg</th>
                                    <th style="text-align: center; width:100px;">Sent</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($dm as $row)
                                    <tr>
                                        <td style="text-align: center;"><a href="http://twitter.com/{{ $row->screen_name }}" target="_blank">{{ $row->screen_name }}</a></td>
                                        <td style="text-align: center;">{{ $row->name }}</td>
                                        <td style="text-align: center;">{{ $row->msg }}</td>
                                        <td>
                                            @if ($row->sent == true)
                                                <span class="label label-success" style="font-size:12px;">Success</span>
                                            @else
                                                <span class="label label-danger" style="font-size:12px;">Fail</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        <div align="center">{{$dm->render()}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection