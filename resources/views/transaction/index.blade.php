@extends('layouts.app')

@section('title', 'Валютные операции')


@section('content')
    <div class="card">
        <div class="card-header">
            Добавить деньги
        </div>
        <div class="card-body">
            <form action="{{ route('add-money', Auth::user()->id) }}" method="POST" >
                @method('PUT')
                @csrf
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputCity">Сумма денег</label>
                            <input type="text" class="form-control" id="money_count" name="money_count">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputState">State</label>
                            <select id="currency" name="currency" class="form-control">
                                @foreach($currency as $key => $value)
                                    <option value="{{$key}}">{{$key}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            Обмен валют
        </div>
        <div class="card-body">
            <form action="{{ route('convert-and-output', Auth::user()->id) }}" method="POST" >
                @method('PUT')
                @csrf
                <div class="card-body">
                    <h5 class="card-title">Сейчас в наличии {{ Auth::user()->money_count }} {{ Auth::user()->currency }}</h5>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputCity">Конвертировать и вывести. </label>
                            <input type="text" class="form-control" id="money_count" name="money_count" >
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputState">State</label>
                            <select id="currency" name="currency" class="form-control">
                                @foreach($currency as $key => $value)
                                    <option value="{{$key}}">{{$key}} {{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Конвертировать и вывести</button>
                </div>
            </form>
        </div>
    </div>

@endsection
