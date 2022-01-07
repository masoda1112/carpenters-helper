<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carpenter;
use App\Http\Requests\CarpenterRequest;
use JD\Cloudder\Facades\Cloudder;

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
            Cloudder::destroyImage($carpenter->cloudinary_public_id);
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
        $image_path = $request->img->getRealPath();
        Cloudder::upload($image_path, null);
        $publicId = Cloudder::getPublicId();
        $logoUrl = Cloudder::secureShow($publicId, [
            'width'     => 500,
            'height'    => 500
        ]);
        $logoUrl = Cloudder::secureShow($publicId);
        $carpenter->img = $logoUrl;
        $carpenter->cloudinary_public_id = $publicId;
    }
}
