<?php

namespace App\Http\Controllers\api;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
        public function index()
        {
            //
        }
    
        public function create()
        {
            //
        }
    
        public function store(Request $request)
        {
            if($request->file('image_url')){
                $upload_location = 'upload/menus/';
                $file = $request->file('image_url');
                $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
                Image::make($file)->resize(870,370)->save($upload_location.$name_gen);
                $save_url = $upload_location.$name_gen;
            
                Menu::create([
                    'title' => $request->input('title'),
                    'type' => $request->input('type'),
                    'description' => $request->input('description'),
                    'image_url' => $save_url
                ]);
                return response()->json(
                    ['success'=>true , 'message'=>' menu added' ,'menu title'=>$request->input('title')]);
            }else{
                Menu::create([
                    'type' => $request->input('type'),
                    'title' => $request->input('title'),
                    'description' => $request->input('description'),
                    'image_url' => $request->input('image_url')
                ]);
                return response()->json(
                    ['success'=>true , 'message'=>'menu added' ,'menu'=>$request->input('title')]);
            }
            return response()->json(
                ['success'=>false , 'message'=>'menu not added' ,'menu'=>null]);
        }//done
    
        
        public function get_menus()
        {
            $menus = Menu::All();
            if($menus)
            {
                return response()->json(
                    ['success' => true , 'message' => 'found' , 'menus' => $menus]
                );
            }
            return response()->json(
                ['success'=>false , 'message'=>'not found', 'menus'=>null]
            );
        }//done
    
        public function get_menu_by_type($type)
        {
            $menus = Menu::where('type','like','%'.$type.'%')->get();
            if($menus)
            {
                return response()->json(
                    ['success' => true , 'message' => 'found' , 'menus' => $menus]
                );
            }
            return response()->json(
                ['success'=>false , 'message'=>'not found', 'Menus'=>null]
            );
        }//done
    
        public function get_menu($id)
        {
            $menu = Menu::find($id);
            if($menu)
            {
                return response()->json(
                    ['success' => true , 'message' => 'found' , 'menu' => $menu]
                );
            }
            return response()->json(
                ['success'=>false , 'message'=>'not found', 'menu'=>null]
            );
        }
    
        public function show(PanelPost $panelPost)
        {
           //$slider_panel = SliderPanel::
        }
    
        public function edit(PanelPost $panelPost)
        {
            //
        }
    
        public function update(Request $request, $title)
        {
            $menu = Menu::where('title' , $title)->first();
            if($menu)
            {
                $menu->update($request->only('title' , 'title','image_url','description','type'));
                return response()->json([ 'success'=>true , 'message'=>'Updated successfully'] );
            }
            return response()->json([ 'success'=>false , 'message'=>'not updated'] );
        }
    
        
        public function destroy($id)
        {
            $menu = Menu::find($id);
            if($menu && $menu->delete())
            {
                return response()->json([
                    'success' => true,
                    'message' => 'deleted'
                ]);
            }
            else{
                return response()->json(
                    ['success'=>false , 'message'=>'not deleted']);
            }
            
        }
}