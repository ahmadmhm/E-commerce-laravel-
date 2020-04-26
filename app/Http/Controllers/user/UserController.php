<?php


namespace App\Http\Controllers\user;


use App\Country;
use App\Mail\VerifyMail;
use App\User;
use App\UserInfo;
use App\VerifyUser;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserController
{

    public function userLoginRegister(){
        return response()->view('user.login_register');
    }
    public function register(Request $request){
        if($request->isMethod('post')){
            if(isset($request->name) and isset($request->email) and isset($request->password)){
                $user = User::select('id')->where('email',$request->email)->get();
                if($user->isEmpty()){
                    $user = new User();
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->user_type = 2;
                    $user->verified = 0;
                    $user->password = bcrypt($request->password);
                    $user->save();

                    if(!$user->verifyUser){
                        $user->verifyUser()->create(['token'=>sha1($user->id . time())]);
                    }else{
                        $user->verifyUser()->update(['token'=>sha1($user->id . time())]);
                    }

                    Mail::to($user->email)->send(new VerifyMail($user));

                    return redirect()->back()->with('flash_message_success','We sent you an activation code. Check your email and click on the link to verify.');
//                    return redirect()->route('showCart')->with('flash_message_success','@@Welcome@@');
                }else{
                    return redirect()->back()->with('flash_message_error','the email has exists!!');
                }
            }
        }
        return response()->view('user.login_register');
    }

    public function verifyUser($token)
    {
        if($token){
            $verifyUser = VerifyUser::where('token', $token)->first();
            if(isset($verifyUser) ){
                $user = $verifyUser->user;
                if(!$user->verified) {
                    $verifyUser->user->verified = 1;
                    $verifyUser->user->save();
                    Auth::login($user);
                    return redirect()->route('showCart')->with('flash_message_success','Your email is Verified  @@welcome@@');
                } else {
                    return redirect()->route('user.userLoginRegister')->with('flash_message_success', 'Your e-mail is already verified. You can now login.');
                }
            } else {
                return redirect()->route('user.userLoginRegister')->with('warning', "Sorry your email cannot be identified.");
            }

        }
    }

    public function login(Request $request)
    {
        if($request->isMethod('post')){
            //dd(Hash::make($request->password));
            if(Auth::attempt(['email'=>$request->email,'password'=>$request->password ,'user_type'=>2])){
                return redirect()->route('showCart')->with('flash_message_success','@@Welcome@@');
            }else{
                return back()->with('flash_message_error','Invalid username and password');
            }
        }
        return back()->with('flash_message_error','Invalid username and password');
    }

    public function logout()
    {
        Auth::guard()->logout();
        return  redirect()->route('index')->with('flash_message_success','logged out successful');
    }

    public function checkEmail(Request $request){
        $user = User::where('email',$request->email)->first();
        if($user){
            return "false";
        }
        return "true";
    }

    public function account(Request $request){
        $user = Auth::user();
        $information = $user->Information;
        $countries = Country::all();
        if($request->isMethod('post')){
            try{
                $validator = Validator::make($request->all(),[
                    'name' => 'required',
                    'address' => 'required',
                    'city' => 'required',
                    'state' => 'required',
                    'country' => 'required',
                    'mobile' => 'required',
                    'pincode' => 'required',
                ],
                [
                    'name.required' => 'write a name',
                    'address.required' => 'write an address',
                    'city.required' => 'write city name',
                    'state.required' => 'choose a state',
                ]
                );

                if ($validator->fails()) {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                }

                $user->name = $request->name;
                $user->update();

                $result = $countries->where('id', $request->country);
                if ($result->isEmpty()){
                    return back()->with('flash_message_error','selected country is incorrect');
                }
                $user->Information()->update([
                    'address'=>$request->address,
                    'city'=>$request->city,
                    'state'=>$request->state,
                    'country'=>$request->country,
                    'mobile'=>$request->mobile,
                    'pincode'=>$request->pincode,
                ]);

                return redirect()->back()->with('flash_message_success','profile updated successfully');
            }
            catch(\Exception $e){
//                die($e->getMessage()) ;   // insert query
            }
        }
        return view('user.account', compact('user', 'information' , 'countries'));
    }

    public function checkPassword(Request $request){
        if($request->ajax()){
            if(isset($request->current_password)){
                $user = User::where('id',Auth::user()->id)->first();
                if($user){
                    return response()->json(['status'=>Hash::check($request->current_password, $user->password)]);
                }
                return response()->json(['error']);
            }
        }
        return response()->json(['error']);
    }

    public function updatePassword(Request $request){
        if($request->isMethod('post')){
            try{
                $validator = Validator::make($request->all(),[
                    'current_password' => 'required',
                    'new_password' => 'required',
                    'confirm_password' => 'required|same:new_password',
                ],
                    [
                        'current_password.required' => 'current password is required',
                        'new_password.required' => 'new password is required',
                        'confirm_password.required' => 'confirm password is required',
                        'confirm_password.same' => 'confirm password not equal to new password',
                    ]
                );

                if ($validator->fails()) {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                }
                $user = Auth::user();

                if(!Hash::check($request->current_password, $user->password)){
                    return redirect()->back()->with('flash_message_error','current password is Incorrect');
                }
                if(Hash::check($request->new_password, $user->password)){
                    return redirect()->back()->with('flash_message_error','new password must no equal to old password');
                }
                $user->update(['password'=>bcrypt($request->new_password)]);
                return redirect()->back()->with('flash_message_success','password updated successfully');
            }
            catch(\Exception $e){
//                die($e->getMessage()) ;   // insert query
            }
        }
        return view('user.account', compact('user', 'information' , 'countries'));
    }
}