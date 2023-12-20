<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\userControler;
use App\Http\Controllers\tokenController;



class apiAuth extends Controller
{
    
    public function login(Request $request){
        //zet json om naar bruikbare data
        $data = json_decode($request->getContent(), true);

        //valideer de data of alles er is
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        //haalt gebruiker op uit database
        $userClass = new userControler();
        $user = $userClass->firstResult($data['email']);

        
        if (! $user) {
            // als er geen gebruiker is met het email adres dan geef een error
            $token = ["error" => 'email is niet correct'];
        }elseif (! Hash::check($data['password'], $user->password)) {
            // als het wachtwoord niet klopt geef een error
            $token = ["error" => 'wachtwoord is niet correct'];
        }else{
            if($user->email_verified_at == null){
                //als het email adres niet is bevestigd geef een error
                $token = ["error" => 'email is nog niet bevestigd'];
            }else{
                //als alles klopt maak een token aan en geef deze terug in een array
                $token = array("token" => $user->createToken($data['device_name'], ["read","create","update","delete"])->plainTextToken, "name" => $user->name, "email" => $user->email, "device_name" => $data['device_name']);
            }
        }
        
        //zet de array om naar json en geef deze terug
        return json_encode($token);
    }

    public function tokenValidate(Request $request){
        //zet json om naar bruikbare data
        $data = json_decode($request->getContent(), true);

        //valideer de data of alles er is
        $request->validate([
            'token' => 'required',
            'device_name' => 'required',
        ]);

        //haalt gebruiker op uit database
        $userClass = new userControler();
        $user = $userClass->firstResult($data['email']);

        //dit moet nog naar eigen controller
        $tokenClass = new tokenController();
        $token = $tokenClass->tokenSearch($data['device_name'], $user->id, $data['token']);
     
        //dit moet nog naar eigen controller
        
        
        return json_encode($token);
    }

    public function create(Request $request, CreateNewUser $createNewUser){
        //zet json om naar bruikbare data
        $data = json_decode($request->getContent(), true);

        //valideer de data of alles er is
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        // haalt gebruiker op uit database
        $userClass = new userControler();
        $user = $userClass->firstResult($data['email']);

        if($user){
            // als er al een gebruiker is met het email adres geef een error
            $send = ['error' => "error email is al in gebruik"];
        }else{
            // als er nog geen gebruiker is met het email adres maak een nieuwe gebruiker aan
            $user = $createNewUser->create($request->all());

            // handmatige e-mailverificatieverzoek maken
            $user->sendEmailVerificationNotification();
            $send = ['message' => "success bevestig nu je email adres"];
        }
        return json_encode($send);
    }

    public function logout(Request $request){
        //zet json om naar bruikbare data
        $data = json_decode($request->getContent(), true);
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'device_name' => 'required',
        ]);
     
        //haalt gebruiker op uit database
        $userClass = new userControler();
        $user = $userClass->firstResult($data['email']);

        //verwijdert de api token uit de database
        $token = new tokenController();
        $token->deleteToken($data['device_name'], $user->id);

        //returned sucses code in json
        return json_encode(['succes' => 'true']);
    }

}
