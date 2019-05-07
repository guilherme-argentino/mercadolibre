<?php

namespace Javiertelioz\MercadoLibre\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Javiertelioz\MercadoLibre\Models\Topics;
use Javiertelioz\MercadoLibre\Models\Notifications;

class MeliController extends Controller
{
    /**
     * Login Page (Mercado Libre)
     */
    public function login() {
        session()->regenerate();
    	return view('mercadolibre::login')->with('auth', [
    		'url' => \Meli::getAuthUrl(env('ML_AUTHENTICATION_URL', '')),
    	]);
    }
    public function logout() {
        if(session('profile')) {
            session()->forget('profile');
            session()->flush();
        }
        return \Redirect::to('/meli/login');
    }
    /**
     * Get Acces Token Page
     */
    public function callback(Request $request) {
        $error = $request->input('error');
    	$error_description = $request->input('error_description');

        $code = $request->input('code');
        $access_token = session('access_token');
    	if($error) {
    		return view('mercadolibre::login')->with('auth', [
    			'error' => $error,
    			'description' => $error_description,
    			'url' => \Meli::getAuthUrl(env('ML_AUTHENTICATION_URL', '')),

    		]);
    	}
        if($code || $access_token ) {
			if($code && !($access_token)) {
                $user = \Meli::authorize($code, env('ML_AUTHENTICATION_URL'));
				
                session(['access_token' => $user['body']->access_token]);
				session(['expires_in' => time() + $user['body']->expires_in]);
				session(['refresh_token' => $user['body']->refresh_token]);
				$me = \Meli::get('/users/me', ['access_token' => session('access_token')]);
				session(['profile' => $me['body']]);
			} else {
				if(session('expires_in') < time()) {
					try {
                        $refresh = \Meli::refreshAccessToken(session('refresh_token'));
						session(['access_token' => $refresh['body']->access_token]);
						session(['expires_in' => time() + $refresh['body']->expires_in]);
						session(['refresh_token' => $refresh['body']->refresh_token]);
					} catch (Exception $e) {
						echo "Exception: " . $e->getMessage() . PHP_EOL;
					}
				}
			}
			return \Redirect::to('/meli/admin');
		} else {
			$auth_url = \Meli::getAuthUrl(env('ML_AUTHENTICATION_URL', ''));
    		return view('mercadolibre::login')->with('auth_url', $auth_url);
		}
    }

    public function admin() {
        if(session('profile')) {
            /*echo '<pre>';
            dd(session('profile'));
            echo '</pre>';*/
            return view('mercadolibre::admin.dashboard')
                ->with('profile', session('profile'));
        }
    	return \Redirect::to('/meli/login');
    }

    /**
     * Listening to Notifications enables you to have a real-time 
     * feed of the changes that occur on the different resources of the MercadoLibre API
     * @see http://developers.mercadolibre.com/notifications
     */
    public function notifications() {
        $path = config('mercadolibre.path_log');
        $file = config('mercadolibre.file_log');

    	$notification = file_get_contents("php://input");
        if(!is_dir($path)){
            mkdir($path);
        }
    	if (!empty($notification)) {
			file_put_contents($path . $file, $notification . PHP_EOL, FILE_APPEND);
            new Topics(json_decode($notification));
		}
    }

    public function getNotifications() {
        $notifications = Notifications::where('is_view', 0)
            ->orderBy('received', 'desc')
            ->take(15)
            ->get();

        return response()->json($notifications);
    }
}
