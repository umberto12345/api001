<?php

namespace App\Http\Controllers;
use Validator;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Anime;
use App\User;
use App\AnimeLike;
use App\Http\Resources\Users as UsersResource;

use App\Http\Resources\Anime as AnimeResource;

use App\Http\Resources\AnimeLike as AnimeLikeResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class AnimeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   


        //get articles
        $anime = Anime::all();
        //return collection of articles as a resource
        return $anime->toArray();
    }

      public function show()
    { 
       // get data $postdata = file_get_contents("php://input");
               


    }
    public function likes(Request $request)
    {

        $animeLike = AnimeLike::all();
    $animeId = request('id_anime');

                           return  ;
    }

    public function unlikes(Request $request)
    {
     $animeLike = AnimeLike::all();
    $animeId = request('id_anime');

                           return  $animeLike->where('id_users',request('id'));
                               }
    public function like(Request $request)
    {   
   //

        if(request('id') && request('id_anime'))
         {


                $user = DB::table('anime_likes')->where('id_users', request('id'))->where('id_anime',request('id_anime'))->first();

                if(!$user){


                DB::table('anime_likes')->insert(['id_users' => request('id'), 'id_anime' => request('id_anime')]);
               return  response()->json(['success'=>'ok']);
                    }
                    else
                    {  
                        

                             DB::table('anime_likes')->
                             where("id_users",request('id'))->where("id_anime",request('id_anime'))->delete();
                           return  response()->json(['nops'=>'nok']);
                    }
    
            
        }

        else{
            return response()->json(['error'=>'Unauthorised'], 401);
    }

    
       

    }
     public function uplikes(Request $request)
        {
         $animeLike = AnimeLike::all();
        $animeId = request('id_anime');
        $res = $animeLike->where('id_users',request('id'))->where('id_anime',$animeId);
                            if($res->count() <= 0){

                            return  response()->json(['success1'=>"culooo"]);

                            }
                            else{

                            return  response()->json(['success2'=>1]);

                            }
                                   }


    
       
    
} 
