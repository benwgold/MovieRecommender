<html>
<head>
    <title> FIRST LIST VIEW PAGE </title>
    <script src="/assets/js/jquery.js" type="text/javascript"></script>
    <script src="/assets/js/global.js" type="text/javascript"></script>
</head>
<body>
    <b> Welcome to the Site </b>
    <?php echo anchor('home/loginform', 'Login/Register') ?>
    <?php
        $id = array('id' => 'movieform');
    //<form method="post" accept-charset="utf-8" id='movieform'/>?>
    <p> Movie Name: <p>
    <input type='text' name='moviename' id='moviename'/>
    <br/>
    <input type="submit" name="mysubmit" value="Submit Movie!" id="submitbutton"/>
    <br/>
    <div id='searchwrapper'></div>
    <script type='text/javascript' language='javascript'>
    $(document).ready(function() {
        //$('#result').slideup();
        $('#moviename').blur(function(){
        });
        $('#submitbutton').click(function(){
            var moviename = $('#moviename').val();
            $.ajax({
                url: "<?php echo site_url('movieinfo/topresult');?>",
                type: "POST",
                data: {'moviename': moviename},
                datatype: "text",
                success: function(data){
                    var output = $.parseJSON(data);
                    if (output.success == true){
                        var i = 0;
                        var profile = "<img src='"+output.poster+"' />";
                        profile += "<bold>"+output.title+" "+output.year+"</bold>";
                        if(typeof output.critics_consensus !== "undefined"){
                            profile += "<p>"+output.critics_consensus+"</p>";
                        }
                        profile += "<input type='submit' name='mysubmit' value='Not the movie you wanted?' id='moreresults'/>";
                        $('#searchwrapper').html(profile);

                        $('#moreresults').click(function(){
                            $.ajax({
                                url: "<?php echo site_url('movieinfo/titlelist');?>",
                                type: "POST",
                                data: {'moviename': moviename},
                                datatype: "text",
                                success: function(data){
                                    var output_json = $.parseJSON(data);
                                    if (output_json.success == true){
                                        var i = 0;
                                        var output = "<ul>";
                                        var titlearr = output_json.output;
                                        while (i<titlearr.length){
                                            output += "<li>"+titlearr[i]+"</li>";
                                            i += 1;
                                        }
                                        output += "</ul>";
                                    }
                                    else if (output_json.success == false){
                                        var output = (output_json.error);
                                    }
                                    $('#searchwrapper').html(output);
                                }, // End of success function of ajax form
                                error: function(e, xhr){
                                    alert("ERROR" + xhr);
                                }
                            }); // End of ajax call
                        });
                    }
                    else if (output.success == false){
                        var error = (output.error);
                        $('#searchwrapper').html(error)
                    }

                }, // End of success function of ajax form
                error: function(e, xhr){
                    alert("ERROR" + xhr);
                }
            }); // End of ajax call
        });
    });
    </script>
    <?php echo validation_errors(); ?>
</body>
</html>
