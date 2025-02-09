<?php

namespace App\Http\Controllers;

use App\Models\WhatsappLink;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Rules;
use Illuminate\Http\Request;
use Session;
use DB;
use Carbon\Carbon;
use App\Enums\paymentType;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
class myAccountController extends Controller
{
    public function index(){
        //Session::get('user');
        $userObject = User::where('AzureID', session('id'))->first();
        $getUser = User::where('AzureID', session('id'))->first();
        $adminAuthorization = AdminController::authorizeUser(session('id'));
        $status = 0;

        $planCommissieLid = paymentType::fromValue(1);
        $plan = paymentType::fromValue(2);
        $name = ucfirst($plan) . ' membership';
        $nameCommissieLid = ucfirst($planCommissieLid) . ' membership';

        Log::info($userObject->subscribed($name,$plan->key));
        if($userObject->subscribed($name,$plan->key) || $userObject->subscribed($nameCommissieLid,$planCommissieLid->key))
        {
            $status = 1;
        }
        if($adminAuthorization == 401){
            return abort(401);
        } else {
            $whatsappLinks = WhatsappLink::all();
            $rules = Rules::all();
            return view('mijnAccount', ['user' => $getUser, 'authorized' => $adminAuthorization,'whatsapplink' => $whatsappLinks,'subscriptionActive' => $status,'transactions' => $getUser->payment, 'rules' => $rules]);
        }
    }
    public function deletePicture(){
        $loggedInUser = User::find(session('id'));
        $loggedInUser->ImgPath = "images/SalveMundi-Vector.svg";
        $loggedInUser->save();
        if(!AzureController::updateProfilePhoto($loggedInUser)){
            return redirect('/mijnAccount')->with('message', 'Er is iets fout gegaan met het bijwerken van je foto op Office365, probeer het later opnieuw.');
        }
        $message = 'Je instellingen zijn bijgewerkt.';

        return redirect('/mijnAccount')->with('message', $message);
    }

    public function savePreferences(Request $request)
    {
        $request->validate([
            'photo' => 'image|mimes:jpeg,png,jpg|max:20480',
        ]);

        $user = User::find($request->input('user_id'));
        if($request->input('cbx'))
        {
            $user->visibility = 1;
            $message = 'Je bent nu te zien op de website';
        } else {
            $user->visibility = 0;
            $message = 'Je bent nu niet meer te zien op de website';
        }
        $user->save();

        if($request->input('birthday') != null)
        {
            $user->birthday = $request->input('birthday');
            $user->birthday = date("Y-m-d", strtotime($user->birthday));
        }
        $user->save();

        if($request->file('photo') != null)
        {
            $request->file('photo')->storeAs('public/users/',$user->AzureID);
            $user->ImgPath = 'users/'.$user->AzureID;
            if(!AzureController::updateProfilePhoto($user)){
                return redirect('/mijnAccount')->with('message', 'Er is iets fout gegaan met het bijwerken van je foto op Office365, probeer het later opnieuw.');
            }
        }

        $user->save();
        $message = 'Je instellingen zijn bijgewerkt.';

        return redirect('/mijnAccount')->with('message', $message);
    }
}
