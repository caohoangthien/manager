@extends('frontend.layouts.master')
@php($i = 1)

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Bảng chấm công nhân viên</h3>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover table-custom">
                        <tr>
                            <th>Stt</th>
                            <th>Name</th>
                            @foreach($days as $day)
                            <th>{!! $day !!}</th>
                            @endforeach
                            <th>Ngày vắng</th>
                        </tr>
                        @foreach($logWork as $key => $logwork)
                        <tr>
                            <td>{!! $i++ !!}</td>
                            <td>{!! $key !!}</td>
                            @foreach($logwork as $lw)
                                <td>{!! $lw == 1 ? "X" : "V" !!}</td>
                            @endforeach
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection