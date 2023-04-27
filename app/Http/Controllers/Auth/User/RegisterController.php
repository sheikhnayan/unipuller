<?php

namespace App\Http\Controllers\Auth\User;

use App\{
	Models\User,
	Models\Notification,
	Models\UserShop,
	Classes\GeniusMailer,
	Models\Generalsetting,
	Http\Controllers\Controller
};
use Illuminate\Http\Request;
use Auth;
use Validator;

class RegisterController extends Controller
{

    public function register(Request $request)
    {

    	$gs = Generalsetting::findOrFail(1);

    	
    	if($gs->is_capcha == 1)
        {
            $rules = [
                'g-recaptcha-response' => 'required|captcha'
            ];
            $customs = [
                'g-recaptcha-response.required' => "Please verify that you are not a robot.",
                'g-recaptcha-response.captcha' => "Captcha error! try again later or contact site admin..",
            ];
            $validator = Validator::make($request->all(), $rules, $customs);
            if ($validator->fails()) {
              return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
            }
        }

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
	        $input['service_category_id'] = json_encode($request['service_category_id']);
	        $input['password'] = bcrypt($request['password']);
	        $token = md5(time().$request->name.$request->email);
	        $input['verification_link'] = $token;
	        $input['affilate_code'] = md5($request->name.$request->email);
	        $input['status'] = 1;

	          if(!empty($request->vendor))
	          {
					//--- Validation Section
					$rules = [
						'shop_name' => 'unique:users',
						'shop_number'  => 'max:10'
							];
					$customs = [
						'shop_name.unique' => __('This Shop Name has already been taken.'),
						'shop_number.max'  => __('Shop Number Must Be Less Then 10 Digit.')
					];

					$validator = Validator::make($request->all(), $rules, $customs);
					if ($validator->fails()) {
						return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
					}
					// $input['is_vendor'] = 1;
					$input['is_vendor'] = 2;

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
	        if($gs->is_verification_email == 1)
	        {
	        $to = $request->email;
	        $subject = 'Verify your email address.';
	        $msg = "Dear Customer,<br>We noticed that you need to verify your email address.<br>Simply click the link below to verify. <a href=".url('user/register/verify/'.$token).">".url('user/register/verify/'.$token)."</a>";
	        //Sending Email To Customer

	        $data = [
	            'to' => $to,
	            'subject' => $subject,
	            'body' => $msg,
	        ];

	        $mailer = new GeniusMailer();
	        $mailer->sendCustomMail($data);
	        

          	return response()->json('We need to verify your email address. We have sent an email to '.$to.' to verify your email address. Please click link in that email to continue.');
	        }
	        else {

            $user->email_verified = 'Yes';
            $user->update();
	        $notification = new Notification;
	        $notification->user_id = $user->id;
			$notification->save();
			
			// Welcome Email For User

			$data = [
				'to' => $user->email,
				'type' => "new_registration",
				'cname' => $user->name,
				'oamount' => "",
				'aname' => "",
				'aemail' => "",
				'onumber' => "",
			];
			$mailer = new GeniusMailer();
			$mailer->sendAutoMail($data);    


            Auth::login($user); 
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

				// Welcome Email For User

				$data = [
					'to' => $user->email,
					'type' => "new_registration",
					'cname' => $user->name,
					'oamount' => "",
					'aname' => "",
					'aemail' => "",
					'onumber' => "",
				];
				$mailer = new GeniusMailer();
				$mailer->sendAutoMail($data); 


				Auth::login($user); 
				return redirect()->route('user-dashboard')->with('success',__('Email Verified Successfully'));
			}
    	}
    	else {
    		return redirect()->back();	
    	}
    }
}