<?php
    if ( $code == 'error'){
?>
    <script>
        alert('{{$message}}');
        location.href = '{{$url}}';
    </script>
<?php
    } else if ( $code == 'success'){
?>
    <script>
        alert('{{$message}}');
        location.href = '{{$url}}';
    </script>
<?php
    }
?>