<?php

/**
 * Simple PHP class to add new card to Trello
 * 
 * @author Mehrdad Nassiri <mehrdad@nassiri.com>
 */
class Trello {
	/**
	 * @var string Key
	 */
	private $key;
	
	/**
	 * @var string Token
	 */
	private $token;

	/**
	 * @var string List Id
	 */
	private $list_id;

	/**
	 * Set your key
	 * 
	 * @link https://trello.com/app-key
	 */
	public function setKey($string) {
		$this->key = $string;
	}

	/**
	 * Set your token
	 * 
	 * @link https://trello.com/app-key
	 */
	public function setToken($string) {
		$this->token = $string;
	}

	/**
	 * Find your list id like this:
	 * 
	 * @link https://trello.com/b/[your-list-id]/reports.json
	 */
	public function setListId($string) {
		$this->list_id = $string;
	}

	/**
	 * Standard options of adding new card
	 * 
	 * @link https://developer.atlassian.com/cloud/trello/rest/api-group-cards
	 * @return string|array
	 */
	public function addCard($opts) {
		$ch = curl_init("https://api.trello.com/1/cards");
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array_merge($opts, [
			'key' => $this->key,
			'token' => $this->token,
			'idList' => $this->list_id,
		])));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
		$result = curl_exec($ch);
		curl_close($ch);

		return $result[0] == '{' ? json_decode($result, true) : $result;
	}
}
