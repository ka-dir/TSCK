<script>
$('document').ready(function () {
    $('#startProgress').click(function () {
        getProgress();
        console.log('startProgress');
        $.ajax({
            url: "progress.php",
            type: "POST",
            data: {
                'startProgress': 'yes'
            },
            async: true, //IMPORTANT!
            contentType: false,
            processData: false,
            success: function(data){
                if(data!==''){
                    alert(data);
                }
                return false;
            }
        });
        return false;
    });

});

function getProgress() {
    console.log('getProgress');
    $.ajax({
        url: "getProgress.php",
        type: "GET",
        contentType: false,
        processData: false,
        async: false,
        success: function (data) {
            console.log(data);
            $('#progressbar').css('width', data+'%').children('.sr-only').html(data+"% Complete");
            if(data!=='100'){
                setTimeout('getProgress()', 1000);
            }
        }
    });
}
</script>