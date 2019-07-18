@extends('frontend.layouts.master')
@php($i = $transactions->firstItem())

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Danh sách giao dịch</h3>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover table-custom">
                        <tr>
                            <th>Stt</th>
                            <th>Số tiền</th>
                            <th>Trạng thái</th>
                            <th>Mục đích</th>
                            <th>Ghi chú</th>
                            <th>Người thực hiện</th>
                            <th>Ngày</th>
                            <th>Ngày tạo</th>
                            <th></th>
                        </tr>
                        @foreach($transactions as $transaction)
                            <tr>
                                <td>{!! $i++ !!}</td>
                                <td>{{ $transaction->money }}</td>
                                <td>{{ $transaction->status }}</td>
                                <td>{{ $transaction->reason }}</td>
                                <td>{{ $transaction->note }}</td>
                                <td>{{ $transaction->causer }}</td>
                                <td>{{ $transaction->date }}</td>
                                <td>{{ $transaction->created_at }}</td>
                                <td class="text-center">
                                    <a href="#" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                                    <a href="#" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                                    <a href="#" class='btn btn-danger btn-xs'><i class="glyphicon glyphicon-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <div class="pagination-right">
                        {{ $transactions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection