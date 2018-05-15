<?php

namespace App\Http\Controllers;

use App\Buyer;
use App\Contract;
use App\Seller;
use App\User;
use Illuminate\Http\Request;
use JWTAuth;

use Web3\Web3;
use Web3\Providers\HttpProvider;
use Web3\RequestManagers\HttpRequestManager;
use Web3\Eth;


class ContractController extends Controller
{
    public function store() {
//        $file = isset(request()->file) ? request()->file : null;
//        $sellers = isset(request()->sellers) ? request()->sellers : null;
//        $buyers = isset(request()->buyers) ? request()->buyers : null;
//        $user = User::user();

//        $contract = new Contract;
//        $contract->file = $file;

        $eth = new Eth('http://bchxee-dns-reg1.westeurope.cloudapp.azure.com:8545');
        $eth->accounts(function ($err, $accounts) use ($eth) {
            if ($err !== null) {
                return response()->json(['error' => $err->getMessage()], 401);
            }
            $fromAccount = $accounts[0];
            // get balance
            $eth->getBalance($fromAccount, function ($err, $balance) use ($fromAccount) {
                if ($err !== null) {
                    return response()->json(['error' => $err->getMessage()], 401);
                }

                return response()->json(['account' => $fromAccount, 'balance' => $balance], 200);
            });
        });

        return response()->json(['result' => $eth], 200);
    }
}
