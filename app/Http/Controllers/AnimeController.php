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
    public function deleteAnime(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'id' => 'required',

            ]);


        if ($validator->fails() ) {
            return response()->json($validator->errors()->first(), 401);
        }
        else {
            $input = $request->all();
            $id = $input['id'];
            $animeLike = AnimeLike::all()->where('id_anime',$id)->first();
            $anime = Anime::all()->where('id',$id)->first();

            if($anime == '' ){
                return response()->json(['fail' => 'non esiste']);

            }
            else{
                $anime->delete();
                $animeLike->delete();

                return response()->json(['success' => 'eliminato']);

            }
            }
    }
    public function updateAnime(Request $request)
    {
        $role =

        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'regex:/(^[0-9 ]+$)+/'],
            'titolo'=>  ['required', 'regex:/(^[A-Za-z0-9 ]+$)+/'],
            'trama' => ['required', 'regex:/(^[A-Za-z0-9 ]+$)+/'],
            'autore' => ['required', 'regex:/(^[A-Za-z ]+$)+/'],
            'img' =>  ['required', 'regex:/(^[A-Za-z0-9. \/]+$)+/'],
            'img2' =>['required', 'regex:/(^[A-Za-z0-9. \/]+$)+/'],
            'stagioni' => ['required', 'regex:/(^[0-9 ]+$)+/'],
            'episodi' => ['required', 'regex:/(^[0-9 ]+$)+/'],
            'genere' => ['required', 'regex:/(^[A-Za-z ]+$)+/'],
            'img_ang'=> ['required', 'regex:/(^[A-Za-z0-9 ]+$)+/'],
            'role' => ['required','regex:/(^[1-2]+$)+/']
        ]);
        if ($validator->fails() ) {
            return response()->json($validator->errors()->first(), 401);
        }
        else {
            if (isset($input['id']) ||
                isset($input['titolo']) ||
                isset($input['trama']) ||
                isset($input['autore']) &&
                isset($input['img']) &&
                isset($input['genere']) &&
                isset($input['img2']) &&
                isset($input['stagioni']) &&
                isset($input['img_ang']) &&
                isset($input['episodi']) &&
                isset($input['role'])) {
                if($input['role'] == '2') {


                    $id = $input['id'];
                    $trama = $input['trama'];
                    $autore = $input['autore'];
                    $genere = $input['genere'];
                    $img = $input['img'];
                    $img2 = $input['img2'];
                    $img_ang = $input['img_ang'];
                    $titolo = $input['titolo'];
                    $stagioni = $input['stagioni'];
                    $episodi = $input['episodi'];


                    $anime = DB::table('animes')->where('id', $id)->update([
                        'id' => $id,
                        'titolo' => $titolo,
                        'trama' => $trama,
                        'autore' => $autore,
                        'img' => $img,
                        'img2' => $img2,
                        'stagioni' => $stagioni,
                        'episodi' => $episodi,
                        'genere' => $genere,
                        'img_ang' => $img_ang

                    ]);
                    if ($anime == 0) {
                        return Anime::all()->where('id', $id);

                    } else {
                        return response()->json(['errore' => 'errore']);
                    }
                }
                else
                    {
                        return response()->json(['errore' => 'errore']);

                    }

            }
        }
    }



    
       
    
} 
