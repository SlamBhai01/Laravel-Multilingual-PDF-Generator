<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslateController extends Controller
{
    public function index()
    {
        return view('translate');
    }

    public function translate(Request $request)
    {
        $request->validate([
            'text' => 'required|string',
            'lang' => 'required|string'
        ]);

        try {
            $tr = new GoogleTranslate();
            $tr->setSource('auto');
            $tr->setTarget($request->lang);
            $result = $tr->translate($request->text);

            return response()->json([
                'status' => 'success',
                'translation' => $result,
                'target_language' => $request->lang
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Translation failed!',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
