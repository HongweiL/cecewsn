<?php
/**
 * Created by PhpStorm.
 * User: Youwen
 * Date: 2018/10/21
 * Time: 17:35
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class ConfigController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function HRMS_new() {
        $hrms_id = DB::table("ms_system") -> insertGetId([
            "brand" => Input::get("brand"),
            "model" => Input::get("model"),
            "class" => Input::get("class"),
            "sources" => Input::get("sources"),
        ]);
        DB::table("user_hrms") -> insert(["hrms_id" => $hrms_id, "user_id" => Auth::id()]);
    }

    public function HRMS_get() {
        $list = DB::select("select ms_system.hrms_id,ms_system.brand,ms_system.model,ms_system.class cls, ms_system.sources  from ms_system inner join user_hrms on user_hrms.hrms_id=ms_system.hrms_id where user_hrms.user_id = ?",[Auth::id()]);
        $data = [];
        foreach ($list as $hrms) {
            array_push($data, array(
                "id" => $hrms -> hrms_id,
                "brand" => $hrms -> brand,
                "model" => $hrms -> model,
                "class" => $hrms -> cls,
                "sources" => $hrms -> sources,
            ));
        }
        return array("code" => 0, "msg" => "", "count" => count($list), "data" => $data);
    }

    public function HRMS_mod() {
        DB::table('ms_system') -> where('hrms_id', Input::get("id")) -> update([
                "brand" => Input::get("brand"),
                "model" => Input::get("model"),
                "class" => Input::get("class"),
                "sources" => Input::get("sources"),
        ]);
    }
}