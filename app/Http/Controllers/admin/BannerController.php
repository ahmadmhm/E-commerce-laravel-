<?php
/**
 * Created by PhpStorm.
 * User: ahmad
 * Date: 4/3/2020
 * Time: 15:14
 */

namespace App\Http\Controllers\admin;


use App\Banner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BannerController extends Controller
{
    public function addBanner(Request $request){
        if($request->isMethod('post')){
            $banner = new Banner();
            $banner->link = $request->link;
            if($request->status == "on")
                $banner->status = 1;
            else
                $banner->status = 0;
            $banner->title = $request->banner_title;
            $banner->image = '';

            //saving the image
            $file = null;
            if($request->banner_image!=Null)
                $file = $request->file('banner_image');

            if($file){
                if ($file->isValid()) {

                    $fileName = time() . '_' . $banner->id .'_'. $file->getClientOriginalName();
                    $banner_Path = public_path() . '/images/frontend_images/banner/'.$fileName;

                    Image::make($file)->resize(1140,440)->save($banner_Path);

                    $banner->image = $fileName;
                }
                $banner->save() ;
            }
            return redirect()->route('admin.view_banners')->with('flash_message_success','banner added successfully');
        }
        return view('admin.banners.add_banner');
    }

    public function editBanner(Request $request){
        if(isset($request->id)){
            $banner = Banner::where('id',$request->id)->first();
            if($request->isMethod('post')){

                $banner->link = $request->link;
                $banner->title = $request->banner_title;

                if ($request->status == "on"){
                    $banner->status = 1;
                }else{
                    $banner->status = 0;
                }
                //saving the new image if exists
                $file = null;
                if($request->banner_image!=Null)
                    $file = $request->file('banner_image');

                if($file) {
                    if ($file->isValid()) {

                        $fileName = time() . '_' . $banner->id . '_' . $file->getClientOriginalName();
                        $banner_Path = public_path() . '/images/frontend_images/banner/' . $fileName;

                        Image::make($file)->resize(1140, 440)->save($banner_Path);

                        $banner->image = $fileName;
                    }
                }
                $banner->update();
                return redirect()->back()->with('flash_message_success','banner edited successfully');
//                return redirect()->route('admin.view_coupons')->with('flash_message_success','coupon added successfully');
            }
            return view('admin.banners.edit_banner', compact('banner'));
        }
        return redirect()->back();
    }

    public function viewBanners(){
        $banners = Banner::all();
        return view('admin.banners.view_banners',compact('banners'));

    }

    public function activateBanner(Request $request){
        if($request->ajax()){
            if(isset($request->id)){
                $banner = Banner::where('id',$request->id)->first();
                $banner->toggleStatus()->save();
                return response()->json(['status'=>$banner->status]);
            }
        }
        return response()->json(['error']);

    }

    public function deleteBanner($id =null){
        if($id != null)
            Banner::destroy($id);
        return redirect()->back()->with('flash_message_success','banner deleted successfully');
    }

    public function deleteBannerImage($id =null){
        if($id != null){
            $banner = Banner::where('id', $id)->first();
            if($banner){
                if(file_exists(public_path().'/images/frontend_images/banner/'.$banner->image)) {
                    unlink(public_path().'/images/frontend_images/banner/'.$banner->image);
                }
                $banner ->update(['image' => '']);
            }
        }
        return redirect()->back()->with('flash_message_success','banner image deleted successfully');
    }
}