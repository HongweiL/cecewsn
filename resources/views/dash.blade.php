<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>CECEWSN</title>

        <link rel="stylesheet" href="css/animate.css">
        <link rel="stylesheet" href="css/app.css">
        <script
                src="https://code.jquery.com/jquery-3.3.1.min.js"
                integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
                crossorigin="anonymous"></script>
        <style type="text/css">
            .btn { display: inline-block; *display: inline; *zoom: 1; padding: 4px 10px 4px; margin-bottom: 0; font-size: 13px; line-height: 18px; color: #333333; text-align: center;text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75); vertical-align: middle; background-color: #f5f5f5; background-image: -moz-linear-gradient(top, #ffffff, #e6e6e6); background-image: -ms-linear-gradient(top, #ffffff, #e6e6e6); background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#ffffff), to(#e6e6e6)); background-image: -webkit-linear-gradient(top, #ffffff, #e6e6e6); background-image: -o-linear-gradient(top, #ffffff, #e6e6e6); background-image: linear-gradient(top, #ffffff, #e6e6e6); background-repeat: repeat-x; filter: progid:dximagetransform.microsoft.gradient(startColorstr=#ffffff, endColorstr=#e6e6e6, GradientType=0); border-color: #e6e6e6 #e6e6e6 #e6e6e6; border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25); border: 1px solid #e6e6e6; -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px; -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05); -moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05); box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05); cursor: pointer; *margin-left: .3em; }
            .btn:hover, .btn:active, .btn.active, .btn.disabled, .btn[disabled] { background-color: #e6e6e6; }
            .btn-large { padding: 9px 14px; font-size: 15px; line-height: normal; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; }
            .btn:hover { color: #333333; text-decoration: none; background-color: #e6e6e6; background-position: 0 -15px; -webkit-transition: background-position 0.1s linear; -moz-transition: background-position 0.1s linear; -ms-transition: background-position 0.1s linear; -o-transition: background-position 0.1s linear; transition: background-position 0.1s linear; }
            .btn-primary, .btn-primary:hover { text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25); color: #ffffff; }
            .btn-primary.active { color: rgba(255, 255, 255, 0.75); }
            .btn-primary { background-color: #4a77d4; background-image: -moz-linear-gradient(top, #6eb6de, #4a77d4); background-image: -ms-linear-gradient(top, #6eb6de, #4a77d4); background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#6eb6de), to(#4a77d4)); background-image: -webkit-linear-gradient(top, #6eb6de, #4a77d4); background-image: -o-linear-gradient(top, #6eb6de, #4a77d4); background-image: linear-gradient(top, #6eb6de, #4a77d4); background-repeat: repeat-x; filter: progid:dximagetransform.microsoft.gradient(startColorstr=#6eb6de, endColorstr=#4a77d4, GradientType=0);  border: 1px solid #3762bc; text-shadow: 1px 1px 1px rgba(0,0,0,0.4); box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.5); }
            .btn-primary:hover, .btn-primary:active, .btn-primary.active, .btn-primary.disabled, .btn-primary[disabled] { filter: none; background-color: #4a77d4; }
            .btn-block { width: 100%; display:block; }

            * { -webkit-box-sizing:border-box; -moz-box-sizing:border-box; -ms-box-sizing:border-box; -o-box-sizing:border-box; box-sizing:border-box; }

            html { width: 100%; height:100%; overflow:hidden; }

            body {
                width: 100%;
                height:100%;
                font-family: 'Open Sans', sans-serif;
                background: #303030;
            }

            .background {
                width: 100%;
                height:100%;
                background: #092756;
                background: -moz-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%),-moz-linear-gradient(top,  rgba(57,173,219,.25) 0%, rgba(42,60,87,.4) 100%), -moz-linear-gradient(-45deg,  #670d10 0%, #092756 100%);
                background: -webkit-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%), -webkit-linear-gradient(top,  rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%), -webkit-linear-gradient(-45deg,  #670d10 0%,#092756 100%);
                background: -o-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%), -o-linear-gradient(top,  rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%), -o-linear-gradient(-45deg,  #670d10 0%,#092756 100%);
                background: -ms-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%), -ms-linear-gradient(top,  rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%), -ms-linear-gradient(-45deg,  #670d10 0%,#092756 100%);
                background: -webkit-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%), linear-gradient(to bottom,  rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%), linear-gradient(135deg,  #670d10 0%,#092756 100%);
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#3E1D6D', endColorstr='#092756',GradientType=1 );
                border-top-right-radius: 20px;
                border-top-left-radius: 20px;
                box-shadow: 0 0 30px #222222;
            }
            .cell {
                display: flex;
                justify-content:center;
                align-items: center;
            }
            .button {
                height: 200px;
                width:200px;
                border-radius: 10px;
            }
            .content {
                width: 100%;
                height: 100%;
                position: absolute;
                z-index: 5;
                background-color: whitesmoke;
                border-top-right-radius: 20px;
                border-top-left-radius: 20px;
                background-color: #e0e0e0;
                overflow: hidden;
            }
            .content-card {
                width: 100%;
                height: 100%;
                position: absolute;
                z-index: 5;
                margin-top: 2%;
                display: none;
            }
            .closeBtn{
                background: #f44336;
                color: #FFFFFF;
                border-radius: 15px;
                line-height: 20px;
                text-align: center;
                height: 30px;
                width: 30px;
                font-size: 18px;
                padding: 5px;
                top: -15px;
                right: 20px;
                position: absolute;
                box-shadow: 0 0 8px #222222;
                display: none;
                z-index: 6;
            }
            .closeBtn::before {
                content: "\2716";
            }
            .closeBtn:hover{
                background: #e57373;
            }
            .closeBtn:active{
                height: 29px;
                width: 29px;
                top: -14px;
                background: #b71c1c;
                box-shadow: 0 0 4px #222222;
            }
            .team{
                color: #6c757d;
                position: absolute;
                z-index: 0;
                margin-left: 40%;
                margin-top: 20%;
                display: none;
            }
        </style>
    </head>
    <body>
        <div class="row animated fadeInDown" style="position:absolute; z-index: 0; width:100%; color: white; margin-top: 20px">
            <h1 class="col-md-3" style="padding-left: 4%" onclick="behindit()">CECEWSN</h1>
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <a class="btn btn-primary btn-block" style="float:right; width: 80px;height: 30px;" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <p style="float: right">{{Auth::user()->fname}}</p>
            </div>
        </div>
        <h1 id="team" class="team">Team Anonymous</h1>
        <div id="dashboard" class="background animated bounceInUp" style="z-index: 1;position: absolute; margin-top: 80px">
            <div id='buttons' style="z-index: 2; position: absolute; height: 100%; width: 90%; margin-top: 2%; margin-left: 5%;">
                <div class="row" style="height: 35%;">
                    <div class="col-md-3 cell">
                        <button class="button" style="background: url('img/upload.png') center no-repeat;" onclick="opencard('upload')"></button>
                    </div>
                    <div class="col-md-3 cell">
                        <button class="button" style="background: url('img/view.png') center no-repeat" onclick="opencard('view')"></button>
                    </div>
                    <div class="col-md-3 cell">
                        <button class="button" style="background: url('img/search.png') center no-repeat" onclick="opencard('search')"></button>
                    </div>
                    <div class="col-md-3 cell">
                        <button class="button" style="background: url('img/profile.png') center no-repeat" onclick="opencard('profile')"></button>
                    </div>
                </div>
                <div class="row" style="height: 35%;">
                    <div class="col-md-3 cell">
                        <button class="button" style="background: url('img/settings.png') center no-repeat" onclick="opencard('settings')"></button>
                    </div>
                    <div class="col-md-3 cell">
                        <button class="button" style="background: url('img/forum.png') center no-repeat" onclick="opencard('upload')"></button>
                    </div>
                    <div class="col-md-3 cell">
                        <button class="button" style="background: url('img/documentation.png') center no-repeat" onclick="opencard('documentation')"></button>
                    </div>
                    <div class="col-md-3 cell">
                        <button class="button" style="background: url('img/researcher_profiles.png') center no-repeat" onclick="opencard('researcher_profiles')"></button>
                    </div>
                </div>
            </div>
            <div id="card">
                <span id="closeBtn" class="closeBtn" onclick="closecard()"></span>
            </div>
        </div>
    </body>
    <script>
        var status = 1;
        function opencard(section) {
            section = 'http://uq.edu.au';
            $("iframe[id='content']").remove();
            $("div[id='card']").attr('class', 'animated bounceInUp content-card');
            $("div[id='card']").show();
            $("span[id='closeBtn']").show();
            height = document.documentElement.clientHeight - 100;
            $("div[id='card']").append("<div id='content' class='content'><iframe style='width: 100%; height:" + height + "px' src=" + section + "></iframe></div>")
        }
        function closecard() {
            $("div[id='card']").attr('class', 'animated bounceOutDown content-card');
            $("div[id='buttons']").show();
            $("div[id='dashboard']").attr('onclick', '');
            setTimeout(function(){
                $("iframe[id='content']").remove();
                $("div[id='card']").hide();
                $("span[id='closeBtn']").hide();
            }, 600)
        }
        function behindit() {
            if (status == 1) {
                slideDown();
                $("h1#team").show();
                setTimeout(function () {
                    status = 0;
                }, 1000);
            } else {
                slideUp();
                setTimeout(function () {
                    status = 1;
                }, 1000);
            }
        }

        function slideDown() {
            height = document.getElementById("dashboard").offsetHeight - 120;
            $("div#dashboard").animate({top:height}, 1000)
        }
        function slideUp() {
            $("div#dashboard").animate({top:'0px'}, 1000)
        }
    </script>
</html>