<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\User;
use App\Feedback;
use Illuminate\Support\Facades\Hash;
class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getFeedback(Request $request){
        $user = App\User::find($request->user()->id);
        if($user->feedback === null){
            $feedback = new App\Feedback();
            $feedback->like = false;
            $feedback->dislike = false;
            
            $user->feedback()->save($feedback);
            $user->feedback = $feedback;
        }
        return $user->feedback->toArray();
    }

    public function putFeedback(Request $request){
        if(!$request->has('like') || !$request->has('dislike')){
            return array("error"=>"Falta parametros like e dislike");
        }

        $like = filter_var($request->input("like"), FILTER_VALIDATE_BOOLEAN);
        $dislike = filter_var($request->input("dislike"), FILTER_VALIDATE_BOOLEAN);
        #RN
        if($like == $dislike){
            return array("error"=>"O valor de like deve ser diferente do dislike");
        }

        $feedback = App\Feedback::firstOrCreate(['user_id'=>$request->user()->id]);
        $feedback->like = $like;
        $feedback->dislike = $dislike;
            
        $feedback->save();
        
        return $feedback->toArray();
    }

    public function count(Request $request){
        return array('likes'=>App\Feedback::whereLike(true)->count(),
                     'dislikes'=>App\Feedback::whereDislike(true)->count());
    }
}
