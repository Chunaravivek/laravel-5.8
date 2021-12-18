<div class="card-body">
    <form action="/admin/update/{{$data->id}}" class="form-horizontal" enctype="multipart/form-data" id="AdminEditForm" method="post" accept-charset="utf-8" novalidate="novalidate">
        <div class="card-body">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label class="control-label" for="full_name"> Full Name : </label>
                <div class="col-sm-10 col-md-10 pl-0">
                    <input name="name" id="name" class="form-control" placeholder="Enter Name" type="text" value="{{ $data->name }}">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label" for="email"> Email : </label>
                <div class="col-sm-10 col-md-10 pl-0">
                    <input name="email" id="email" class="form-control" placeholder="Enter Email" type="email" value="{{ $data->email }}">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label" for="password"> Password : </label>
                <div class="col-sm-10 col-md-10 pl-0">
                    <input name="password" id="password" class="form-control" placeholder="Enter Password" type="password" value="{{ $data->password }}">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" id="edit-submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>


<script type="text/javascript">
    $(document).ready(function () {

        $(document).on('click', '#edit-submit', function () {
            if ($("#AdminEditForm").valid() === true) {
                $("#edit-submit").attr("disabled", true);
                $('#modal-edit-overlay').show();
                $("#AdminEditForm").submit();
            }
            return true;
        });
        $('#AdminEditForm').validate({
            rules: {
                "name": {
                    required: true,
                },
                "email": {
                    required: true,
                    emailExt: true,
                },
                "password": {
                    required: true,
                },
                messages: {
                    "email": {
                        required: "Please enter email address",
                        emailExt: "Please enter valid email address",
                    },
                },
                submitHandler: function (form) { // <- pass 'form' argument in
                    $("#edit-submit").attr("disabled", true);
                    $('#modal-edit-overlay').show();
                    form.submit();
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
        jQuery.validator.addMethod("emailExt", function (value, element, param) {
            return value.match(/^\s*(([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5}){1,25})+([;.](([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5}){1,25})+)*\s*$/);
        }, 'Please enter your valid email address');
    });

</script>
