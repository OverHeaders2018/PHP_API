<?php

namespace App\Http\Controllers;

use App\Buyer;
use App\Seller;
use App\User;
use Illuminate\Http\Request;
use JWTAuth;

use Web3\Web3;
use Web3\Providers\HttpProvider;
use Web3\RequestManagers\HttpRequestManager;
use Web3\Eth;
use GuzzleHttp\Promise\Promise;
use Web3\Contract;


class ContractController extends Controller
{
    public function store()
    {
        $file = isset(request()['file']) ? request()['file'] : null;
        $sellers = isset(request()['sellers']) ? request()['sellers'] : null;
        $buyers = isset(request()->buyers) ? request()->buyers : null;
        $user = User::user();

        $abi = config('constants.abi');
        $contractAddress = config('constants.contract-address');
        $contract = new Contract(config('constants.app-uri'), $abi);
        $fromAccount = '0xd3305c9815a00a7b5c93ee82954c23f79bd5607a';

        return response()->json(['a' => $sellers, 'b' => $buyers], 200);
        $sellers_users = User::getUsersByPhones($sellers);
        $buyers_users = User::getUsersByPhones($buyers);

        $s_ids = array_map(function($user) {
            return $user->id;
        }, $sellers_users);

        $b_ids = array_map(function($user) {
            return $user->id;
        }, $buyers_users);

        $promise = new Promise(function () use (&$promise, &$contract, &$contractAddress, &$fromAccount, $user, $s_ids, $b_ids, $file) {
//            // get balance
            $start = strtotime(date('Y-m-d H:i:s'));
            $end = $start + 12000;
            $contract->at($contractAddress)->call('add_transaction', $user->id, $s_ids, $b_ids, $start, $end, $file,function($err, $balance) use (&$promise) {
                if ($err !== null) {
                    return response()->json(['error' => $err->getMessage()], 401);
                }

                $promise->resolve(['balance' => $balance, 'error' => $err]);
            });
        });

// Calling wait will return the value of the promise.
        return response()->json($promise->wait(), 200);
    }

    public function dummy()
    {
        $abi = config('constants.abi');
        $contractAddress = config('constants.contract-address');

        $contract = new Contract(config('constants.app-uri'), $abi);
        $fromAccount = '0x82c0ce8a0562f8cd551d4e940afe8efa1dbe00ab';


        $promise = new Promise(function () use (&$promise, &$contract, &$contractAddress, &$fromAccount) {
//            // get balance
            $contract->at($contractAddress)->call('dummy', 'koko',function($err, $balance) use (&$promise) {
                if ($err !== null) {
                    return response()->json(['error' => $err->getMessage()], 401);
                }

                $promise->resolve(['balance' => $balance, 'error' => $err]);
            });
        });

// Calling wait will return the value of the promise.
        return response()->json($promise->wait(), 200);
    }

    public function index() {
        $abi = config('constants.abi');
        $contractAddress = config('constants.contract-address');

        $web3 = new Web3(config('constants.app-uri'));
        $eth = $web3->getEth();

        $fromAccount = '0xd3305c9815a00a7b5c93ee82954c23f79bd5607a';



        $promise = new Promise(function () use (&$promise, $eth, $fromAccount) {
//            // get balance
            $blocks = [];
            for ($i = 0; $i < 1000; $i++) {
                $p = new Promise(function () use (&$p, $eth, $i, $fromAccount) {
                    $eth->call('eth_getBlockByNumber', $i, [
                        'from' => $fromAccount
                    ], function($err, $result) use ($p) {
                        if (!$err) {
                            $p->resolve($result);
                        }
                    });
                });

                $blocks[] = $p->wait();
            }

            $promise->resolve($blocks);
        });

        return response()->json($promise->wait(), 200);
    }

}
