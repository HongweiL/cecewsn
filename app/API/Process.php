<?php
/**
 * Created by PhpStorm.
 * User: youwen
 * Date: 7/9/18
 * Time: 17:03
 */

namespace App\API;

use Aws\S3\S3Client;
use Illuminate\Support\Facades\DB;

require_once __DIR__.'/aws/aws-autoloader.php';

class Process
{
    /**
     * Process files with method ImportDeconv.
     * It will first download files needed from S3, then run the python program locally.
     * After complete the progress, result will be sent back to S3.
     *
     */
    public function StartProcess() {
        $bucket = 'cecewsn';
        $s3 = new S3Client([
            'version' => 'latest',
            'region'  => 'ap-southeast-2',
            'credentials' => [
                'key'    => env('AWS_KEY'),
                'secret' => env('AWS_SECRET')
            ]
        ]);
        $list = self::getList($s3, $bucket, 'unprocessed/');
        $tmp = public_path().'/algorithms/tmp';
        $this->ImportOrImportSearch($bucket, $s3, $list, $tmp);

    }

    /**
     * ImportDeconv and DeconvLibrarySearch handler
     *
     * @param $bucket String bucket name
     * @param $s3 S3Client api instance
     * @param $list of files in S3
     * @param $tmp String path to tmp folder
     */
    public function ImportOrImportSearch($bucket, $s3, $list, $tmp) {
        if (!empty($list)) {
            foreach ($list as $user) {
                $userList = self::getList($s3, $bucket, $user);
                foreach ($userList as $dir) {
                    $size = $s3 -> ListObjects(array(
                        'Bucket' => $bucket,
                        'Prefix' => $dir,
                    ));
                    if (count($size['Contents']) >= 4) {
                        $this->clearDir($tmp);
                        $this -> getObject($dir,$tmp, $s3, $bucket);
                        $handler = opendir($tmp);
                        while( ($filename = readdir($handler)) !== false ) {
                            if($filename != "." && $filename != ".." && $filename != "High_Energy" && $filename != "Low_Energy" && $filename != "deconv" && $filename != "config.txt" && $filename != "ULSA" && $filename != "adducts"){
                                break;
                            }
                        }
                        $config = fopen($tmp."/config.txt", "r");
                        if ($config) {
                            fgets($config);
                            $method = fgets($config);
                            if ($method == "import" || $method == "combine\n") {
                                if ($method == "import") {
                                    exec('sudo bash '.public_path().'/algorithms/'.$method.'.sh '.$tmp.' '.$filename);
                                } else {
                                    $param = explode("-splitHere-", fgets($config));
                                    $handler = opendir($tmp."/adducts");
                                    while( ($adducts = readdir($handler)) !== false ) {
                                        if($adducts != "." && $adducts != ".." && $adducts != "_superseded"){
                                            break;
                                        }
                                    }
                                    exec('sudo bash '.public_path().'/algorithms/combine.sh '.public_path().'/algorithms'.' '.$filename.' '.$adducts.' '.$param[0].' '.$param[1]);
                                    $handler = opendir($tmp."/ULSA/");
                                    while( ($output = readdir($handler)) !== false ) {
                                        if($output != "." && $output != ".." && $output != "_superseded"){
                                            break;
                                        }
                                    }
                                    $s3 -> putObject(
                                        array(
                                            'Bucket' => $bucket,
                                            'Key'    => $dir."ULSA/$output",
                                            'SourceFile' => $tmp."/ULSA/".$output,
                                            'ACL'    => 'public-read'
                                        )
                                    );
                                }
                                $handler = opendir($tmp."/deconv/");
                                while( ($output = readdir($handler)) !== false ) {
                                    if($output != "." && $output != ".." && $output != "_superseded"){
                                        break;
                                    }
                                }
                                $s3 -> putObject(
                                    array(
                                        'Bucket' => $bucket,
                                        'Key'    => $dir."deconv/$output",
                                        'SourceFile' => $tmp."/deconv/".$output,
                                        'ACL'    => 'public-read'
                                    )
                                );
                                $this->moveFile($s3, $bucket, $dir);
                                $userid = explode("/", $user);
                                $job_name = explode("/", $dir);
                                if ($method == "import") {
                                    $finished = 1;
                                } else {
                                    $finished = 2;
                                }
                                DB::update('update jobs set finished = ? where job_name = ? AND user_id = ?', [$finished, $job_name[count($job_name)-2], $userid[count($userid)-2]]);
                            }
                            @fclose($config);
                        }
                    }
                }
            }
        }
    }

    /**
     * Download files from S3
     *
     * @param $dir String path to files on S3
     * @param $tmp String local path of temp folder
     * @param $s3 S3Client s3 api
     * @param $bucket String bucket name
     */
    public function getObject($dir, $tmp, $s3, $bucket) {
        try {
            $s3 -> downloadBucket($tmp, $bucket, $dir);
        } catch (S3Exception $e) {
            echo $e->getMessage() . PHP_EOL;
        }
    }

    /**
     * Processing files with LibrarySearch_v1
     *
     * @param $user_id int User id
     * @param $job_name string Job name
     */
    public function Search($user_id, $job_name) {
        $bucket = 'cecewsn';
        $s3 = new S3Client([
            'version' => 'latest',
            'region'  => 'ap-southeast-2',
            'credentials' => [
                'key'    => env('AWS_KEY'),
                'secret' => env('AWS_SECRET')
            ]
        ]);
        $dir = "processed/".$user_id."/".$job_name;
        $size = $s3 -> ListObjects(array(
            'Bucket' => $bucket,
            'Prefix' => $dir,
        ));
        if (count($size['Contents']) == 6) {
            $tmp = public_path().'/algorithms/tmp';
            $this->clearDir($tmp);
            exec("sudo mkdir ".$tmp."/adducts");
            exec("sudo mkdir ".$tmp."/ULSA");
            exec("sudo chmod 777 -R ".$tmp);
            $this -> getObject($dir,$tmp, $s3, $bucket);
            $handler = opendir($tmp."/adducts");
            if (($filename = readdir($handler)) !== false) {
                exec('sudo bash '.public_path().'/algorithms/search.sh '.public_path().'/algorithms'.$filename);
                $handler = opendir($tmp."/ULSA");
                $filename = readdir($handler);
                $s3 -> putObject(
                    array(
                        'Bucket' => $bucket,
                        'Key'    => $dir."/ULSA/$filename",
                        'SourceFile' => $tmp."/ULSA/".$filename,
                        'ACL'    => 'public-read'
                    )
                );
            }
        }
    }

    /**
     * Clear tmp folder
     *
     * @param $tmp
     */
    public function clearDir($tmp) {
        exec("sudo rm -Rf ".$tmp);
        exec("sudo mkdir ".$tmp);
        exec("sudo mkdir ".$tmp."/High_Energy");
        exec("sudo mkdir ".$tmp."/Low_Energy");
        exec("sudo mkdir ".$tmp."/deconv");
        exec("sudo mkdir ".$tmp."/ULSA");
        exec("sudo mkdir ".$tmp."/adducts");
        exec("sudo chmod 777 -R ".$tmp);
    }

    /**
     * List all files in specific directory on S3
     *
     * @param $s3
     * @param $bucket
     * @param $dir
     * @return array
     */
    public function getList($s3, $bucket, $dir) {
        $list = $s3 -> ListObjects(array(
            'Bucket' => $bucket,
            'Delimiter' => '/',
            'Prefix' => $dir,
        ));
        $dir = array();
        foreach ($list['CommonPrefixes'] as $object) {
            array_push($dir, $object['Prefix']);
        }
        return $dir;
    }

    /**
     * Move processed file from "/unprocessed" to "processed" folder on S3
     * @param $s3
     * @param $bucket
     * @param $dir
     */
    public function moveFile($s3, $bucket, $dir) {
        $list = $s3 -> ListObjects(array(
            'Bucket' => $bucket,
            'Prefix' => $dir,
        ));
        foreach ($list['Contents'] as $object) {
            $key = $object['Key'];
            $s3->copyObject(
                array(
                    'Bucket' => $bucket,
                    'Key' => "processed/".substr($key, 12),
                    'CopySource' => urlencode($bucket . '/' . $key),
                    'ACL' => 'public-read'
                )
            );
            $s3->deleteObject(
                array(
                    'Bucket' => $bucket,
                    'Key'    => $key
                )
            );
        }
    }
}