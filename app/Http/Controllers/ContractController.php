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
use GuzzleHttp\Promise\Promise;



class ContractController extends Controller
{
    public function store() {
//        $file = isset(request()->file) ? request()->file : null;
//        $sellers = isset(request()->sellers) ? request()->sellers : null;
//        $buyers = isset(request()->buyers) ? request()->buyers : null;
//        $user = User::user();

//        $contract = new Contract;
//        $contract->file = $file;
        $web3 = new Web3('http://bchxee-dns-reg1.westeurope.cloudapp.azure.com:8545');
        $eth = $web3->getEth();

        $promise = new Promise(function () use (&$promise, $eth) {
            $eth->accounts(function ($err, $accounts) use ($eth, &$promise) {
                if ($err !== null) {
                    return response()->json(['error' => $err->getMessage()], 401);
                }
                $fromAccount = $accounts[0];
                // get balance
                $eth->getBalance($fromAccount, function ($err, $balance) use ($fromAccount, &$promise) {
                    if ($err !== null) {

                        return response()->json(['error' => $err->getMessage()], 401);
                    }

                    $promise->resolve(['account' => $fromAccount, 'balance' => $balance]);
                });
            });
        });

// Calling wait will return the value of the promise.
        return response()->json($promise->wait(), 200);
    }
}
