@extends('frontend.layouts.master')
@php($i = $employees->firstItem())

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Bảng lương nhân viên tháng {!! $month !!}</h3>

                    <div class="box-tools">
                        <form action="{!! route('luong-nhan-vien.show') !!}" method="get">
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
                    <table class="table table-hover table-custom">
                        <tr>
                            <th>Stt</th>
                            <th>Tên</th>
                            <th>Tháng</th>
                            <th>Lương</th>
                            <th>Thưởng</th>
                            <th>Ngày làm việc</th>
                            <th>Ngày vắng</th>
                            <th>Ngày phép đã dùng</th>
                            <th>Ngày phép còn lại</th>
                            <th>Ngày tính lương</th>
                            <th>Lương thực nhận</th>
                        </tr>
                        @foreach($employees as $employee)
                            <tr>
                                <td>{!! $i++ !!}</td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->salaries['month'] }}</td>
                                <td>{{ number_format($employee->salaries['salary']) }}</td>
                                <td>{{ number_format($employee->salaries['bonus']) }}</td>
                                <td>{{ $employee->salaries['day_work'] }}</td>
                                <td>{{ $employee->salaries['day_off'] }}</td>
                                <td>{{ $employee->salaries['day_off_available_used'] }}</td>
                                <td>{{ $employee->salaries['day_off_available'] }}</td>
                                <td>{{ $employee->salaries['day_salary'] }}</td>
                                <td>{{ number_format(8500000) }}</td>
                            </tr>
                        @endforeach
                    </table>
                    <div class="pagination-right">
                        {{ $employees->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection