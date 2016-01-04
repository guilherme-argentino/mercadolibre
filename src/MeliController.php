<?php

namespace Javiertelioz\MercadoLibre;

use Illuminate\Http\Request;
use Petsy\Http\Controllers\Controller;

class MeliController extends Controller
{
    public function login() {
    	$token = \Meli::getTokenByConsole();
    	print_r($token);
    	dd(\Meli::get('/orders/1044649088', ['access_token' => $token['access_token']]));
    	return view('mercadolibre::login')->with('auth_url', \Meli::getAuthUrl(env('AUTHENTICATION_URL', '')));
    }

    public function callback(Request $request) {
    	$code = $request->input('code');
		$access_token = session('access_token');
		if($code || $access_token ) {
			// If code exist and session is empty
			if($code && !($access_token)) {
				// If the code was in get parameter we authorize
				$user = \Meli::authorize($code, env('AUTHENTICATION_URL'));
				// Now we create the sessions with the authenticated user
				session(['access_token' => $user['body']->access_token]);
				session(['expires_in' => time() + $user['body']->expires_in]);
				session(['refresh_token' => $user['body']->refresh_token]);
			} else {
				// We can check if the access token in invalid checking the time
				if(session('expires_in') < time()) {
					try {
						// Make the refresh proccess
						$refresh = \Meli::refreshAccessToken(session('refresh_token'));
						// Now we create the sessions with the new parameters
						session(['access_token' => $refresh['body']->access_token]);
						session(['expires_in' => time() + $refresh['body']->expires_in]);
						session(['refresh_token' => $refresh['body']->refresh_token]);

					} catch (Exception $e) {
						echo "Exception: " . $e->getMessage() . PHP_EOL;
					}
				}
			}

			echo '<pre>';
			dd(session());
			echo '</pre>';
		} else {
			$link = \Meli::getAuthUrl(env('AUTHENTICATION_URL', ''));
    		return view('mercadolibre::login')->with('auth_url', $link);
		}
    }

    public function notifications() {
    	$rawPostData = file_get_contents("php://input");
    	if (!empty($rawPostData)) {
			file_put_contents('notification'.date("j.n.Y").'.log', $rawPostData . PHP_EOL, FILE_APPEND);
			//new Topics(json_decode($rawPostData, true));
		}
    }
}
