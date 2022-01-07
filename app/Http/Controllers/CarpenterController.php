<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carpenter;
use App\Http\Requests\CarpenterRequest;
// use JD\Cloudder\Facades\Cloudder;
use Storage;

class CarpenterController extends Controller
{
    //
    public function index(){
        $carpenters = Carpenter::all();
        $test = "テスト";
        return view('carpenters')->with(['carpenters' => $carpenters]);
    }

    public function show(Carpenter $carpenter){
        return view('carpenter')->with(['carpenter' => $carpenter]);
    }

    public function new(){
        return view('newcarpenter');
    }

    public function create(CarpenterRequest $request){
        $carpenter = new Carpenter();
        $this->createHelper($request,$carpenter);
        return redirect('/carpenters');
    }

    public function update(CarpenterRequest $request, Carpenter $carpenter){
        $this->createHelper($request,$carpenter);
        return redirect('/carpenters');
    }

    public function destroy(Carpenter $carpenter){
        if($carpenter->img != null){
            Storage::disk('s3')->delete($carpenter->cloudinary_public_id);
            // Cloudder::destroyImage($carpenter->cloudinary_public_id);
        }
        $carpenter->delete();
        return redirect('/carpenters');
    }

    private function createHelper(CarpenterRequest $request,Carpenter $carpenter): void
    {
        $carpenter->name = $request->name;
        $carpenter->role = $request->role;
        if($request->img != null){
            $this->postImage($request,$carpenter);
        }
        $carpenter->save();
    }

    private function postImage(CarpenterRequest $request,Carpenter $carpenter) :void
    {
        $image = $request->file('img');
        $path = Storage::disk('s3')->putFile('/', $image, 'public');
        $carpenter->img = Storage::disk('s3')->url($path);
        $carpenter->cloudinary_public_id = $path;
                // Cloudder::upload($image_path, null);
        // $publicId = Cloudder::getPublicId();
        // $logoUrl = Cloudder::secureShow($publicId, [
        //     'width'     => 500,
        //     'height'    => 500
        // ]);
        // $logoUrl = Cloudder::secureShow($publicId);
    }
}
