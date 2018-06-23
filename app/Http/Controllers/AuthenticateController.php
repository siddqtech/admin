<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use Session;

class AuthenticateController extends Controller
{	
	public function showLogin()
	{
		try
      {
         return view('auth.login');   
      }
       catch (Exception $e) 
      {
         return redirect()->back()->with('error',$e->getMessage());
      }
	}
   	public function authProcess(Request $request)
   	{	
   		try 
   		{
   			if(!empty($request))
   			{
   				$validator = Validator::make($request->all(),[
   					'email' => 'required',
   					'password' => 'required'
   				]);
			
   				if($validator->fails())
   				{
   					return redirect()->route('login')->withErrors($validator)->withInput();
   				}else
   				{
   				if(Auth::attempt(['email' => $request->email, 'password' => $request->password]))
                  {
         				if(Auth::user()->role == 1 )
         					{
         						return redirect()->route('admin.dashboard');
         					}
                        else
         				   {
         					   if(Auth::user()->status == 1)
                           {
                              /*return redirect()->route('dashboard');*/

                           }else{
                              return redirect()->route('login')->with('error','Please Contact Admin');        
                           }
                           
              				}
                  }else
                  {
                        return redirect()->route('login')->with('error','Invalid User');     
                  }
            }
   			}
   			else
   			{
   				return redirect()->route('login')->with('error','Please Enter Email & pwd');
   			}

		}
		catch (Exception $e) 
		{
   			return redirect()->back()->with('error',$e->getMessage());
   		}
   	}
      public function logout()
      {
         Auth::guard('web')->logout();
        Session::flush();
        return redirect()->route('login');
      }
}
