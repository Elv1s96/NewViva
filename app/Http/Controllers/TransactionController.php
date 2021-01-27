<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Services\ExchangeRates;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $user = Auth::user();
        $user_currency = $user->currency;
        $exchange_rates_array = ExchangeRates::getExchangeRates($user_currency);
        return view('transaction.index', [
            'currency' => $exchange_rates_array
        ]);
    }

    public function addMoney(TransactionRequest $request, User $user)
    {
        $money_count = $user->money_count;
        if ($money_count > 0) {
            $exchange_rates_array = ExchangeRates::getExchangeRates($user->currency);
            $user->money_count = $money_count + $request->money_count * round($exchange_rates_array[$request->currency]);
        } else {
            $user->currency = $request->currency;
            $user->money_count = $request->money_count;
        }
        $user->update();
        return redirect()->back()->withSuccess('Деньги добавлены на счет!');
    }

    public function convertAndOutput(TransactionRequest $request, User $user)
    {
        if ($request->money_count > $user->money_count) {
            return redirect()->route('home')->with('warning', 'Вы пытаетесь конвертировать больше денег чем у вас есть');
        }
        $exchange_rates_array = ExchangeRates::getExchangeRates($user->currency);
        $rest_of_money = $user->money_count - $request->money_count;
        $user->money_count = $rest_of_money;
        $user->update();
        $transactions = Transaction::create([
            'user_id' => $user->id,
            'money_count' => $request->money_count,
            'currency_from' => $user->currency,
            'currency_to' => $request->currency,
            'money_count_after_conversion' => $request->money_count * round($exchange_rates_array[$request->currency], 2)
        ]);
        return redirect()->back()->withSuccess('Деньги конвертированы и отправлены на Ваш счет');
    }
}
