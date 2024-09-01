<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HtmlTagController extends Controller
{
    public function bold(Request $request)
    {
        $text = $request->input('text');
        $boldText = '<b>' . $text . '</b>';
        return response()->json(['text' => $boldText]);
    }

    public function italic(Request $request)
    {
        $text = $request->input('text');
        $italicText = '<i>' . $text . '</i>';
        return response()->json(['text' => $italicText]);
    }

    public function color(Request $request)
    {
        $text = $request->input('text');
        $color = $request->input('color');
        $coloredText = '<span style="color:' . $color . ';">' . $text . '</span>';
        return response()->json(['text' => $coloredText]);
    }
}
