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
        $file = isset(request()->file) ? request()->file : null;
        $sellers = isset(request()->sellers) ? request()->sellers : null;
        $buyers = isset(request()->buyers) ? request()->buyers : null;
        $user = User::user();

        $abi = config('constants.abi');
        $contractAddress = config('constants.contract-address');
        $contract = new Contract(config('constants.app-uri'), $abi);
        $fromAccount = '0x732A6E65688d39cd031A97508C1AF14570149001';

        $sellers_users = User::getUsersByPhones($sellers);
        $buyers_users = User::getUsersByPhones($buyers);

        $s_ids = array_map(function($user) {
            return $user->id;
        }, $sellers_users);

        $b_ids = array_map(function($user) {
            return $user->id;
        }, $buyers_users);
        $start = strtotime(date('Y-m-d H:i:s'));
        $end = $start + 12000;
        $promise = new Promise(function () use (&$promise, $contract, $contractAddress, $fromAccount, $user, $s_ids, $b_ids, $file, $start, $end) {
//            // get balance
            $contract->at($contractAddress)->call('add_transaction', $user->id, $s_ids, $b_ids, $start, $end, $file, [
                'from' => $fromAccount
            ], function($err, $balance) use (&$promise) {
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

        $fromAccount = '0x732A6E65688d39cd031A97508C1AF14570149001';



        $promise = new Promise(function () use (&$promise, $eth, $fromAccount) {
//            // get balance
            $blocks = [];
            for ($i = 0; $i < 1000; $i++) {
                $p = new Promise(function () use (&$p, $eth, $i, $fromAccount) {
                    $eth->call('eth_getBlockByNumber', $i, true, [
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
