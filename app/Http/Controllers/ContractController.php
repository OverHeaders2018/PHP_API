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

        $web3 = new Web3(new HttpProvider(new HttpRequestManager('http://bchxee-dns-reg1.westeurope.cloudapp.azure.com:8545')));

        $web3->eth->dummy('koko', function($result, $error) {
            return response()->json(['result' => $result, 'error' => $error], 200);
        });

//        return response()->json(['result' => $contract], 200);
    }
}
