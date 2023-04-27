<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Generalsetting;
use App\Models\User;
use App\Classes\GeniusMailer;
use App\Http\Controllers\Front\FrontBaseController;
use App\Models\Category;
use App\Models\Country;
use App\Models\Notification;
use App\Models\ServiceCategory;
use App\Models\UserShop;
use Auth;

use Validator;

class RegisterController extends FrontBaseController
{

    public function showRegisterForm()
    {

      return view('frontend.register');
    }
    public function showVendorRegisterForm()
    {
		$categories = Category::orderBy('name', 'asc')->get();
		$countries = Country::orderBy('country_name', 'asc')->get();
      	return view('frontend.vendor-register', compact('categories', 'countries'));
    }

    public function register(Request $request)
    {



        //--- Validation Section

        $rules = [
		        'email'   => 'required|email|unique:users',
		        'password' => 'required|confirmed'
                ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

	        $user = new User;
	        $input = $request->all();
	        $input['password'] = bcrypt($request['password']);
	        $token = md5(time().$request->name.$request->email);
	        $input['verification_link'] = $token;
	        $input['affilate_code'] = md5($request->name.$request->email);

	          if(!empty($request->vendor))
	          {
					//--- Validation Section
					$rules = [
						'shop_name' => 'unique:users',
						'shop_number'  => 'max:10'
							];
					$customs = [
						'shop_name.unique' => 'This Shop Name has already been taken.',
						'shop_number.max'  => 'Shop Number Must Be Less Then 10 Digit.'
					];

					$validator = Validator::make($request->all(), $rules, $customs);
					if ($validator->fails()) {
					return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
					}
					$input['is_vendor'] = 1;

			  }

			$user->fill($input)->save();
			if($request->shop_name && $request->owner_name){
				$data = new UserShop();
				$data->user_id = $user->id;
				$data->shop_name = $request->shop_name;
				$data->owner_name = $request->owner_name;
				$data->shop_number = $request->shop_number;
				$data->shop_address = $request->shop_address;
				$data->reg_number = $request->reg_number;
				$data->shop_message = $request->shop_message;
				$data->shop_details = $request->shop_details;
				$data->status = 1;
				$data->default_type = 1;
				$data->save();
			}
	        if($this->gs->is_verification_email == 1)
	        {
	        $to = $request->email;
	        $subject = 'Verify your email address.';
	        $msg = "Dear Customer,<br> We noticed that you need to verify your email address. <a href=".url('user/register/verify/'.$token).">Simply click here to verify. </a>";
	        //Sending Email To Customer
	        if($this->gs->is_smtp == 1)
	        {
	        $data = [
	            'to' => $to,
	            'subject' => $subject,
	            'body' => $msg,
	        ];

	        $mailer = new GeniusMailer();
	        $mailer->sendCustomMail($data);
	        }
	        else
	        {
	        $headers = "From: ".$this->gs->from_name."<".$this->gs->from_email.">";
	        mail($to,$subject,$msg,$headers);
	        }
          	return response()->json('We need to verify your email address. We have sent an email to '.$to.' to verify your email address. Please click link in that email to continue.');
	        }
	        else {

            $user->email_verified = 'Yes';
            $user->update();
	        $notification = new Notification;
	        $notification->user_id = $user->id;
	        $notification->save();
            Auth::guard('web')->login($user);
          	return response()->json(1);
	        }

    }

    public function token($token)
    {
        $gs = Generalsetting::findOrFail(1);

        if($gs->is_verification_email == 1)
	        {
        $user = User::where('verification_link','=',$token)->first();
        if(isset($user))
        {
            $user->email_verified = 'Yes';
            $user->update();
	        $notification = new Notification;
	        $notification->user_id = $user->id;
	        $notification->save();
            Auth::guard('web')->login($user);
            return redirect()->route('user-dashboard')->with('success','Email Verified Successfully');
        }
    		}
    		else {
    		return redirect()->back();
    		}
    }
}
