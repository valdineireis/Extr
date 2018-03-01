<?php

namespace Extr\Helpers;

class CsrfHelper
{
    /**
     * The token name.
     *
     * @var string
     */
    private const TOKEN_NAME = 'X-XSRF-TOKEN';

    /**
	 * Generate a token and write it to session
	 *
	 * @return void
	 */
    public static function generateToken()
	{
		// generate as random of a token as possible
		$salt = !empty($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : uniqid();
		$_SESSION[self::TOKEN_NAME] = sha1(uniqid(sha1($salt), true));
	}

	/**
	 * Get the token. If it's not defined, this will go ahead and generate one.
	 *
	 * @return string
	 */
	public static function getToken()
	{
		if (empty($_SESSION[self::TOKEN_NAME])) {
			static::generateToken(self::TOKEN_NAME);
		}
		return $_SESSION[self::TOKEN_NAME];
	}

	/**
	 * Get the token name.
	 *
	 * @return string
	 */
	public static function getTokenName()
	{
		return self::TOKEN_NAME;
	}

	/**
	 * Validate the token. If there's not one yet, it will set one and return false.
	 *
	 * @param array $requestData - your whole POST/GET array - will index in with the token name to get the token.
	 * @return bool
	 */
	public static function validate($requestData = array())
	{
		if (empty($_SESSION[self::TOKEN_NAME])) {
			static::generateToken();
			return false;
		} 

		if (empty($requestData[self::TOKEN_NAME])) {
			return false;
		} 

		if (static::compare($requestData[self::TOKEN_NAME], static::getToken())) {
			static::generateToken();
			return true;
		}

		return false;
	}

	/**
	 * Get a hidden input string with the token/token name in it.
	 *
	 * @return string
	 */
	public static function getHiddenInputString()
	{
		return sprintf('<input type="hidden" name="%s" value="%s"/>', self::TOKEN_NAME, static::getToken());
	}

	/**
	 * Constant-time string comparison. This comparison function is timing-attack safe
	 *
	 * @param string $hasha
	 * @param string $hashb
	 * @return bool
	 */
	public static function compare($hasha = "", $hashb = "")
	{
		// we want hashes_are_not_equal to be false by the end of this if the strings are identical

		// if the strings are NOT equal length this will return true, else false
		$hashes_are_not_equal = strlen($hasha) ^ strlen($hashb);

		// compare the shortest of the two strings (the above line will still kick back a failure if the lengths weren't equal) this just keeps us from over-flowing our strings when comparing
		$length = min(strlen($hasha), strlen($hashb));
		$hasha = substr($hasha, 0, $length);
		$hashb = substr($hashb, 0, $length);

		// iterate through the hashes comparing them character by character
		// if a character does not match, then return true, so the hashes are not equal
		for ($i = 0; $i < strlen($hasha); $i++) {
			$hashes_are_not_equal += !(ord($hasha[$i]) === ord($hashb[$i]));
		}

		// if not hashes are not equal, then hashes are equal
		return !$hashes_are_not_equal;
	}
}