<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Title;
use App\Models\Translation;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redis;

class LangController extends Controller {

    public function index(Request $request) {
        Redis::set('name', 'Taylor');
        $values = Redis::lrange('names', 5, 10);
        echo '<pre>';
        print_r(Redis::get('name')
        );
        die;
        $lang = Title::with(['translations'])->whereHas('translations', function ($query) use ($request) {
            $query->where('lang_id', '=', $request['lang_id']);
        })
                                                ->get();
        //        where('lang_id','=', $request['lang_id'])->select(['translations.content','titles.lang_title'])->translati();
//        echo '<pre>';
//        print_r($request['lang_id']);
//        echo '<pre>';
//        print_r($lang);
//        die;
        return LangResources::collection($lang);
//        return view('lang');
    }

    public function change(Request $request) {
        App::setLocale($request->lang);
        session()->put('locale', $request->lang);
        return redirect()->back();
    }
}

//public function map($request)
//{
//    return [
//    'lang_title' => $request->lang_title,
//    'content' => $request->translations->lang_title,
//    ]
//}
