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
                    <h1 class="m-0"><?php echo $controller; ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    @include('Elements.breadcrumb')
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

 
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-success" data-backdrop="static" data-keyboard="false"  data-toggle="modal" data-target="#modal-default">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            @include('Elements.message')
                            <div class="table-responsive">
                                <table id="DataTables_Table_0" class="table table-bordered table-striped" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Name</th>
                                            <th>Package Name</th>
                                            <th>Status</th>
                                            <th>Created Date</th>
                                            <th>Modified Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>id</th>
                                            <th>Name</th>
                                            <th>Package Name</th>
                                            <th>Status</th>
                                            <th>Created Date</th>
                                            <th>Modified Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade show" id="modal-default" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="overlay" id="modal-overlay" style="display: none;">
                    <i class="fas fa-2x fa-sync fa-spin"></i>
                </div>
                <div class="modal-header">
                    <h4 class="modal-title">Add Application</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('application.store') }}" class="form-horizontal" enctype="multipart/form-data" id="ApplicationAddForm" method="post" accept-charset="utf-8" novalidate="novalidate">
                        <div class="card-body">
                            @csrf
                            <div class="form-group">
                                <label class="control-label" for="name"> Name : </label>
                                <div class="col-sm-10 col-md-10 pl-0">
                                    <input name="name" id="name" class="form-control" placeholder="Enter Name" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="package_name"> Package Name : </label>
                                <div class="col-sm-10 col-md-10 pl-0">
                                    <input name="package_name" id="package_name" class="form-control" placeholder="Enter Package Name" type="text">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!-- Modal confirm -->
    <div class="modal" id="ConfirmDelete" style="display: none; z-index: 1050;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="overlay" id="modal-delete-overlay" style="display: none;">
                    <i class="fas fa-2x fa-sync fa-spin"></i>
                </div>
                <div class="modal-body" id="confirmMessage">
                    Are you sure want to delete this record?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" id="confirmOk">Ok</button>
                    <button type="button" class="btn btn-sm btn-danger" id="confirmCancel">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal data details edit -->
    <div class="modal fade bd-example-modal-lg" id="edit" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="overlay" id="modal-edit-overlay" style="display: none;">
                    <i class="fas fa-2x fa-sync fa-spin"></i>
                </div>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Application</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="Edit-Content">

                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.2/js/bootstrap-switch.min.js"></script>

    @include('Elements.all_form_js')

    <script type="text/javascript" language="javascript" class="init">
    $(function () {
                    
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': CSRF_TOKEN
            }
        });
    
        var url = "<?php echo BASE_PATH; ?>application/records";
        $("#DataTables_Table_0").DataTable({
            "responsive": true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'asutoWidth': false,
            'autoWidth': false,
            "bAutoWidth": false,
            'lengthMenu': [[10, 20, 25, 50, -1], [10, 20, 25, 50, 'All']],
            'serverSide': true,
            'processing': true,
            "sAjaxSource": url,
            "aaSorting": [[5, "desc"]],
            aoColumns: [
                {mData: 'Application.id'},
                {mData: 'Application.name'},
                {mData: 'Application.package_name'},
                {mData: 'Application.status'},
                {mData: 'Application.created_date'},
                {mData: 'Application.modified_date'},
                {
                    "targets": 5,
                    "searchable": false,
                    "data": null,
                    "wrap": true,
                    "bSortable": false,
                    "orderable": false,
                    "mRender": function (mData, type, full) {
//                        var View = '<a href="#" class="btn btn-sm btn-app bg-info" data-backdrop="static" data-keyboard="false" title="View Application" onclick="ViewModal('+mData.Application.id+')"><i class="fas fa-info"></i></a>';
                        var edit = '<a href="javascript:void(0);" class="btn btn-primary btn-sm mr-2" data-target="#modal-edit" data-backdrop="static" data-keyboard="false" title="Edit Application" onclick="EditModal(' + mData.Application.id + ')"><i class="fas fa-pencil-alt"></i> Edit</a>';
                        var delete_id = '<a href="javascript:void(0);" class="btn btn-danger btn-sm" data-backdrop="static" data-keyboard="false" title="Delete Application" onclick="deleteModal(' + mData.Application.id + ')"><i class="fas fa-trash"></i> Delete</a>';
                        return   edit + delete_id;
                    },

                },
            ],
            "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                $('td', nRow).eq(0).html(iDisplayIndex + 1);
            },

            "fnCreatedRow": function (nRow, mData, iDataIndex) {
                if (mData.Application.status == '0') {
                    $('td:eq(3)', nRow).html('<input type="checkbox" class="Application_status" id="' + mData.Application.id + '" name="my-checkbox" checked="" data-off-color="danger" data-on-color="success">');
                } else {
                    $('td:eq(3)', nRow).html('<input type="checkbox" class="Application_status" id="' + mData.Application.id + '" name="my-checkbox" data-off-color="danger" data-on-color="success">');
                }

            },
            "fnDrawCallback": function () {
                jQuery(".Application_status").bootstrapSwitch();
                $('.Application_status').on('switchChange.bootstrapSwitch', function (event, state) {
                    var id = $(this).attr('id');
                    var isChecked = $(this).is(':checked');
                    var status_val = 1;
                    if (isChecked) {
                        status_val = 0;
                    }
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo BASE_PATH; ?>Application/update_status',
                        data: {
                            'id': id, 
                            'status_val': status_val,
                        },
                        success: function (msg) {
                            //alert('done' + msg);
                        }
                    });
                });
            }
        });
    });
    $(document).ready(function () {
        $("#submit").click(function () {
            if ($("#ApplicationAddForm").valid() === true) {
                $('#modal-overlay').show();
                $("#ApplicationAddForm").submit();
            }
            return true;
        });
        
        checkEmailSuccess = function(response) {
            
            switch (jQuery.parseJSON(response).code) {
                case 200:
                    Toast.fire({
                        icon: 'success',
                        title: 'App Live'
                    })
                    return "true"; // <-- the quotes are important!
                case 201:
                    Toast.fire({
                        icon: 'warning',
                        title: 'Already Exits'
                    })
                    break;
                case 401:
                    Toast.fire({
                        icon: 'error',
                        title: 'Sorry, App Link is Not Live'
                    })
                    break;
                case undefined:
                    alert("An undefined error occurred.");
                    break;
                default:
                    alert("An undefined error occurred");
                    break;
            }
            return false;
        };

        $('#ApplicationAddForm').validate({
            rules: {
                "name": {
                    required: true,
                },
                "package_name": {
                    required: true,
                    remote: {
                        type: "POST",
                        url: "{{ route( 'application.package_name' )}}",
                        dataType: "json",
                        data: {
                            package_name : function() {
                                return $("#package_name").val();
                            }
                        },
                        dataFilter: function(response) {
                            return checkEmailSuccess(response);
                        },
                    },
                }
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
                $(element).addClass('is-valid');
            }
        });
    });

    function deleteModal(id) {
        $("#ConfirmDelete").modal('show');
        $("#confirmOk").attr('data-user', id);
    }

    $(function () {
        $(document).on('click', '#confirmOk', function () {
            var userId = $("#confirmOk").attr('data-user');
            $('#modal-delete-overlay').show();
            window.location.href = "<?php echo BASE_PATH; ?>Application/delete/" + userId;
        });

        $(document).on('click', '#confirmCancel', function () {

            $("#ConfirmDelete").modal('hide');
        });
    });

    function EditModal(id) {
        $('#edit').modal({
            backdrop: 'static',
            keyboard: false
        });
        $("#edit").modal('show');
        $("#edit").attr('data-user', id);

        $.ajax({
            type: "POST",
            dataType: '',
            data: {id: id},
            url: "<?php echo BASE_PATH; ?>Application/edit",
            cache: false,
            success: function (data) {
                $('.Edit-Content').html(data);
                return data;
            },
            error: function () {
                alert('error');

            }
        });
    }
    </script>


@endsection('content')