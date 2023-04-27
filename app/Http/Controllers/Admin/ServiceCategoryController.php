<?php

namespace App\Http\Controllers\Admin;

use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Validator;
use Datatables;

class ServiceCategoryController extends AdminBaseController
{
    //*** JSON Request
    public function datatables()
    {
         $datas = ServiceCategory::latest('id')->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->addColumn('status', function(ServiceCategory $data) {
                                $class = $data->status == 1 ? 'drop-success' : 'drop-danger';
                                $s = $data->status == 1 ? 'selected' : '';
                                $ns = $data->status == 0 ? 'selected' : '';
                                return '<div class="action-list"><select class="process select droplinks '.$class.'"><option data-val="1" value="'. route('admin-cat-status',['id1' => $data->id, 'id2' => 1]).'" '.$s.'>'.__("Activated").'</option><option data-val="0" value="'. route('admin-cat-status',['id1' => $data->id, 'id2' => 0]).'" '.$ns.'>'.__("Deactivated").'</option>/select></div>';
                            })
                            ->addColumn('attributes', function(ServiceCategory $data) {
                                $buttons = '<div class="action-list"><a data-href="' . route('admin-attr-createForCategory', $data->id) . '" class="attribute" data-toggle="modal" data-target="#attribute"> <i class="fas fa-edit"></i>'.__("Create").'</a>';
                                if ($data->attributes()->count() > 0) {
                                  $buttons .= '<a href="' . route('admin-attr-manage', $data->id) .'?type=category' . '" class="edit"> <i class="fas fa-edit"></i>'.__("Manage").'</a>';
                                }
                                $buttons .= '</div>';

                                return $buttons;
                            })
                            ->addColumn('action', function(ServiceCategory $data) {
                                return '<div class="action-list"><a data-href="' . route('admin-service-cat-edit',$data->id) . '" class="edit" data-toggle="modal" data-target="#modal1"> <i class="fas fa-edit"></i>'.__('Edit').'</a><a href="javascript:;" data-href="' . route('admin-service-cat-delete',$data->id) . '" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
                            })
                            ->rawColumns(['status','attributes','action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }

    public function index(){
        return view('admin.service-category.index');
    }

    public function create(){
        return view('admin.service-category.create');
    }
    //*** POST Request
    public function store(Request $request)
    {
        //--- Validation Section
        $rules = [
            'photo' => 'mimes:jpeg,jpg,png,svg',
            'slug' => 'unique:categories|regex:/^[a-zA-Z0-9\s-]+$/',
            'image' => 'required|mimes:jpeg,jpg,png,svg'
                 ];
        $customs = [
            'photo.mimes' => __('Icon Type is Invalid.'),
            'slug.unique' => __('This slug has already been taken.'),
            'slug.regex' => __('Slug Must Not Have Any Special Characters.'),
            'image.required' => __('Banner Image is required.'),
            'image.mimes' => __('Banner Image Type is Invalid.')
                   ];
        $validator = Validator::make($request->all(), $rules, $customs);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
        $data = new ServiceCategory();
        $input = $request->all();
        if ($file = $request->file('photo'))
         {
            $name = \PriceHelper::ImageCreateName($file);
            $file->move('assets/images/categories',$name);
            $input['photo'] = $name;
        }
        if ($file = $request->file('image'))
        {
            $name = \PriceHelper::ImageCreateName($file);
            $file->move('assets/images/categories',$name);
            $input['image'] = $name;
        }

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
        $data = ServiceCategory::findOrFail($id);
        return view('admin.service-category.edit',compact('data'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {
        //--- Validation Section
        $rules = [
        	'photo' => 'mimes:jpeg,jpg,png,svg',
            'slug' => 'unique:categories,slug,'.$id.'|regex:/^[a-zA-Z0-9\s-]+$/',
            'image' => 'mimes:jpeg,jpg,png,svg'
        		 ];
        $customs = [
            'photo.mimes' => __('Icon Type is Invalid.'),
            'slug.unique' => __('This slug has already been taken.'),
            'slug.regex' => __('Slug Must Not Have Any Special Characters.'),
            'image.mimes' => __('Banner Image Type is Invalid.')
        		   ];
        $validator = Validator::make($request->all(), $rules, $customs);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
        $data = ServiceCategory::findOrFail($id);
        $input = $request->all();
            if ($file = $request->file('photo'))
            {
                $name = \PriceHelper::ImageCreateName($file);
                $file->move('assets/images/categories',$name);
                if($data->photo != null)
                {
                    if (file_exists(public_path().'/assets/images/categories/'.$data->photo)) {
                        unlink(public_path().'/assets/images/categories/'.$data->photo);
                    }
                }
            $input['photo'] = $name;
            }
            if ($file = $request->file('image'))
            {
                $name = \PriceHelper::ImageCreateName($file);
                $file->move('assets/images/categories',$name);
                $input['image'] = $name;
            }


        $data->update($input);
        //--- Logic Section Ends

        //--- Redirect Section
        $msg = __('Data Updated Successfully.');
        return response()->json($msg);
        //--- Redirect Section Ends
    }

      //*** GET Request Status
      public function status($id1,$id2)
      {
          $data = ServiceCategory::findOrFail($id1);
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
        $data = ServiceCategory::findOrFail($id);

        if($data->attributes->count() > 0)
        {
        //--- Redirect Section
        $msg = __('Remove the Attributes first !');
        return response()->json($msg);
        //--- Redirect Section Ends
        }
        

        //If Photo Exist
        if (file_exists(public_path().'/assets/images/categories/'.$data->photo)) {
            unlink(public_path().'/assets/images/categories/'.$data->photo);
        }
        if (file_exists(public_path().'/assets/images/categories/'.$data->image)) {
            unlink(public_path().'/assets/images/categories/'.$data->image);
        }
        $data->delete();
        //--- Redirect Section
        $msg = __('Data Deleted Successfully.');
        return response()->json($msg);
        //--- Redirect Section Ends
    }
}