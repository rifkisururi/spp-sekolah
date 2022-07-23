<?php
session_start();
$userLogin = $_SESSION["userLogin"];
?>

@extends('template/sbadmin')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <!-- Overflow Hidden -->
        <div class="card mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Profile</h6>
            </div>
            <div class="card-body">
                <div class="form-group row">    
                    <label for="staticEmail" class="col-sm-2 col-form-label">Surel</label>
                    <div class="col-sm-10">
                        <input type="hidden" class="form-control" id="id" value="<?php echo $userLogin->id ?>">
                        <input type="text" class="form-control" id="email" value="<?php echo $userLogin->email ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" placeholder="Password" value="<?php echo $userLogin->name ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Kata sandi</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" placeholder="kosongkan jika tidak ada perubahan">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Ulangi kata sandi</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password2" placeholder="kosongkan jika tidak ada perubahan">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <button class="btn btn-primary" id="profile">Perbarui Profile</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="js/profile.js"></script>
@endsection