<?php

namespace App\Http\Controllers;

use App\Models\CashAccountModel;
use App\Models\ClientModel;
use App\Models\User;
use App\Models\WasityAccountModel;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class WasityAccountController extends Controller
{
    public function changeBalance(Request $request)
    {
      
      
            $account =  CashAccountModel::where('userId', $request->userId)->first();
            $account->balance += $request->balance;
            $account->save();
            return response()->json([], 200);
        
        return response()->json([], 500);
    }

    public function getAccount(Request $request)
    {
     
      
            $account =  CashAccountModel::where('userId', $request->userId)->first();
            return response()->json($account, 200);
        
        return response()->json([], 500);
    }

    public function getUsers()
    {
        $users = User::all();
        if ($users) {

            return response()->json($users, 200);
        }
        return response()->json([], 500);
    }
}
