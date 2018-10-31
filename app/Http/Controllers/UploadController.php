<?php
/**
 * Created by PhpStorm.
 * User: youwen
 * Date: 7/9/18
 * Time: 16:26
 */

namespace App\Http\Controllers;

use App\API\Process;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Aws\S3\S3Client;

require_once app_path().'/API/aws/aws-autoloader.php';

class UploadController extends Controller
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

    /**
     * Download info template file
     * @return mixed
     */
    public function getTemplate() {
        return response()->download(public_path()."/template/Sample_information_template.xlsx");
    }

    /**
     * Record user upload
     */
    public function recordUpload() {
        if (Input::get("name") != null) {
            DB::insert("insert into jobs(job_name, user_id, create_time, location, type, date) values(?, ?, ?, ?, ?, ?)",[Input::get("name"), Auth::id(), date("Y-m-d h:i:s",time()), Input::get('loc'), Input::get('type'), Input::get('date')]);
        }
    }

    /**
     * Get jobs of the user
     * @return array
     */
    public function getJobs() {
        $list = DB::select("select * from jobs where user_id = ?",[Auth::id()]);
        $data = [];
        foreach ($list as $job) {
            array_push($data, array(
                "job_id" => $job -> job_id,
                "finished" => ($job -> finished == '0')?"Pending":(($job -> finished == '1')?"Imported":"Finished"),
                "job_name" => $job -> job_name,
                "date" => $job -> date,
                "loc" => $job -> location,
                "type" => $job -> type,
                "create_time" => $job -> create_time,
            ));
        }
        return array("code" => 0, "msg" => "", "count" => count($list), "data" => $data);
    }

    /**
     * Download imported result file
     *
     * @return mixed
     */
    public function ImportedResult() {
        if (Input::get("name") != null) {
            $bucket = 'cecewsn';
            $s3 = new S3Client([
                'version' => 'latest',
                'region'  => 'ap-southeast-2',
                'credentials' => [
                    'key'    => env('AWS_KEY'),
                    'secret' => env('AWS_SECRET')
                ]
            ]);
            $list = $s3 -> ListObjects(array(
                'Bucket' => $bucket,
                'Prefix' => "processed/".Auth::id()."/".Input::get("name")."/deconv/",
            ));
            return $s3 -> getObjectUrl($bucket, end($list['Contents'])['Key']);
        }
    }

    /**
     * Download search result file
     *
     * @return mixed
     */
    public function SearchResult() {
        if (Input::get("name") != null) {
            $bucket = 'cecewsn';
            $s3 = new S3Client([
                'version' => 'latest',
                'region'  => 'ap-southeast-2',
                'credentials' => [
                    'key'    => env('AWS_KEY'),
                    'secret' => env('AWS_SECRET')
                ]
            ]);
            $list = $s3 -> ListObjects(array(
                'Bucket' => $bucket,
                'Prefix' => "processed/".Auth::id()."/".Input::get("name")."/ULSA/",
            ));
            return $s3 -> getObjectUrl($bucket, end($list['Contents'])['Key']);
        }
    }

    /**
     *
     */
    public function searchJob() {
        if (Input::get('job_name') != null) {
            $process = new Process();
            $process -> Search(Auth::id(), Input::get('job_name'));
        }
    }
}
