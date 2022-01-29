<?php

include "Trello.php";

// Setup
$trello = new Trello;
$trello->setKey('my_key');
$trello->setToken('my_token');
$trello->setListId('my_list_id');

// Add new card
$result = $trello->addCard([
	'name' => 'Test',
	'desc' => 'This is a description!',
	'urlSource' => 'https://vandaw.com'
]);

print_r($result);
