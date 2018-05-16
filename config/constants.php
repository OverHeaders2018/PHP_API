<?php
/**
 * Created by PhpStorm.
 * User: uriahahrak
 * Date: 16/05/2018
 * Time: 2:13
 */

return [
    'abi' => '[
	{
		"constant": false,
		"inputs": [
			{
				"name": "ownerId",
				"type": "uint256"
			},
			{
				"name": "sellerIds",
				"type": "uint256[]"
			},
			{
				"name": "buyerIds",
				"type": "uint256[]"
			},
			{
				"name": "startTimeInMillis",
				"type": "uint256"
			},
			{
				"name": "endTimeInMillis",
				"type": "uint256"
			},
			{
				"name": "contractFileStr",
				"type": "string"
			}
		],
		"name": "add_transaction",
		"outputs": [],
		"payable": false,
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"constant": false,
		"inputs": [
			{
				"name": "uid",
				"type": "uint256"
			}
		],
		"name": "get_associated_contracts",
		"outputs": [
			{
				"components": [
					{
						"name": "contractId",
						"type": "uint256"
					},
					{
						"name": "ownerId",
						"type": "uint256"
					},
					{
						"name": "sellerIds",
						"type": "uint256[]"
					},
					{
						"name": "sellerSigned",
						"type": "bool[]"
					},
					{
						"name": "buyerIds",
						"type": "uint256[]"
					},
					{
						"name": "buyerSigned",
						"type": "bool[]"
					},
					{
						"name": "startTimeInMillis",
						"type": "uint256"
					},
					{
						"name": "endTimeInMillis",
						"type": "uint256"
					},
					{
						"name": "contractFileStr",
						"type": "string"
					}
				],
				"name": "",
				"type": "tuple[]"
			}
		],
		"payable": false,
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"constant": false,
		"inputs": [
			{
				"name": "userId",
				"type": "uint256"
			}
		],
		"name": "get_my_contracts",
		"outputs": [
			{
				"components": [
					{
						"name": "contractId",
						"type": "uint256"
					},
					{
						"name": "ownerId",
						"type": "uint256"
					},
					{
						"name": "sellerIds",
						"type": "uint256[]"
					},
					{
						"name": "sellerSigned",
						"type": "bool[]"
					},
					{
						"name": "buyerIds",
						"type": "uint256[]"
					},
					{
						"name": "buyerSigned",
						"type": "bool[]"
					},
					{
						"name": "startTimeInMillis",
						"type": "uint256"
					},
					{
						"name": "endTimeInMillis",
						"type": "uint256"
					},
					{
						"name": "contractFileStr",
						"type": "string"
					}
				],
				"name": "",
				"type": "tuple[]"
			}
		],
		"payable": false,
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"constant": false,
		"inputs": [
			{
				"name": "userId",
				"type": "uint256"
			},
			{
				"name": "contractId",
				"type": "uint256"
			}
		],
		"name": "sign_contract",
		"outputs": [],
		"payable": false,
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "dummy",
		"outputs": [
			{
				"name": "",
				"type": "string"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "pull_last_transaction",
		"outputs": [
			{
				"name": "",
				"type": "uint256"
			},
			{
				"name": "",
				"type": "uint256"
			},
			{
				"name": "",
				"type": "uint256[]"
			},
			{
				"name": "",
				"type": "bool[]"
			},
			{
				"name": "",
				"type": "uint256[]"
			},
			{
				"name": "",
				"type": "bool[]"
			},
			{
				"name": "",
				"type": "uint256"
			},
			{
				"name": "",
				"type": "uint256"
			},
			{
				"name": "",
				"type": "string"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	}
]',
    'app-uri' => 'http://localhost:8545',
    'contract-address' => '0x36a7ffaef0c2521232370927bfb5f880fff1d238',
];