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
    		return array('error'=>'token invalido');
    	}

    	$email = $authorizationSplitted[0];
    	$pwd = $authorizationSplitted[1];

    	$user = App\User::whereEmail($email)->first();
    	$userInvalidReturn = array('error'=>'usuario invalido');
    	
    	if($user === null){
    		return $userInvalidReturn;
    	}else{
    		if (!Hash::check($pwd, $user->password)) {
    			return $userInvalidReturn;
 			}
 			return array("token"=>$user->api_token);
    		
    	}
    
    }

    function user(Request $request){
    	return $request->user();
    }
}
