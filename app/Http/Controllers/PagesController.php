<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{


public function index()
{
    $title=" niit laravel";
return view('pages.index',compact('title'));

//return view('pages.index')->with('tit',$title);
}
public function about()
{

return view('pages.about');
}
public function services()
{
$data=array("title"=>"Our services","service"=>["PHP","PYTHON","JAVA",".NET"]);
return view('pages.services')->with($data);
}
}
