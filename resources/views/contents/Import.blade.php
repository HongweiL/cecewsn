@extends('layouts.sidebar')

@section('content')
    <nav class="top-bar">
        <a id="method" class="current-status">Process method</a>
        <a id="choice">Choose files</a>
        <a id="info">Sample information</a>
        <a id="conf">Confirmation</a>
    </nav>
    <div id="1">
        <section id="upload">
            <button id="Import Only" onclick="goTo2()"><h3><a>Import Only</a></h3></button>
            <button id="Import and Search" onclick="location.href='upload2'"><h3><a>Import and Search</a></h3></button>
        </section>
    </div>
    <div id="2" style="display: none;">
        <section id="upload-file">
            <div class="layui-container" style="margin-top: 20px; margin-bottom: 20px">
                <div class="layui-row">
                    <div class="layui-col-md4">
                        <label>Target: </label>
                        <span id="file-target-choice">No file chosen</span>
                        <br>
                        <label class="layui-btn" style="background-color: #2c3f52" for="file-target">Choose</label>
                        <input id="file-target" onchange="change(this.id)" class="uploadBtn" type="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" style="position:absolute;clip:rect(0 0 0 0);"/>
                    </div>
                    <div class="layui-col-md4">
                        <label>High energy: </label>
                        <span id="file-high-choice">No file chosen</span>
                        <br>
                        <label class="layui-btn" style="background-color: #2c3f52" for="file-high">Choose</label>
                        <input id="file-high" onchange="change(this.id)" class="uploadBtn" type="file" accept=".cdf" style="position:absolute;clip:rect(0 0 0 0);"/></br>
                    </div>
                    <div class="layui-col-md4">
                        <label>Low energy: </label>
                        <span id="file-low-choice">No file chosen</span>
                        <br>
                        <label class="layui-btn" style="background-color: #2c3f52" for="file-low">Choose</label>
                        <input id="file-low" onchange="change(this.id)" class="uploadBtn" type="file" accept=".cdf" style="position:absolute;clip:rect(0 0 0 0);"/></br>
                    </div>
                </div>
            </div>
            <table>
                <tr>
                    <th>Description</th>
                    <th>Parameters</th>
                </tr>
                <tr>
                    <td>W = retention Window (of time) for analysis;</td>
                    <td><input id="W" type="number" value="15.0" placeholder="W"></td>
                </tr>
                <tr>
                    <td>min int = minimum threshold intensity for MS2 peak to be considered;</td>
                    <td><input id="min_int" type="number" value="800.0" placeholder="min_int"></td>
                </tr>
                <tr>
                    <td>mass_tol = mass tollerance for accepting the fragments;</td>
                    <td><input id="mass_tol" type="number" value="0.01" placeholder="mass_tol"></td>
                </tr>
                <tr>
                    <td>R_min = minimum threshold correlation coefficient for an XIC2 to be considered;</td>
                    <td><input id="R_min" type="number" value="0.85" placeholder="R_min"></td>
                </tr>
                <tr>
                    <td>P_max = p-value maximum threshold for the correlation coefficient to be considered;</td>
                    <td><input id="P_max" type="number" value="0.05" placeholder="P_max"></td>
                </tr>
                <tr>
                    <td>r_t = retention Time tolerance for XIC2;</td>
                    <td><input id="r_t" type="number" value="3.0" placeholder="r_t"></td>
                </tr>
                <tr>
                    <td>ms_w = maximum number of points in MS peak;</td>
                    <td><input id="ms_w" type="number" value="15.0" placeholder="ms_w"></td>
                </tr>
                <tr>
                    <td>ms_p_w = maximum acceptable MS peak width;</td>
                    <td><input id="ms_p_w" type="number" value="13.0" placeholder="ms_p_w"></td>
                </tr>
                <tr>
                    <td>Mass_w = mass window to filter the candidates in the library</td>
                    <td>  <input id="Mass_w" type="number" value="0.05" placeholder="Mass_w"></td>
                </tr>
                <tr>
                    <td>S2N = minimum signal to noise ratio for XIC2 (noise is calculated using the median of the retention
                        window).</td>
                    <td><input id="S2N" type="number" value="0.01" placeholder="S2N"></td>
                </tr>
            </table>
        </section>
        <button class="layui-btn layui-btn-lg" style="background-color: #2c3f52; display:block;margin-left: auto; margin-right: auto" onclick="goTo3()"><a>Next</a></button>
    </div>
    <div id="3" style="display: none;">
        <fieldset class="sample-information">
            <div>
                <label for="sample-location">Sample location</label>
                <input class="input" type="text" name="sample-location" placeholder="Enter Location">
            </div>

            <div>
                <label for="sample-date">Sample date</label>
                <input class="input" type="date" name="sample-date" placeholder="__/__/__">
            </div>

            <div>
                <label for="sample-type">Sample type</label>
                <input class="input" type="text" name="sample-type" placeholder="Enter Type">
            </div>

            <div id="sa-re">
                <button onclick="goTo4()"><a>Next</a></button>
                <button><a>Reset</a></button>
                <button class="cancel"><a>Cancel</a></button>
            </div>

        </fieldset>
    </div>
    <div id="4" style="display: none;">
        <div class="layui-container">
            <div class="layui-row">
                <div class="layui-col-md5">
                    <div style="color:#C8C8C8; font-family: monospace; background-color: black; border: 3px groove #ccc; width: 90%; height:80vh; margin-top: 5%; padding: 5px">
                        <p id="tar-name">please choose target file before upload</p>
                        <p id="high-name">please choose high energy file before upload</p>
                        <p id="low-name">please choose low file before upload</p>
                        <p id="d_set">No parameter</p>
                        <p id="prog1"></p>
                        <p id="prog2"></p>
                        <p id="prog3"></p>
                        <p id="results"></p>
                        <p style="color: forestgreen;">{{\Illuminate\Support\Facades\Auth::user()->email}} <i style="color: #C8C8C8">> </i></p>
                    </div>
                </div>
                <div class="layui-col-md7">
                    <button id="upload-button" class="layui-btn layui-btn-normal" style="color: white; display: block; margin-left: auto; margin-right: auto; vertical-align: middle">Upload and process</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://sdk.amazonaws.com/js/aws-sdk-2.235.1.min.js"></script>
    <script>
        AWS.config.credentials = new AWS.CognitoIdentityCredentials({
            IdentityPoolId: '{{env("AWS_IdentityPoolId")}}',
        });
        AWS.config.region = 'ap-southeast-2';
        var bucket = new AWS.S3({params: {Bucket: 'cecewsn'}});
        var target = document.getElementById('file-target');
        var high = document.getElementById('file-high');
        var low = document.getElementById('file-low');
        var button = document.getElementById('upload-button');
        var prog1 = document.getElementById('prog1');
        var prog2 = document.getElementById('prog2');
        var prog3 = document.getElementById('prog3');
        var results = document.getElementById('results');
        var count;
        const method = "import";
        button.addEventListener('click', function () {
            var file_target = target.files[0];
            var file_high = high.files[0];
            var file_low = low.files[0];
            const time = getNowFormatDate();
            if (file_target && file_high && file_low) {
                count = 0;
                results.innerHTML = '';
                const args = $("input[id='W']").val() + "="
                    + $("input[id='min_int']").val() + "=" + $("input[id='mass_tol']").val()  + "="
                    + $("input[id='R_min']").val() + "=" + $("input[id='P_max']").val() + "="
                    + $("input[id='r_t']").val() + "=" + $("input[id='ms_w']").val() + "="
                    + $("input[id='ms_p_w']").val() + "=" + $("input[id='Mass_w']").val() + "="
                    + $("input[id='S2N']").val() + "\n" + method;
                const dir='unprocessed/{{Auth::user()->id}}/['+time+"]/";
                const file1 = {Key: dir+file_target.name, ContentType: file_target.type, Body: file_target, 'Access-Control-Allow-Credentials': '*','ACL': 'public-read'};
                const file2 = {Key: dir+"High_Energy/"+file_high.name, ContentType: file_high.type, Body: file_high, 'Access-Control-Allow-Credentials': '*','ACL': 'public-read'};
                const file3 = {Key: dir+"Low_Energy/"+file_low.name, ContentType: file_low.type, Body: file_low, 'Access-Control-Allow-Credentials': '*','ACL': 'public-read'};
                const file = {Key: dir+"config.txt", Body: args, 'Access-Control-Allow-Credentials': '*','ACL': 'public-read'};
                bucket.upload(file1).on('httpUploadProgress', function(evt) {
                    prog1.innerHTML = ("1/3 Uploading: " + parseInt((evt.loaded * 100) / evt.total)+'%');
                }).send(function(err, data) {
                    if (err) {
                        results.innerHTML = err;
                    } else {
                        count++;
                        check_completion(time, file);
                    }
                });
                bucket.upload(file2).on('httpUploadProgress', function(evt) {
                    prog2.innerHTML = ("2/3 Uploading: " + parseInt((evt.loaded * 100) / evt.total)+'%');
                }).send(function(err, data) {
                    if (err) {
                        results.innerHTML = err;
                    } else {
                        count++;
                        check_completion(time, file);
                    }
                });
                bucket.upload(file3).on('httpUploadProgress', function(evt) {
                    prog3.innerHTML = ("3/3 Uploading: " + parseInt((evt.loaded * 100) / evt.total)+'%');
                }).send(function(err, data) {
                    if (err) {
                        results.innerHTML = err;
                    } else {
                        count++;
                        check_completion(time, file);
                    }
                });
            } else {
                results.innerHTML = 'Nothing to upload.';
            }
        }, false);
        function getNowFormatDate() {
            var date = new Date();
            var seperator1 = "-";
            var seperator2 = ":";
            var month = date.getMonth() + 1;
            var strDate = date.getDate();
            if (month >= 1 && month <= 9) {
                month = "0" + month;
            }
            if (strDate >= 0 && strDate <= 9) {
                strDate = "0" + strDate;
            }
            return date.getFullYear() + seperator1 + month + seperator1 + strDate
                + "_" + date.getHours() + seperator2 + date.getMinutes()
                + seperator2 + date.getSeconds();
        }
        function check_completion(time, file) {
            if (count === 3) {
                bucket.upload(file).send(function(err, data) {
                    if (err) {
                        results.innerHTML = err;
                    } else {
                        results.innerHTML = "Upload completed :)";
                        $.ajax({
                            url:"/record",
                            data:{name:"["+time+"]",
                                loc:$("input[name=sample-location]").val(),
                                type:$("input[name=sample-type]").val(),
                                date:$("input[name=sample-date]").val()
                                },
                            method:"get"
                        })
                    }
                });
            }
        }

        function goTo2() {
            $("#1").hide();
            $("#method").attr("class", "");
            $("#2").show();
            $("#choice").attr("class", "current-status")
        }

        function goTo3() {
            var file_target = target.files[0];
            var file_high = high.files[0];
            var file_low = low.files[0];
            if (file_target && file_high && file_low) {
                if ($("input[id='W']").val()!='' && $("input[id='min_int']").val()!='' && $("input[id='mass_tol']").val()!='' && $("input[id='R_min']").val()!='' && $("input[id='P_max']").val()!='' && $("input[id='r_t']").val()!='' && $("input[id='ms_w']").val()!='' && $("input[id='ms_p_w']").val()!='' && $("input[id='Mass_w']").val()!='' && $("input[id='S2N']").val()!='') {
                    $("#2").hide();
                    $("#choice").attr("class", "");
                    $("#3").show();
                    $("#info").attr("class", "current-status")
                } else {
                    alert("please make sure all parameters are set")
                }
            } else {
                alert("please select all files required")
            }
        }
        function goTo4() {
            $("#3").hide();
            $("#info").attr("class", "");
            $("#4").show();
            $("#conf").attr("class", "current-status");
            var file_target = target.files[0];
            var file_high = high.files[0];
            var file_low = low.files[0];
            $("#tar-name").html("tar: "+file_target.name);
            $("#high-name").html("high_: "+file_high.name);
            $("#low-name").html("low_: "+file_low.name);
            $("#d_set").html("d_set: ["+$("input[id='W']").val() + ", "
                + $("input[id='min_int']").val() + ", " + $("input[id='mass_tol']").val()  + ", "
                + $("input[id='R_min']").val() + ", " + $("input[id='P_max']").val() + ", "
                + $("input[id='r_t']").val() + ", " + $("input[id='ms_w']").val() + ", "
                + $("input[id='ms_p_w']").val() + ", " + $("input[id='Mass_w']").val() + ", "
                + $("input[id='S2N']").val()+"]")
        }
        function change(x) {
            $("#"+x+"-choice").html(document.getElementById(x).files[0].name);
        }
    </script>
@endsection
