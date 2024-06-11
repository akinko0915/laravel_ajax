<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    
    public function index(){
        return view('menu');
    }

    public function postMenu(Request $request)
    {
        $menu = new Menu();
        $menu->staple = $request->input('staple');
        $menu->main = $request->input('main');
        $menu->sub = $request->input('sub');
        $menu->soup = $request->input('soup');
        $menu->drink = $request->input('drink');
        $menu->dessert = $request->input('dessert');
        $menu->save();

        return response()->json($menu);
    }

}
