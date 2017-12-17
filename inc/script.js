$(document).ready(function (e) {


    $('#newMovieAlert').hide();
    $('#loading').hide();
    $("#loginBtn").click(function () {

        $.ajax(
            {
                type: "POST",
                url:  "../class/api.php",
                data:{
                    // user : $("#username").val(),
                    email    : $("#email").val(),
                    password : $("#password").val(),
                    operation: "login"
                },beforeSend: function()
                {
                    $("#loginBtn").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
                },
                success:function(data){
                    var obj = JSON.parse(data);
                    var str = obj.result;
                    console.log(str);
                    if(str=="success"){
                        $("#loginBtn").html('<img src="../btn-ajax-loader.gif" /> &nbsp; Signing In ...');
                        setTimeout(' window.location.href = "../pages/index.php"; ',2000);
                    }
                    else{
                            alert("Error");
                            $("#success").html("<p style='color:red'>Login Error...</p>");

                    }

                }
            }
        );//end ajax
    });//end login Functions



    $("#addNewMovieBtn").click(function () {
        $("#newMoviesForm").on('submit',(function(e) {

            e.preventDefault();// prevent from POST Method to refresh the page!!!!!

            alert("Add new Movies Start");

            $("#newMovieAlert").html('');
            $("#message").empty();



            $.ajax({
                url: "../class/api.php", // Url to which the request is send
                type: "POST",             // Type of request to be send, called as method
                data:{
                    // user : $("#username").val(),
                    movieName        : $("#movie_name").val(),
                    movieYear        : $("#movie_year").val(),
                    movieAddBy       : "ronenAdd",
                    movieDescription : $("#movie_description").val() ,
                    moviePublish     : $("#movie_publish").val(),
                    operation        : "addNewMovie"
                },
                beforeSend: function()
                {
                    $("#addNewMovieBtn").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; adding ...');
                },
                success: function(data)   // A function to be called if request succeeds
                {
                    var obj = JSON.parse(data);
                    var str = obj.result;
                    if(str=="success"){
                        $('#newMovieAlert').show();
                        $("#message").html(data);
                        $("#newMovieAlert").html('<div class="alert alert-success text-center" id="newMovieAlert">Good</div>');
                    }else{

                        $("#newMovieAlert").html('<div class="alert alert-danger text-center" id="newMovieAlert">Not Good</div>');
                        $('#newMovieAlert').show();
                        $("#message").html(data);

                    }


                }
            });
            console.log(e)
        }));

        // Function to preview image after validation
        $(function() {
            $("#movie_photo_files").change(function() {
                $("#message").empty(); // To remove the previous error message
                var file = this.files[0];
                var imagefile = file.type;
                var match= ["image/jpeg","image/png","image/jpg"];
                if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
                {
                    $('#previewing').attr('src','../noimage.png');
                    $("#message").html("<p id='error'>Please Select A valid Image File</p>"+"<h4>Note</h4>"+"<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
                    return false;
                }
                else
                {
                    var reader = new FileReader();
                    reader.onload = imageIsLoaded;
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });

        function imageIsLoaded(e) {
            $("#movie_photo_files").css("color","green");
            $('#image_preview').css("display", "block");
            $('#previewing').attr('src', e.target.result);
            $('#previewing').attr('width', '250px');
            $('#previewing').attr('height', '230px');
        };

    });
});

