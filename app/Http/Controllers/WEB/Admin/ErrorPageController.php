<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\ErrorPage;
use Image;
use File;
class ErrorPageController extends Controller
{
    

    public function index()
    {
        $errorPages = ErrorPage::all();
        return view("admin.error_page", compact("errorPages"));
    }

    public function show($id)
    {
        $errorPage = ErrorPage::find($id);
        return response()->json(["errorPage" => $errorPage], 200);
    }

    public function update(Request $request, $id)
    {
        $errorPage = ErrorPage::find($id);
        $rules = [
            "page_name" => "required",
            "header" => "required",
        ];

        $customMessages = [
            "page_name.required" => trans(
                "admin_validation.Page name is required"
            ),
            "header.required" => trans("admin_validation.Header is required"),
            "button_text.required" => trans(
                "admin_validation.Button text is required"
            ),
        ];

        $this->validate($request, $rules, $customMessages);

        $errorPage->page_name = $request->page_name;
        $errorPage->header = $request->header;
        $errorPage->button_text = $request->button_text;
        $errorPage->save();

        if ($request->image) {
            $existing_banner = $errorPage->image;
            $extention = $request->image->getClientOriginalExtension();
            $banner_name =
                "errorpage" .
                date("-Y-m-d-h-i-s-") .
                rand(999, 9999) .
                "." .
                $extention;
            $banner_name = "uploads/website-images/" . $banner_name;
            Image::make($request->image)->save(
                public_path() . "/" . $banner_name
            );
            $errorPage->image = $banner_name;
            $errorPage->save();
            if ($existing_banner) {
                if (File::exists(public_path() . "/" . $existing_banner)) {
                    unlink(public_path() . "/" . $existing_banner);
                }
            }
        }

        $notification = trans("admin_validation.Updated Successfully");
        $notification = ["messege" => $notification, "alert-type" => "success"];
        return redirect()->back()->with($notification);
    }
}
