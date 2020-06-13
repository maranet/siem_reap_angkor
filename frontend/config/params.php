<?php
return [
    'adminEmail' => 'admin@example.com',
    'languages' => [
    	'lk' => 'sinhala',
    	'fr' => 'french',
    	'ru' => 'russian',
    	'hi' => 'hindi',
    	'en' => ' English (United States) ',
    ],
    'params' => [
	    'maskMoneyOptions' => [
	        'prefix' => 'US$ ',
	        'suffix' => ' c',
	        'affixesStay' => true,
	        'thousands' => ',',
	        'decimal' => '.',
	        'precision' => 2, 
	        'allowZero' => false,
	        'allowNegative' => false,
	    ]
	]
];
