var credentials = {
    accessKeyId: '{{ env("AWS_KEY") }}',
    secretAccessKey: '{{ env("AWS_SECRET") }}'
};
AWS.config.update(credentials);
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
button.addEventListener('click', function () {
    var file_target = target.files[0];
    var file_high = high.files[0];
    var file_low = low.files[0];
    if (file_target && file_high && file_low) {
        results.innerHTML = '';
        const args = $("input[id='W']").val() + "="
            + $("input[id='min_int']").val() + "=" + $("input[id='mass_tol']").val()  + "="
            + $("input[id='R_min']").val() + "=" + $("input[id='P_max']").val() + "="
            + $("input[id='r_t']").val() + "=" + $("input[id='ms_w']").val() + "="
            + $("input[id='ms_p_w']").val() + "=" + $("input[id='Mass_w']").val() + "="
            + $("input[id='S2N']").val();
        const dir='unprocessed/{{Auth::user()->id}}/['+getNowFormatDate()+"]/";
        const file1 = {Key: dir+file_target.name, ContentType: file_target.type, Body: file_target, 'Access-Control-Allow-Credentials': '*','ACL': 'public-read'};
        const file2 = {Key: dir+"High_Energy/"+file_high.name, ContentType: file_high.type, Body: file_high, 'Access-Control-Allow-Credentials': '*','ACL': 'public-read'};
        const file3 = {Key: dir+"Low_Energy/"+file_low.name, ContentType: file_low.type, Body: file_low, 'Access-Control-Allow-Credentials': '*','ACL': 'public-read'};
        const file = {Key: dir+"config.txt", Body: args, 'Access-Control-Allow-Credentials': '*','ACL': 'public-read'};
        bucket.upload(file).send(function(err, data) {
            if (err) {
                results.innerHTML = err;
            }
        });
        bucket.upload(file1).on('httpUploadProgress', function(evt) {
            prog1.innerHTML = ("1/3 Uploaded :: " + parseInt((evt.loaded * 100) / evt.total)+'%');
        }).send(function(err, data) {
            if (err) {
                results.innerHTML = err;
            }
        });
        bucket.upload(file2).on('httpUploadProgress', function(evt) {
            prog2.innerHTML = ("2/3 Uploaded :: " + parseInt((evt.loaded * 100) / evt.total)+'%');
        }).send(function(err, data) {
            if (err) {
                results.innerHTML = err;
            }
        });
        bucket.upload(file3).on('httpUploadProgress', function(evt) {
            prog3.innerHTML = ("3/3 Uploaded :: " + parseInt((evt.loaded * 100) / evt.total)+'%');
        }).send(function(err, data) {
            if (err) {
                results.innerHTML = err;
            } else {
                results.innerHTML = 'Uploaded';
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
function goTo2() {
    $("#1").hide();
    $("#method").attr("class", "");
    $("#2").show();
    $("#choice").attr("class", "current-status")
}

function goTo3() {
    $("#2").hide();
    $("#choice").attr("class", "");
    $("#3").show();
    $("#param").attr("class", "current-status")
}

function goTo4() {
    var file_target = target.files[0];
    var file_high = high.files[0];
    var file_low = low.files[0];
    if (file_target && file_high && file_low) {
        $("#3").hide();
        $("#param").attr("class", "");
        $("#4").show();
        $("#info").attr("class", "current-status")
    } else {
        alert("please select all files required")
    }
}
function goTo5() {
    $("#4").hide();
    $("#info").attr("class", "");
    $("#5").show();
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
    $("#"+x+"-choice").html($("#"+x).val());
}