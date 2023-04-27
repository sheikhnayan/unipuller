<?php

namespace App\Http\Controllers\Vendor;

use App\{
    Models\Gallery,
    Models\Product
};
use App\Models\ServiceGallery;
use App\Models\UserService;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Str;

class GalleryController extends VendorBaseController
{

    public function show()
    {
        $data[0] = 0;
        $id = $_GET['id'];
        $prod = Product::findOrFail($id);
        if(count($prod->galleries))
        {
            $data[0] = 1;
            $data[1] = $prod->galleries;
        }
        return response()->json($data);              
    }  

    public function store(Request $request)
    { 
        $data = null;
        $lastid = $request->product_id;
        if ($files = $request->file('gallery')){
            foreach ($files as  $key => $file){
                $val = $file->getClientOriginalExtension();
                if($val == 'jpeg'|| $val == 'jpg'|| $val == 'png'|| $val == 'svg')
                  {
                    $gallery = new Gallery;

                    $img = Image::make($file->getRealPath())->resize(800, 800);
                    $thumbnail = time().Str::random(8).'.jpg';
                    $img->save(public_path().'/assets/images/galleries/'.$thumbnail);

                    $gallery['photo'] = $thumbnail;
                    $gallery['product_id'] = $lastid;
                    $gallery->save();
                    $data[] = $gallery;                        
                  }
            }
        }
        return response()->json($data);      
    } 

    public function destroy()
    {
        $id = $_GET['id'];
        $gal = Gallery::findOrFail($id);
            if (file_exists(public_path().'/assets/images/galleries/'.$gal->photo)) {
                unlink(public_path().'/assets/images/galleries/'.$gal->photo);
            }
        $gal->delete(); 
    } 
    public function serviceshow()
    {
        $data[0] = 0;
        $id = $_GET['id'];
        $prod = UserService::findOrFail($id);
        if(count($prod->galleries))
        {
            $data[0] = 1;
            $data[1] = $prod->galleries;
        }
        return response()->json($data);              
    }  

    public function servicestore(Request $request)
    { 
        $data = null;
        $lastid = $request->service_id;
        if ($files = $request->file('gallery')){
            foreach ($files as  $key => $file){
                $val = $file->getClientOriginalExtension();
                if($val == 'jpeg'|| $val == 'jpg'|| $val == 'png'|| $val == 'svg')
                  {
                    $gallery = new ServiceGallery();

                    $img = Image::make($file->getRealPath())->resize(800, 800);
                    $thumbnail = time().Str::random(8).'.jpg';
                    $img->save(public_path().'/assets/images/galleries/'.$thumbnail);

                    $gallery['photo'] = $thumbnail;
                    $gallery['service_id'] = $lastid;
                    $gallery->save();
                    $data[] = $gallery;                        
                  }
            }
        }
        return response()->json($data);      
    } 

    public function servicedestroy()
    {
        $id = $_GET['id'];
        $gal = ServiceGallery::findOrFail($id);
            if (file_exists(public_path().'/assets/images/galleries/'.$gal->photo)) {
                unlink(public_path().'/assets/images/galleries/'.$gal->photo);
            }
        $gal->delete(); 
    } 

}