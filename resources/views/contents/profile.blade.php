@extends('layouts.sidebar')

@section('content')
    <link rel="stylesheet" type="text/css" href="css/css.css">
    <div class="container">
        <div class="form-sec">
            <h4>User Profile</h4>
            <form name="qryform" id="qryform" method="post" action="mail.php" onsubmit="return(validate());" novalidate="novalidate">
                <div class="form-group">
                    <label>First Name:</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name">
                </div>
                <div class="form-group">
                    <label>Last Name:</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name">
                </div>
                <div class="form-group">
                    <label>Affiliation:</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name">
                </div>
                <div class="form-group">
                    <label>Position:</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name">
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" class="form-control" id="name" placeholder="Enter Email" name="email">
                </div>

                <div class="form-group">
                    <label>Phone No.:</label>
                    <input type="text" class="form-control" id="phone" placeholder="Enter Phone no." name="phone">
                </div>

                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="same-address">
                    <label class="custom-control-label" for="same-address">I wish to make my profile visible to other users.</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="save-info">
                    <label class="custom-control-label" for="save-info">I wish to make my profile invisible to other users.</label>
                </div>

                <button type="submit" class="btn btn-default">Submit</button>
                </br>
            </form>
        </div>
    </div>

@endsection