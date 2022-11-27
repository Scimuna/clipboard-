<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ClipboardController extends Controller
{
    //
    public function index()
    {

        return view('index');
    }

    public function submitcontent(Request $request)
    {
        $validated = $request->validate([
            "content" => '',
            "file" => "mimes:png,jpg,pptx,doc,docx,pdf,xls, jpeg,bmp, gif,webp|max:3048"
        ]);

        if ($validated) {
            $request->hasFile('file') ? $uploadedFileUrl = $request->file('file')->storeOnCloudinary() : $uploadedFileUrl = "no image";
            $uploadedFileUrl = Cloudinary::getUrl($uploadedFileUrl->getPublicId());
            DB::beginTransaction();
            $code = uniqid();
            $content = new  Content();
            $content->content = $request->content;
            $content->file_url = $uploadedFileUrl;
            $content->code = $code;
            $content->save();
            DB::commit();
            Session::flash('message', "Your content has been captured successfully! Kindly give the retriever this code $code to access your content");
            return redirect()->route('index');
        }
    }

    public function getContent(Request $request)
    {
        $result = Content::where('code', "=", $request->code)->first();
        return redirect('/')->with('result', $result);
    }

    public function download(Request $request)
    {
        $filename = 'temp-image.jpg';
        $tempImage = tempnam(sys_get_temp_dir(), $filename);
        copy($request->image_url, $tempImage);
        Session::flash('download-message', "Your file has downloaded successfully!");
        return response()->download($tempImage, $filename);
    }
}
