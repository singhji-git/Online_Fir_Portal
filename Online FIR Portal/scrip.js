function callMe()
{
            $.ajax({
                   type: "GET",
                   url: "http://localhost/mysite/webD/mainfile.php",
                   data: "id=1",
                   success: function(response){
					   console.log("sucesss");
					  //$("#testDiv").html(response);
					}
           });
}

$(document).ready(function(){
	setInterval(callMe(),50000);
});


