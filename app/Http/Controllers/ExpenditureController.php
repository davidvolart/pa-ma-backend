<?php

namespace App\Http\Controllers;

use App\Child;
use App\Expenditure;
use App\Http\Requests\ExpeditureRequest;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenditureController extends Controller
{
    public function listExpenses(Request $request)
    {
        $child_id = $request->user()->children_id;
        if ($child_id == null) {
            return response()->json(['message' => 'User has not registered a child yet.', "child" => null], 400);
        }
        $child = Child::find($child_id);
        return response()->json(['message' => 'List of expenses for child.', "expenses" => $child->expenses()->get()], 200);
    }

    public function listExpensesByMonth(Request $request, $year, $month)
    {
        $user_id = $request->user()->id;
        $partner_id = User::where('email', $request->user()->partner_email)->first()->id;

        $expenses_user1 = $this->getExpensesByUserAndDate($user_id, $year, $month+1);
        $expenses_partner = $this->getExpensesByUserAndDate($partner_id, $year, $month+1);

        if ($expenses_user1 > 0 || $expenses_partner > 0) {
            $user1_percentage = ($expenses_user1 / ($expenses_user1 + $expenses_partner)) * 100;
            $partner_percentage = 100 - $user1_percentage;
        } else {
            $partner_percentage = 50;
            $user1_percentage = 50;
        }

        return response()->json(['message'  => 'Expenses by date for family users.',
                                 "expenses" => [
                                     User::find($user_id)->name    => [
                                         'value'      => $expenses_user1,
                                         'percentage' => $user1_percentage,
                                     ],
                                     User::find($partner_id)->name => [
                                         'value'      => $expenses_partner,
                                         'percentage' => $partner_percentage,
                                     ]
                                 ]
                                ], 200);
    }

    public function storeExpenditure(ExpeditureRequest $request)
    {
        $child_id = Auth::user()->children_id;
        if ($child_id == null) {
            return response()->json(['message' => 'User has not registered a child yet.', "child" => null], 400);
        }

        $expenditure = Expenditure::findOrNew(request("id"));
        $expenditure->child_id = $child_id;
        $expenditure->name = request('name');
        $expenditure->price = request('price');
        $expenditure->user_id = Auth::user()->id;
        $expenditure->color = Auth::user()->color;

        if ($expenditure_description = request('description')) {
            $expenditure->description = $expenditure_description;
        }

        if ($date_value = $this->getDateInUniversalFormat(request('date'))) {
            $expenditure->date = $date_value;
            $expenditure->save();
            return response()->json(['message' => 'Expediture stored correctly', "expediture" => Expenditure::find($expenditure->id)], 201);
        }

        return response()->json(['message' => 'Field date must be a correct date format.'], 400);
    }

    public function deleteExpenditurep($id)
    {
        try {
            $task = Expenditure::findOrFail($id);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Expenditure id does not exist'], 400);
        }
        $task->delete();
        return response()->json(['message' => 'Expenditure deleted correctly'], 200);
    }

    private function getExpensesByUserAndDate($user_id, $year, $month)
    {
        return Expenditure::where([
                                      ['user_id', $user_id],
                                      ['date', '>=', $year . '-' . $month . '-01'],
                                      ['date', '<=', $year . '-' . $month . '-31'],
                                  ])->sum('price');
    }

    private function getDateInUniversalFormat($expediture_date)
    {
        try {
            $date = explode('/', $expediture_date);
            $date_value = Carbon::createFromDate($date[2], $date[1], $date[0], 'Europe/Madrid');
            return $date_value;
        } catch (\Exception $e) {
            return null;
        }
    }
}
