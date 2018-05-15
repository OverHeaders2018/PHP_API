<?php

namespace App\Http\Controllers;

use App\Buyer;
use App\Contract;
use App\Seller;
use App\User;
use Illuminate\Http\Request;
use JWTAuth;

class ContractController extends Controller
{
    public function store() {
        $file = isset(request()->file) ? request()->file : null;
        $sellers = isset(request()->sellers) ? request()->sellers : null;
        $buyers = isset(request()->buyers) ? request()->buyers : null;
        $user = User::user();

        $contract = new Contract;
        $contract->file = $file;

        $user->contracts()->save($contract);

        foreach ($sellers as $phone) {
            $u = User::where('phone', $phone)->first();
            $seller = Seller::create([
                'user_id' => $u->id
            ]);

            if ($seller) {
                $contract->sellers()->save($seller);
            }
        }

        foreach ($buyers as $phone) {
            $u = User::where('phone', $phone)->first();
            $buyer = Buyer::create([
                'user_id' => $u->id
            ]);

            if ($buyer) {
                $contract->sellers()->save($buyer);
            }
        }


        return response()->json(['result' => $contract], 200);
    }
}
