<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Title;
use App\Models\Translation;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redis;
use Response;

class LangController extends Controller {

    public function index(Request $request) {

        if ($data = Redis::get('lang_id_' . $request['lang_id'])) {
            //            echo PHP_EOL;
            //            print_r($data);
            //            echo PHP_EOL;
            //            die;
            return $data;
        } else {
            $translations = Translation::where('lang_id', '=', $request['lang_id'])->select([
                'translations.content',
                'translations.lang_id',
                'titles.lang_title',
            ])->join('titles', 'titles.id', '=', 'translations.title_id')->get();
            $result       = [];
            foreach ($translations as $item) {
                $result[$item['lang_title']] = $item['content'];
            }
            //        echo PHP_EOL;
            //        print_r(json_encode($result));
            //        echo PHP_EOL;
            //        die;
            Redis::set('lang_id_' . $request['lang_id'], json_encode($result));
            Redis::expire('lang_id_' . $request['lang_id'], 3600 * 24);
            $data['lang_id_' . $request['lang_id']] = $result;
            return response()->json($result, 200);
        }
    }

    public function change(Request $request) {
        App::setLocale($request->lang);
        session()->put('locale', $request->lang);
        return redirect()->back();
    }
}


