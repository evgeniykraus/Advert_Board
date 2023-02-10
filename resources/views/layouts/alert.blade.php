<div id="alert-success" class="alert alert-success" role="alert"> {{$message}} </div>

<script>
    setTimeout(function() {
        $('#alert-success').alert('close');
    }, 1500);
</script>
