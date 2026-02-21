<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        return view('test.index');
    }

    public function submit(Request $request)
    {
        // Проста логіка підрахунку балів
        $score = 0;
        foreach ($request->except('_token') as $answer) {
            $score += (int)$answer;
        }

        // Інтерпретація результату (з підтримкою перекладу)
        if ($score <= 2) {
            $result = __('У вас нормальний емоційний стан.');
            $recommendation = __('Продовжуйте піклуватися про себе та підтримувати баланс.');
            $color = 'green';
        } elseif ($score <= 5) {
            $result = __('Помірна тривожність.');
            $recommendation = __('Радимо звернути увагу на відпочинок та зменшити стрес.');
            $color = 'yellow';
        } else {
            $result = __('Високий рівень тривожності.');
            $recommendation = __('Рекомендуємо звернутися до спеціаліста (психолога) для консультації.');
            $color = 'red';
        }

        return view('test.result', compact('score', 'result', 'recommendation', 'color'));
    }
}