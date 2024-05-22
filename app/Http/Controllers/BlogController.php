<?php

namespace App\Http\Controllers;

use App\Models\Blog;

class BlogController extends Controller
{
    public function dateOnly($strDate)
    {
        $strYear = date("Y", strtotime($strDate)) + 543;
        $strMonth = date("n", strtotime($strDate));
        $strDay = date("j", strtotime($strDate));
        $strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
        $strMonthThai = $strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear";
    }
    public function timeOnly($strDate)
    {
        $strHour = date("H", strtotime($strDate));
        $strMinute = date("i", strtotime($strDate));
        $strSeconds = date("s", strtotime($strDate));
        return "$strHour:$strMinute:$strSeconds";
    }
    public function index()
    {
        $blogs = Blog::with('tags')->get();

        return view('blogs', [
            'blogs' => $blogs,
            'thisController' => $this
        ]);
    }

    public function detail($id)
    {
        $blog = Blog::with('tags')
        ->with('user')->findOrFail($id)
        ->where('id', $id)
        ->first();

        return view('blog', [
            'blog' => $blog,
            'thisController' => $this
        ]);
    }
}
