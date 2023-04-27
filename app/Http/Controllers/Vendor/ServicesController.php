<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Service;
use App\Models\Category;
use App\Models\Country;
use App\Models\ServiceGallery;
use App\Models\ServiceSlot;
use App\Models\UserService;
use App\Models\UserShop;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Validator;
use Image;
use Datatables;

class ServicesController extends VendorBaseController
{

    //*** JSON Request
    public function datatables()
    {
         $user = $this->user;
         $datas =  $user->mainservices()->latest('id')->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->editColumn('name', function(UserService $data) {
                                $name = mb_strlen(strip_tags($data->name),'UTF-8') > 50 ? mb_substr(strip_tags($data->name),0,50,'UTF-8').'...' : strip_tags($data->name);
                                $id = '<small>'.__('Service ID').': <a href="" target="_blank">'.sprintf("%'.08d",$data->id).'</a></small>';
                                return  $name.'<br>'.$id;
                            })
                            ->editColumn('price', function(UserService $data) {
                                $price = round($data->price * $this->curr->value , 2);
                                return \PriceHelper::showAdminCurrencyPrice($price);
                            })
                            ->addColumn('status', function(UserService $data) {
                                $class = $data->status == 1 ? 'drop-success' : 'drop-danger';
                                $s = $data->status == 1 ? 'selected' : '';
                                $ns = $data->status == 0 ? 'selected' : '';
                                return '<div class="action-list"><select class="process select droplinks '.$class.'"><option data-val="1" value="'. route('vendor-services-status',['id1' => $data->id, 'id2' => 1]).'" '.$s.'>'.__('Activated').'</option><<option data-val="0" value="'. route('vendor-services-status',['id1' => $data->id, 'id2' => 0]).'" '.$ns.'>'.__('Deactivated').'</option>/select></div>';
                            })
                            ->addColumn('action', function(UserService $data) {
                                return '<div class="action-list"><a href="' . route('vendor-services-edit',$data->id) . '"> <i class="fas fa-edit"></i>'.__('Edit').'</a><a href="javascript" class="set-gallery" data-toggle="modal" data-target="#setgallery"><input type="hidden" value="'.$data->id.'"><i class="fas fa-eye"></i> '.__('View Gallery').'</a><a href="javascript:;" data-href="' . route('vendor-services-delete',$data->id) . '" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
                            })
                            ->rawColumns(['name', 'status', 'action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }

    public function index(){
        return view('vendor.services.index');
    }

    public function create(){
        $cats = Category::where('status',1)->get();
        $shops = UserShop::where('user_id', $this->user->id)->get();
        $countries = Country::orderby('id', 'desc')->get();
        $sign = $this->curr;
        return view('vendor.services.create', compact('cats','countries','shops','sign'));
    }

    //*** POST Request
    public function store(Request $request)
    {
        $user = $this->user;
        $package = $user->subscribes()->latest('id')->first();
        // $services = $user->mainproducts()->latest('id')->get()->count();
        
        // if($services < $package->allowed_services || $package->allowed_services == 0)
        // {

        //--- Validation Section
        $rules = [
               'photo'      => 'required',
               'file'       => 'mimes:zip'
                ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
            $data = new UserService();
            $sign = $this->curr;
            $input = $request->all();
            // Check File
            if ($file = $request->file('file'))
            {
                $extensions = ['zip'];       
                if(!in_array($file->getClientOriginalExtension(),$extensions)){
                    return response()->json(array('errors' => ['Image format not supported']));
                }
                $name = \PriceHelper::ImageCreateName($file);
                $file->move('assets/files',$name);
                $input['file'] = $name;
            }

            $image = $request->photo;
            list($type, $image) = explode(';', $image);
            list(, $image)      = explode(',', $image);
            $image = base64_decode($image);
            $image_name = time().Str::random(8).'.png';
            $path = 'assets/images/products/'.$image_name;
            file_put_contents($path, $image);
            $input['photo'] = $image_name;
            // Check Seo
        if (empty($request->seo_check))
         {
            $input['meta_tag'] = null;
            $input['meta_description'] = null;
         }
         else {
        if (!empty($request->meta_tag))
         {
            $input['meta_tag'] = implode(',', $request->meta_tag);
         }
         }

             

            // Conert Price According to Currency
             $input['price'] = ($input['price'] / $sign->value);
             $input['previous_price'] = ($input['previous_price'] / $sign->value);
         	 $input['user_id'] = $this->user->id;
         	 $input['country_id'] = $request->national_int == 1 ? json_encode($request->single_country_id) : json_encode($request->country_id);
         	 $input['city_id'] = json_encode($request->city_id);
         	 $input['status'] = 1;

           // store filtering attributes for physical product
           
            // Save Data
                $data->fill($input)->save();

            // Set SLug

                $service = UserService::find($data->id);
                $service->slug = Str::slug($data->name,'-').'-'.strtolower($data->sku);
                
            // Set Thumbnail
                $img = Image::make(public_path().'/assets/images/products/'.$service->photo)->resize(285, 285);
                $thumbnail = time().Str::random(8).'.jpg';
                $img->save(public_path().'/assets/images/thumbnails/'.$thumbnail);
                $service->thumbnail  = $thumbnail;
                $service->update();

            // Add To Gallery If any
                $lastid = $data->id;
                if ($files = $request->file('gallery')){
                    foreach ($files as  $key => $file){
                        $extensions = ['jpeg','jpg','png','svg'];       
                        if(!in_array($file->getClientOriginalExtension(),$extensions)){
                            return response()->json(array('errors' => ['Image format not supported']));
                        }
                        if(in_array($key, $request->galval))
                        {
                            $gallery = new ServiceGallery();
                            $name = \PriceHelper::ImageCreateName($file);
                            $img = Image::make($file->getRealPath())->resize(800, 800);
                            $thumbnail = time().Str::random(8).'.jpg';
                            $img->save(public_path().'/assets/images/galleries/'.$name);
                            $gallery['photo'] = $name;
                            $gallery['service_id'] = $lastid;
                            $gallery->save();
                        }
                    }
                }
                if($request->day && is_array($request->day)){
                    foreach($request->day as $key => $day){
                        $slot = new ServiceSlot();
                        $slot->service_id = $lastid;
                        $slot->day = $day;
                        $slot->start_time = $request->start_time[$key];
                        $slot->end_time = $request->end_time[$key];
                        $slot->save();
                    }
                }
        //logic Section Ends

        //--- Redirect Section
        $msg = __('New Service Added Successfully.').'<a href="'.route('vendor-services-index').'">'.__('View Service Lists.').'</a>';
        return response()->json($msg);
        //--- Redirect Section Ends
        // }
        // else
        // {
        // //--- Redirect Section
        // return response()->json(array('errors' => [ 0 => __('You Can\'t Add More Product.')]));

        // //--- Redirect Section Ends
        // }
    }

    public function status($id1,$id2)
    {
        $data = UserService::findOrFail($id1);
        $data->status = $id2;
        $data->update();
        //--- Redirect Section
        $msg = __('Status Updated Successfully.');
        return response()->json($msg);
        //--- Redirect Section Ends
    }

    //*** GET Request
    public function edit($id)
    {
        $data = UserService::findOrFail($id);
        $cats = Category::where('status',1)->get();
        $shops = UserShop::where('user_id', $this->user->id)->get();
        $sign = $this->curr;
        return view('vendor.services.edit',compact('data','cats','shops','sign'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {
        //--- Validation Section
        $rules = [
               'photo'      => 'mimes:jpeg,jpg,png,svg',
                ];

        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
        $data = Service::findOrFail($id);
        $input = $request->all();
            if ($file = $request->file('photo')) 
            { 
                $extensions = ['jpeg','jpg','png','svg'];       
                if(!in_array($file->getClientOriginalExtension(),$extensions)){
                    return response()->json(array('errors' => ['Image format not supported']));
                }             
                $name = \PriceHelper::ImageCreateName($file);
                $file->move('assets/images/services',$name);
                if($data->photo != null)
                {
                    if (file_exists(public_path().'/assets/images/services/'.$data->photo)) {
                        unlink(public_path().'/assets/images/services/'.$data->photo);
                    }
                }            
            $input['photo'] = $name;
            } 
        $data->update($input);
        //--- Logic Section Ends

        //--- Redirect Section     
        $msg = __('Data Updated Successfully.');
        return response()->json($msg);      
        //--- Redirect Section Ends            
    }

    //*** GET Request Delete
    public function destroy($id)
    {
        $data = UserService::findOrFail($id);
        //If Photo Doesn't Exist
        if($data->photo == null){
            $data->delete();
            //--- Redirect Section     
            $msg = __('Data Deleted Successfully.');
            return response()->json($msg);      
            //--- Redirect Section Ends     
        }
        //If Photo Exist
        if (file_exists(public_path().'/assets/images/services/'.$data->photo)) {
            unlink(public_path().'/assets/images/services/'.$data->photo);
        }
        $data->delete();
        //--- Redirect Section     
        $msg = __('Data Deleted Successfully.');
        return response()->json($msg);      
        //--- Redirect Section Ends     
    }

}
