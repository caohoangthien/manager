@extends('frontend.layouts.master')
@php($i = 1)

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Báo cáo theo ngày</h3>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover table-custom">
                        <tr>
                            <th>Stt</th>
                            <th>Ngày</th>
                            <th>Thu</th>
                            <th>Chi</th>
                            <th>Doanh thu</th>
                        </tr>
                        @foreach($transactions as $transaction)
                            <tr>
                                <td>{!! $i++ !!}</td>
                                <td>{{ $transaction['date'] }}</td>
                                <td>{{ $transaction['money_in'] }}</td>
                                <td>{{ $transaction['money_out'] }}</td>
                                <td>{{ $transaction['interest'] }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection