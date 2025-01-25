<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Nette\Utils\Image;
use App\Models\SliderPanel;
use Illuminate\Http\Request;

class SliderPanelController extends Controller
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
            $upload_location = 'upload/sliders/';
            $file = $request->file('image_url');
            $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            Image::make($file)->resize(870,370)->save($upload_location.$name_gen);
            $save_url = $upload_location.$name_gen;
        
            SliderPanel::create([
                'isSlide' => $request->input('isSlide'),
                'name' => $request->input('name'),
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'image_url' => $save_url
            ]);
            return response()->json(
                ['success'=>true , 'message'=>'slide_panel added' ,'slide_panel'=>$request->input('name')]);
        }else{
            SliderPanel::create([
                'isSlide' => $request->input('isSlide'),
                'name' => $request->input('name'),
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'image_url' => $request->input('image_url')
            ]);
            return response()->json(
                ['success'=>true , 'message'=>'slide_panel added' ,'slide_panel'=>$request->input('name')]);
        }
        return response()->json(
            ['success'=>false , 'message'=>'slide_panel not added' ,'slide_panel'=>null]);
    }

    
    public function get_sliders()
    {
        $sliders = SliderPanel::where('isSlide',true)->get();
        if($sliders)
        {
            return response()->json(
                ['success' => true , 'message' => 'found' , 'sliders' => $sliders]
            );
        }
        return response()->json(
            ['success'=>false , 'message'=>'not found', 'Sliders'=>null]
        );
    }

    public function get_panels()
    {
        $panels = SliderPanel::where('isSlide',false)->get();
        if($panels)
        {
            return response()->json(
                ['success' => true , 'message' => 'found' , 'panels' => $panels]
            );
        }
        return response()->json(
            ['success'=>false , 'message'=>'not found', 'Panels'=>null]
        );
    }


    public function get_slide_panel($id)
    {
        $slidePanel = SliderPanel::find($id);
        if($slidePanel)
        {
            return response()->json(
                ['success' => true , 'message' => 'found' , 'slidePanel' => $slidePanel]
            );
        }
        return response()->json(
            ['success'=>false , 'message'=>'not found', 'slidePanel'=>null]
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

    public function update(Request $request, $name)
    {
        $sliderPanel = SliderPanel::where('name' , $name)->first();
        if($sliderPanel)
        {
            $sliderPanel->update($request->only('name' , 'title','image_url','description','isSlide','enabled'));
            return response()->json([ 'success'=>true , 'message'=>'Updated successfully'] );
        }
        return response()->json([ 'success'=>false , 'message'=>'not updated'] );
    }

    
    public function destroy($id)
    {
        $sliderPanel = SliderPanel::find($id);
        if($sliderPanel && $sliderPanel->delete())
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