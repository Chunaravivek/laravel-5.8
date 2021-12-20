<script type="text/javascript" language="javascript" class="init">
    $(function () {
        
        <?php if (Session::has('success')) { ?>
        var Success = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000
        });
        
        Success.fire({
            icon: 'success',
            title: "<?php echo Session::get('success'); ?>"
        })
        <?php } else if (Session::has('dangers')) { ?>
        var failure = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000
        });
        
        failure.fire({
            icon: 'error',
            title: "<?php echo Session::get('dangers'); ?>"
        })
        <?php }  ?>
    });
</script>
