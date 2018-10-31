@extends('layouts.sidebar')

@section('content')
    <link rel="stylesheet" href="css/acquisition.css">
    <div id="preview">
        <button id="HRMS" onclick="location.href='hrms'"><h3><a>My HRMS Instruments</a></h3></button>
        <button id="chromatography" onclick="location.href='chromatography'"><h3><a>My Chromatography Systems</a></h3></button>
        <button id="columns" onclick="location.href='columns'"><h3><a>My Columns</a></h3></button>
        <button id="acquisition" onclick="location.href='acquisition'"><h3><a>My Acquisition Methods</a></h3></button>
    </div>
@endsection