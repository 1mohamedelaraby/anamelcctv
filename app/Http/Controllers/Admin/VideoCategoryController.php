<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\VideoCategory;
use Illuminate\Http\Request;

class VideoCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videoCategories = VideoCategory::withCount('videos')->get();
        return view('adminVideo.category.index', compact('videoCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminVideo.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
        ]);

        VideoCategory::create($data);

        return back()->with('success', 'تمت الاضافة بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(VideoCategory $videoCategory)
    {
        return view('adminVideo.category.edit', compact('videoCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VideoCategory $videoCategory)
    {
        $data = $request->validate([
            'name' => 'required',
        ]);

        $videoCategory->update($data);

        return back()->with('success', 'تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(VideoCategory $videoCategory)
    {
        try {
            $videoCategory->delete();
        } catch (\Throwable $th) {
            return back()->with('error', 'لا يمكن حذف قسم يحتوي على فيديوهات .. برجاء حذف او نقل الفيديوهات من هذا القسم اولا');
        }

        return back()->with('success', 'تم الحذف بنجاح');
    }
}
