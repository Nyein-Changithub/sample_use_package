<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pkg\MyPackage\MyPackageController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;



class ImageController extends Controller    
{
    public function index()
    {

        $token = config('cloudflareImage.api_token');
        $account_id = config('cloudflareImage.id_account');

        $response = Http::withToken($token)->get("https://api.cloudflare.com/client/v4/accounts/{$account_id}/images/v1");
        $images = $response->successful() ? $response->json()['result']: [];

         // Filter to avoid missing keys
         $images = collect($images)
         ->filter(fn($img) => isset($img['id'], $img['variants'][0]))
         ->values()
         ->all();

        return view('images.index', compact('images'))->with('message', 'Image uploaded successfully!');
    }

    public function create()
    {
        return view('images.create');
    }

    public function store(Request $request)
    {
        $myPackage = new MyPackageController();
        $response = $myPackage->uploadToCloudflare($request);

        if (isset($response['result']) && isset($response['success'])) {

            $uploadedImage = $response['result'];
            return view('images.index', ['images' => [$uploadedImage]])
            ->with('message', 'Image uploaded successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to upload image.');
        }

    }

    public function destroy(Request $request,$id)
    {
        $myPackage = new MyPackageController();
        $response = $myPackage->deleteFromCloudflare($id);

        $message = $response ? "Image Delete Successfully!" : "Failed to delete image!";

        return redirect()->route('images.index')->with('message', $message);
    }
}

