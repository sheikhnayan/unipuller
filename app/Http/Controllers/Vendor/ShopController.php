<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Category;
use App\Models\Country;
use App\Models\UserShop;

use Illuminate\Http\Request;

use Validator;
use Datatables;

class ShopController extends VendorBaseController
{

    //*** JSON Request
    public function datatables()
    {
         $datas = UserShop::where('user_id',$this->user->id)->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->addColumn('status', function(UserShop $data) {
                                $class = $data->status == 1 ? 'drop-success' : 'drop-danger';
                                $s = $data->status == 1 ? 'selected' : '';
                                $ns = $data->status == 0 ? 'selected' : '';
                                return '<div class="action-list"><select class="process select droplinks '.$class.'"><option data-val="1" value="'. route('vendor-shop-status',['id1' => $data->id, 'id2' => 1]).'" '.$s.'>'.__("Activated").'</option><option data-val="0" value="'. route('vendor-shop-status',['id1' => $data->id, 'id2' => 0]).'" '.$ns.'>'.__("Deactivated").'</option>/select></div>';
                            })
                            ->addColumn('action', function(UserShop $data) {
                                return '<div class="action-list"><a data-href="' . route('vendor-shop-edit',$data->id) . '" class="edit" data-toggle="modal" data-target="#modal1"> <i class="fas fa-edit"></i>'.__('Edit').'</a><a href="javascript:;" data-href="' . route('vendor-shop-delete',$data->id) . '" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
                            }) 
                            ->rawColumns(['action','status'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }

    public function index(){
        return view('vendor.shop.index');
    }

    //*** GET Request
    public function create()
    {
        $sign = $this->curr;
        $categories = $this->userCategories();
        $countries = Country::orderBy('country_name', 'asc')->get();
        return view('vendor.shop.create',compact('sign', 'categories', 'countries'));
    }

    //*** POST Request
    public function store(Request $request)
    {
        //--- Validation Section
        $rules = ['shop_name' => 'required'];
        $customs = ['shop_name.required' => __('Shop Name is required.')];
        $validator = Validator::make($request->all(), $rules, $customs);
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
        $sign = $this->curr;
        $data = new UserShop();
        $input = $request->all();
        if ($file = $request->file('shop_image'))
         {
            $name = \PriceHelper::ImageCreateName($file);
            $file->move('assets/images/categories',$name);
            $input['shop_image'] = $name;
        }
        if ($file = $request->file('shop_banner'))
        {
            $name = \PriceHelper::ImageCreateName($file);
            $file->move('assets/images/categories',$name);
            $input['shop_banner'] = $name;
        }
        $input['user_id'] = $this->user->id;
        $input['status'] = 1;
        $data->fill($input)->save();
        //--- Logic Section Ends

        //--- Redirect Section        
        $msg = __('New Data Added Successfully.');
        return response()->json($msg);      
        //--- Redirect Section Ends    
    }

    //*** GET Request
    public function edit($id)
    {
        $sign = $this->curr;
        $data = UserShop::findOrFail($id);
        $categories = $this->userCategories();
        $countries = Country::orderBy('country_name', 'asc')->get();
        return view('vendor.shop.edit',compact('data','sign', 'categories', 'countries'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {
        //--- Validation Section
        $rules = ['shop_name' => 'required'];
        $customs = ['shop_name.required' => __('This shop name is required.')];
        $validator = Validator::make($request->all(), $rules, $customs);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }        
        //--- Validation Section Ends

        //--- Logic Section
        $sign = $this->curr;
        $data = UserShop::findOrFail($id);
        $input = $request->all();
        if ($file = $request->file('shop_image'))
            {
                $name = \PriceHelper::ImageCreateName($file);
                $file->move('assets/images/categories',$name);
                if($data->shop_image != null)
                {
                    if (file_exists(public_path().'/assets/images/categories/'.$data->shop_image)) {
                        unlink(public_path().'/assets/images/categories/'.$data->shop_image);
                    }
                }
            $input['shop_image'] = $name;
            }
        if ($file = $request->file('shop_banner'))
            {
                $name = \PriceHelper::ImageCreateName($file);
                $file->move('assets/images/categories',$name);
                if($data->shop_banner != null)
                {
                    if (file_exists(public_path().'/assets/images/categories/'.$data->shop_banner)) {
                        unlink(public_path().'/assets/images/categories/'.$data->shop_banner);
                    }
                }
            $input['shop_banner'] = $name;
            }
        $data->update($input);
        //--- Logic Section Ends

        //--- Redirect Section     
        $msg = __('Data Updated Successfully.');
        return response()->json($msg);      
        //--- Redirect Section Ends            
    }

    public function status($id1,$id2)
      {
          $data = UserShop::findOrFail($id1);
          $data->status = $id2;
          $data->update();
          //--- Redirect Section
          $msg = __('Status Updated Successfully.');
          return response()->json($msg);
          //--- Redirect Section Ends
      }

    //*** GET Request Delete
    public function destroy($id)
    {
        $data = UserShop::findOrFail($id);
        $data->delete();
        //--- Redirect Section     
        $msg = __('Data Deleted Successfully.');
        return response()->json($msg);      
        //--- Redirect Section Ends     
    }
}