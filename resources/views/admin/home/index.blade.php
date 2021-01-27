@extends('layouts.admin_app')

@section('title', 'Список пользователей')

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i>{{ session('error') }}</h4>
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Список транзакций</h3>

                    <div class="card-tools">

                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" >
                    <table class="table table-head-fixed text-nowrap">
                        <thead>
                        <tr>
                            <th>Пользователь</th>
                            <th>Сумма для конвертации</th>
                            <th>Конвертация</th>
                            <th>После конвертирования</th>
                            <th>Остаток на счету</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->user->name }}</td>
                                <td>{{ $transaction->money_count }}</td>
                                <td>{{ $transaction->currency_from }} ---> {{ $transaction->currency_to }}</td>
                                <td>{{ $transaction->money_count_after_conversion }}</td>
                                <td>{{ $transaction->user->money_count }} {{ $transaction->user->currency }}</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
