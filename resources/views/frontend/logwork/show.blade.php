@extends('frontend.layouts.master')

@php($i = 1)

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Bảng chấm công nhân viên tháng {!! $month !!}</h3>
                    <div class="box-tools">
                        <form action="{!! route('cham-cong.show') !!}" method="get">
                        <div class="form-group" style="width: 170px;">
                            <div class="input-group">
                                <select class="form-control select2" name="time" style="width: 100%;">
                                    <option>Chọn tháng</option>
                                    @foreach($months as $month)
                                        <option value="{!! $month->month !!}-{!! $month->year !!}">{!! $month->text !!}</option>
                                    @endforeach
                                </select>

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-primary">Xem</button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table-log-work table-hover">
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
                        <tr>
                            <td>{!! $i++ !!}</td>
                            <td>{!! $key !!}</td>
                            @php
                                $dayWork = 0;
                                $dayOff = 0;
                            @endphp
                            @foreach($days as $day)
                                @if(array_key_exists($day, $logwork))
                                <td class="text-center {!! $logwork[$day] == 1 ? '' : 'bg-green' !!}">{!! $logwork[$day] == 1 ? "X" : "V" !!}</td>
                                @php
                                    $logwork[$day] == 1 ? $dayWork++ : $dayWork;
                                    $logwork[$day] == 2 ? $dayOff++ : $dayOff;
                                @endphp
                                @else
                                <td></td>
                                @endif
                            @endforeach
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