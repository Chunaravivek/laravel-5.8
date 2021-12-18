@extends('Layout.default')

@section('content')

@include('Elements.all_form_css')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?php // echo $this->request->params['controller']; ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <section class="content">
        <div class="container-fluid">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <div class="alert alert-block alert-success">
                    <i class="icon-ok green"></i>

                    Welcome to
                    <strong class="green">
                        PlayScraper's         
                    </strong>
                    ,
                    Daily Installs Dashboard
                </div>
                <div class="hr hr32 hr-dotted"></div>                                             

                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
            <div class="row">
                <!-- Small boxes (Stat box) -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo $admin_count; ?></h3>

                            <p>Total Admin</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="<?php echo BASE_PATH; ?>admin" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@include('Elements.all_form_js')


@endsection('content')