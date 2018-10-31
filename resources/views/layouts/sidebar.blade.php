<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>CECEWSN</title>
    <link rel="stylesheet" href="layui/css/layui.css">
    <link rel="stylesheet" href="css/sidebar.css?version=1.1">
    <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
</head>
<body>
    <nav class="side-bar">
        <div class = "functions">
            <h3 class = "user">Welcome,<br/>{{Auth::user()->fname}}</h3>
            <hr>
            <div class = "func">
                @if(\App\User::getRole() == 10)
                    <a href="admin"><h3 class = "management">Management</h3></a>
                @endif
                <a href="home"><h3 class = "home">Home</h3></a>
                <a href="upload"><h3 class = "upload">Upload and process</h3></a>
                <a href="view"><h3 class = "view">View reports</h3></a>
                <a><h3 class = "search">Global search</h3></a>
                <a href="config"><h3 class = "hardware">Hardware and acquision methods</h3></a>
                <a><h3 class = "forum">Forum</h3></a>
                <a><h3 class = "documentation">Documentation</h3></a>
                <a><h3 class = "researcher">Researcher profiles</h3></a>
            </div>
        </div>
        <div class = "help" style="cursor: pointer;" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <div style="width: 8vw;display: block; margin-left: auto; margin-right: auto; text-align: center"><img src="img/icons/exit.png"></div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </nav>
    <main class = "main-content">
        @yield("content")
    </main>
</body>
</html>