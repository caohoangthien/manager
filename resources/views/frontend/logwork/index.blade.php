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
                    <table class="table-log-work">
                        <tr>
                            <th>Stt</th>
                            <th>Name</th>
                            @foreach($days as $day)
                            <th>{!! sprintf("%02d", $day) !!}</th>
                            @endforeach
                            <th>Ngày làm việc</th>
                            <th>Ngày vắng</th>
                        </tr>
                        @foreach($logWork as $key => $logwork)
                        @php
                            $dayWork = 0;
                            $dayOff = 0;
                        @endphp
                        <tr>
                            <td>{!! $i++ !!}</td>
                            <td>{!! $key !!}</td>
                            @foreach($logwork as $lw)
                                @php
                                    $dayNull = count($days) - count($logwork);
                                    $dayWork = ($lw == 1) ? $dayWork + 1 : $dayWork;
                                    $dayOff = ($lw == 2) ? $dayOff + 1 : $dayOff;
                                @endphp
                                <td class="text-center {!! $lw == 1 ? '' : 'bg-red' !!}">{!! $lw == 1 ? "X" : "V" !!}</td>
                            @endforeach
                            @for($j = 1; $j <= $dayNull; $j++)
                                <td></td>
                            @endfor
                            <td>{!! $dayWork !!}</td>
                            <td>{!! $dayOff !!}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection