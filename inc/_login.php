<?php
/**
 * Created by PhpStorm.
 * User: ronen
 * Date: 09/12/2017
 * Time: 18:13
 */?>


<div class="row">
    <div class="col-lg-4">
    </div>

    <div class="col-lg-4 adminTitle">
        <h3>Admin Dashboard</h3>
        <p>Please Login To Manage Movies</p>
    </div>

    <div class="col-lg-4">
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
    </div>
    <div class="col-lg-4 login" >

        <div class="form-group">
            <label for="email">User Name:</label>
            <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">

        </div>
        <div class="checkbox">
            <label><input type="checkbox" name="remember"> Remember me</label>
        </div>
        <button type="submit" class="btn btn-default" id="loginBtn">Login</button>




        <div id="success"></div>
    </div>

    <div class="col-lg-4">
    </div>
</div>

