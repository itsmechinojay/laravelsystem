<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Model\EvaluationPeriod;
use App\Http\Model\Evaluation;
use Illuminate\Support\Facades\Auth;
use function GuzzleHttp\json_encode;

class EvaluationController extends Controller
{
    //
    public function index()
    {
        $lastdate = DB::table('evaluation_period')
            ->select('created_at')
            ->where('client_id', Auth::user()->id)
            ->latest('id')
            ->first();
        $evaluation = true;
        if ($lastdate) {
            if (date("m", strtotime($lastdate->created_at)) < date("m")) {
                $evaulation = true;
            } else {
                $evaluation = false;
            }
        }
        return view('evaluation', compact("evaluation"));
    }

    public function addEvalPeriod(Request $request)
    {
        $addEvalPeriod = EvaluationPeriod::create([
            'client_id' => Auth::user()->id
        ]);

        if ($addEvalPeriod) {
            $evalperiod_id = DB::table('evaluation_period')
                ->select('id')
                ->where('client_id', Auth::user()->id)
                ->latest('id')
                ->first();

            return json_encode([
                'result' => 'success',
                'evalperiod_id' => $evalperiod_id->id
            ]);
        }
    }

    public function checkEvaluationDate()
    {
        $lastdate = DB::table('evaluation_period')
            ->select('created_at')
            ->where('client_id', Auth::user()->id)
            ->latest('id')
            ->first();
        $evaluation = false;
        if ($lastdate) {
            if (date("m", strtotime($lastdate->created_at)) == date("m")) {
                return json_encode([
                    'result' => 'failed',
                    'message' => 'once a month'
                ]);
            }
        }
        return json_encode([
            'result' => 'success',
            'message' => 'evaluation start'
        ]);
    }

    public function evaluateEmployee(Request $request)
    {
        $evaluate = Evaluation::create([
            'evalperiod_id' => $request['evalperiod_id'],
            'emp_id' => $request['emp_id'],
            'rating' => $request['rating']
        ]);
        if ($evaluate) {
            return json_encode([
                'result' => 'success',
                'message' => 'Created...'
            ]);
        }
    }

    public function getAllEvaluation()
    {
        $evaluationlist = Evaluation::all();

        return json_encode([
            'result' => 'success',
            'notify' => $evaluationlist
        ]);
    }
}
