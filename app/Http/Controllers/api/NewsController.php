<?php

namespace App\Http\Controllers\api;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function store(Request $request)
        {
            if($request->file('image_url')){
                $upload_location = 'upload/news/';
                $file = $request->file('image_url');
                $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
                Image::make($file)->resize(870,370)->save($upload_location.$name_gen);
                $save_url = $upload_location.$name_gen;
            
                News::create([
                    'title' => $request->input('title'),
                    'type' => $request->input('type'),
                    'content' => $request->input('content'),
                    'description' => $request->input('description'),
                    'image_url' => $save_url
                ]);
                return response()->json(
                    ['success'=>true , 'message'=>' news added' ,'news title'=>$request->input('title')]);
            }else{
                News::create([
                    'type' => $request->input('type'),
                    'title' => $request->input('title'),
                    'description' => $request->input('description'),
                    'content' => $request->input('content'),
                    'image_url' => $request->input('image_url')
                ]);
                return response()->json(
                    ['success'=>true , 'message'=>'news added' ,'news'=>$request->input('title')]);
            }
            return response()->json(
                ['success'=>false , 'message'=>'news not added' ,'news'=>null]);
        }
    
        
        public function get_all_news()
        {
            $news = News::All();
            if($news)
            {
                return response()->json(
                    ['success' => true , 'message' => 'found' , 'news' => $news]
                );
            }
            return response()->json(
                ['success'=>false , 'message'=>'not found', 'news'=>null]
            );
        }
    
        public function get_news_by_type($type)
        {
            $news = News::where('type','like','%'.$type.'%')->get();
            if(!($news==null))
            {
                return response()->json(
                    ['success' => true , 'message' => 'found' , 'news' => $news]
                );
            }
            return response()->json(
                ['success'=>false , 'message'=>'not found', 'news'=>null]
            );
        }
    
        public function get_news($id)
        {
            $news = News::find($id);
            if($news)
            {
                return response()->json(
                    ['success' => true , 'message' => 'found' , 'news' => $news]
                );
            }
            return response()->json(
                ['success'=>false , 'message'=>'not found', 'news'=>null]
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
            $news = News::where('title' , $title)->first();
            if($news)
            {
                $news->update($request->only('title' , 'title','image_url','description','type','status','content'));
                return response()->json([ 'success'=>true , 'message'=>'Updated successfully'] );
            }
            return response()->json([ 'success'=>false , 'message'=>'not updated'] );
        }
    
        
        public function destroy($id)
        {
            $news = News::find($id);
            if($news && $news->delete())
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
