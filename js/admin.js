

    //$('.dropdown-toggle').dropdown();
    $.ajax({
        type : 'post',
	url:'../php/admin.php',
       	data: status,
	success:function(response)
       {
           console.log("Successfully fetched php file");
	   response = JSON.parse(response);
	   console.log(response['status']);
           if(!response['status']){
	   location.replace("../index.html");
	   }
	   else{	
		$("#main").show();	   
	   }
       },
       error: function(xhr, status, error) {
  	console.log(status);	
	console.log(xhr.responseText);
	}
	
    });

    
