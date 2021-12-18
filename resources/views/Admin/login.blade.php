<?php
//if (isset($this->request->query['returnURL'])) {
//    $returnURL = 'login?returnURL=' . $this->request->query['returnURL'];
//} else {
//    $returnURL = '';
//}
?>
@extends('Layout.user')

@section('content')
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Play</b>Scraper</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        @include('Elements.message')
        <div class="card-body login-card-body">
            <p class="login-box-msg">Play Scraper</p>

            <form action="/admin" class="" method="POST" id="Adminaddform" enctype="multipart/form-data">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Email" required="">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Password" required="">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">     
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>

@endsection('content')