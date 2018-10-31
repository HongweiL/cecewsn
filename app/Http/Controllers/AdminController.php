<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class AdminController extends Controller
{
    /**
     * List All user in database
     *
     * @return array
     */
    public function getUserList() {
        $users = DB::select("select * from users");
        $count = DB::table("users") -> count();
        $data = [];
        foreach ($users as $user) {
            array_push($data, array(
                "id" => $user -> id,
                "role" => ($user -> role == 0)?"Inactive":($user -> role == 1?"Active":'[ Admin ]'),
                "fname" => $user -> fname,
                "lname" => $user -> lname,
                "affiliation" => $user -> affiliation,
                "email" => $user -> email,
                "created_at" => $user -> created_at,));
        };
        return array("code" => 0, "msg" => "", "count" => $count, "data" => $data);
    }

    /**
     * Manager of user, using for activate and deactivate users.
     *
     * @return null|string
     */
    public function manage() {
        if (User::getRole() == 10) {
            if (Input::get("id") != null && Input::get("action") != null) {
                $users = DB::select("select * from users where id = ?", [Input::get("id")]);
                foreach ($users as $user) {
                    switch ($user -> role) {
                        case 0:
                            if ($_REQUEST["action"] == 2) {
                                return "No change.";
                            } else if ($_REQUEST["action"] == 1) {
                                DB::update("update users set role = 1 where id = ?", [Input::get("id")]);
                                return "This user is now activated. :-)";
                            }
                            break;
                        case 1:
                            if ($_REQUEST["action"] == 1) {
                                return "No change.";
                            } else if ($_REQUEST["action"] == 2) {
                                DB::update("update users set role = 0 where id = ?", [Input::get("id")]);
                                return "This user is now deactivated. :-(";
                            }
                            break;
                        case 10:
                            return "I will not allow this to be happened :-D";
                    }
                }
            }
        }
        return null;
    }
}
