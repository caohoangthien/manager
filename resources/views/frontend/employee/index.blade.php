@extends('frontend.layouts.master')
@php($i = $employees->firstItem())

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Danh sách nhân viên</h3>

                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover table-custom">
                        <tr>
                            <th>Stt</th>
                            <th>Tên</th>
                            <th>Giới tính</th>
                            <th>Ngày sinh</th>
                            <th>Số điện thoại</th>
                            <th>Tài khoản ngân hàng</th>
                            <th>Ngày bắt đầu</th>
                            <th>Ngày tạo</th>
                            <th></th>
                        </tr>
                        @foreach($employees as $key => $emp)
                        <tr>
                            <td>{!! $i++ !!}</td>
                            <td>{{ $emp->name }}</td>
                            <td>{{ $emp->gender }}</td>
                            <td>{{ $emp->birthday }}</td>
                            <td>{{ $emp->phone }}</td>
                            <td>{{ $emp->bank_account }}</td>
                            <td>{{ $emp->start_time }}</td>
                            <td>{{ $emp->created_at }}</td>
                            <td class="text-center">
                                <a href="#" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                                <a href="#" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="#" class='btn btn-danger btn-xs'><i class="glyphicon glyphicon-trash"></i></a>
                            </td>
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