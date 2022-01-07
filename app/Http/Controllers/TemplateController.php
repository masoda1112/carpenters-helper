<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Template;
use App\Http\Requests\TemplateRequest;


class TemplateController extends Controller
{
    //
    public function index(){
        $templates = Template::all();
        return view('templates')->with(['templates'=>$templates]);
    }

    public function show(Template $template){
        return view('template')->with(['template'=>$template]);
    }

    public function new(){
        return view('newtemplate');
    }

    public function create(TemplateRequest $request){
        $template = new Template();
        $this->createHelper($request,$template);
        return redirect('/templates');
    }

    public function update(TemplateRequest $request, Template $template){
        $this->createHelper($request,$template);
        return redirect('/templates');
    }

    public function destroy(Template $template){
        $template->delete();
        return redirect('/templates');
    }

    private function createHelper(TemplateRequest $request, Template $template): void{
        $template->title = $request->title;
        $template->body = $request->body;
        $template->save();
    }
}


