<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    function auth(Request $request){
    	$authorizationToken = $request->header('Authorization');
    	
    	$authorizationTokenParsed = str_replace("Basic ", "", $authorizationToken);
    	
    	$authorizationTokenDecoded = base64_decode($authorizationTokenParsed);
    	$authorizationSplitted = explode(":",$authorizationTokenDecoded);
    	if(count($authorizationSplitted)==1){
    		$invalidTokenReturn = array('error'=>'token invalido');
            return response()->json($invalidTokenReturn, 401);
    	}

    	$email = $authorizationSplitted[0];
    	$pwd = $authorizationSplitted[1];

    	$user = App\User::whereEmail($email)->first();
    	$userInvalidReturn = array('error'=>'usuario invalido');
    	
    	if($user === null){
    		return response()->json($userInvalidReturn, 401);
    	}else{
    		if (!Hash::check($pwd, $user->password)) {
    			return response()->json($userInvalidReturn, 401);
 			}

            $authenticatedReturn = array("token"=>$user->api_token);
            return response()->json($authenticatedReturn, 200);
    	}
    
    }

    function user(Request $request){
    	return $request->user();
    }
}
