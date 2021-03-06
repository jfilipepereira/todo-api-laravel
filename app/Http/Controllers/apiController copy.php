<?php

namespace App\Http\Controllers;
//use Illuminate\Support\Facades\Request;
use Request;
use \App\User;
use \App\Notes;
use \App\Images;
use DB;

//Função para gerar strings aleatórias
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

class apiController extends Controller
{
    
    //

    public function shownotes($id)
    {
        return Notes::with('images')->where(['id_user' => $id])->get();
    }

    public function createnote(Request $request)
    {
   
        
        // Now we can get the content from it
        //$content =  Request::getContent(); 
        //$content = json_decode($content);

        
        //Criação de nota
        $nota = new Notes();
        $nota->id_user = $request->id_user;
        $nota->content = $request->content;
        $nota->save();

        

        //Upload photo
        //$fileName = generateRandomString();
        //$fileName = $fileName.'.jpg';
        //$patch = $request->file('photo')->move(public_path("/"), $fileName);
        //$photoURL = url('/'.$fileName);

        $photoURL = 'teste react';
        //Save image path
        $imagem = new Images();
        $imagem->path=$photoURL;
        $imagem->id_nota = $nota->id;;
        $imagem->save();

        return response()->json([
            "message" => "sucesso"
        ], 200); 


    }
}
