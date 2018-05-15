<?php

namespace App\Transformers;

use App\Contract;
use League\Fractal\TransformerAbstract;

class ContractTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'sellers', 'buyers'
    ];
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Contract $contract)
    {
        return [
            'id' => $contract->id,
            'owner' => fractal($contract->user_id, new UserTransformer),
            'file' => $contract->file
        ];
    }

    public function includeBuyers(Contract $contract) {
        return $this->collection($contract->buyers()->get(), new UserTransformer);
    }

    public function includeSellers(Contract $contract) {
        return $this->collection($contract->sellers()->get(), new UserTransformer);
    }
}
