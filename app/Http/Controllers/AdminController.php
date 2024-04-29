<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\{Admins,States,Cities};
use Illuminate\Support\Facades\Validator;
use App\Models\Userdetails;



class AdminController extends Controller
{
    //
    public function register(Request $request)
    {
        $messages = [
            'user_name.required'=> trans('User Name is Required'),
            'email.required'=> trans('Email is Required'),
            'email.unique' => trans('Email Already Exists'),
            'password.required' => trans('Password is Required'),
            'password.regex' => trans('Valid Password'),
        ];

        $validator = Validator::make($request->all(), [
                'email' => 'required|unique:admins,email',
                'user_name' => 'required',
                'password' => 'required|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
        ], $messages);
       
        if ($validator->fails()) {
            return redirect()->back()
						->withErrors($validator)
						->withInput();
        }
        $admin=new Admins();
        $admin->user_name=$request->user_name;
        $admin->email=$request->email;
        $admin->password=$request->password;
        //dd($admin);
        $admin->save();
        return view('login');

    }
    public function admin_login(Request $request)
    {
        $messages = [
            'email.required'=> trans('Email is Required'),
            'password.required' => trans('Password is Required'),
        ];

        $validator = Validator::make($request->all(), [
                'email' => 'required',
                'password' => 'required',
        ], $messages);
       //dd($validator->fails());
        if ($validator->fails()) {
            return view('login')
						->withErrors($validator);
        }
        $admin=Admins::where('email',$request->email)->where('password',$request->password)->get()->first();
        if(!empty($admin))
        {
           return redirect()->route('admin.dashboard');
        }
        else
        {
            return view('login');
        }
    }

    public function dashboard(Request $request){
        $data=Userdetails::all();
       
        return view('admin_dashboard',compact('data'));
    }
    public function add_user()
    {
        $states=States::where('countries_id',101)->get();
        //dd($states);
        $cities=Cities::all();
        return view('add_new_user',compact('states','cities'));
    }

    /**
     *  Get all state from selected state
     *  param state_id
     */
    public function getAllcity(Request $request){
        // check country id not blank
        
        if (!empty($request->id)) {
            if($request ->has('public-contact')){

                if(is_array($request->id))
                {
                    $cities = Cities::whereIn('state_id', $request->id)->get();
                }
                else
                {
                    $cities = Cities::where('state_id', $request->id)->get();
                }
                
                $ctresult = '<option value="">Please Select city</option>';
                

            }else{
                if(is_array($request->id))
                {
                    $cities = Cities::whereIn('state_id', $request->id)->get();
                }
                else
                {
                    $cities = Cities::where('state_id', $request->id)->get();
                }
                
                $ctresult = '<option value="">Please Select city</option>';
                // check city data more than 0
                if (!$cities->isEmpty()) {
                    foreach ($cities as $value) {
                        $ctresult .= '<option value="' . $value->id . '">' . $value->name . '</option>';
                        
                    }
                }

            }
            
            return response()->json([
                'cities' => $ctresult
            ]);
        } else {
            return redirect()->back()->with(['message' => 'Something went Wrong. Please try again.']);
        }
    }
    
}
