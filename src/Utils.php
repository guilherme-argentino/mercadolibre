<?php

namespace Javiertelioz\MercadoLibre;

class Utils
{
	/**
	 * File Name for save Token
	 */
	const FILE = 'meli_token';
	/**
	 * Get File Token
	 * @return array
	 */
	private function _getFileToken() {

		$file = file_get_contents(storage_path() . '/' . self::FILE);
		if($file) {
			$content = json_decode($file, true);
			return $content;
		}

		return false;
	}
	/**
	 * Save Token in file
	 * @param  string $token token Data
	 * @return array        token Data
	 */
	private function _saveToken($token) {
		file_put_contents(storage_path() . '/' . self::FILE, $token . PHP_EOL);
	}
	/**
	 * Get Token
	 * @return array
	 */
	public function getTokenByConsole() {

		$params = http_build_query([
			'grant_type' => 'client_credentials',
			'client_id' => $this->client_id,
			'client_secret' => $this->client_secret,
			]);

		$comand = exec('curl -X POST -H "accept: application/json" -H "Content-Type: application/x-www-form-urlencoded" "https://api.mercadolibre.com/oauth/token?' . $params .'"' , $result);
		$this->_saveToken($result[0]);
		return $this->_getFileToken();
	}
	/**
	 * Get Refresh token
	 * @return array
	 */
	public function getRefreshTokenByConsole() {
		$token = $this->_getFileToken();
		$params = http_build_query([
            "grant_type" => "refresh_token",
            "client_id" => $this->client_id,
            "client_secret" => $this->client_secret,
            "refresh_token" => $token['refresh_token'],
        ]);

        $comand = exec('curl -X POST -H "accept: application/json" -H "Content-Type: application/x-www-form-urlencoded" "https://api.mercadolibre.com/oauth/token?' . $params .'"' , $result);
        $this->_saveToken($result[0]);
        return $this->_getFileToken();
	}

}