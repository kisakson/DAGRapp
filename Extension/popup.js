function escapeHTML(text) {
  var map = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#039;'
  };

  return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}

document.addEventListener('DOMContentLoaded', function() {
  var addFileButton = document.getElementById('addFile');
  var homepageButton = document.getElementById('homepage'); 
  // var xhr = new XMLHttpRequest();

  // I am following this tutorial: https://www.sitepoint.com/create-chrome-extension-10-minutes-flat/

  if (addFileButton) {
  		// createFile();
  		
  		addFileButton.addEventListener('click', function() {
    	chrome.tabs.getSelected(null, function(tab) {
	    		//createFile();
	    		//if (document.getElementById('addDAGR').checked) {
    			//	createDAGR();
    			//} else {    		 
	    		// <form method="post" action="<?php echo htmlspecialchars('php/responses/parsehtml.php');?>" enctype="multipart/form-data" id="file-add-form">
			var form = document.createElement('form');
			form.method 	= 'post';
			form.action 	= escapeHTML('http://www.bagelcron.com/php/responses/parsehtml.php');
			form.id 		= 'file-add-form';

			// NAME
			// File Name: <input type="text" name="name" id="file-name"><br>
			var file_name 	= document.createElement('input');
			file_name.type 	= 'text';
			file_name.name 	= 'name';
			file_name.id	= 'file-name';
			form.appendChild(file_name);
			
			// CREATOR
			// Creator Name: * <input type="text" name="creator" id="file-creator"><br>
			var creator = document.createElement('input');
			creator.type = 'text';
			creator.name = 'creator';
			creator.id = 'file-creator';
			form.appendChild(creator);
			
			// PARENT
			//DAGR Parent: * <select name="parent" id="file-parent">
			var parent   = document.createElement('input');
			parent.type  = 'hidden';
			parent.name  = 'parent';
			parent.value = 'null';
			form.appendChild(parent);
			
			// URL
			var url   = document.createElement('input');
			url.type  = 'hidden';
			url.name  = 'url';
			url.value = window.location.href;
			console.log(url.value);
			form.appendChild(url);
			
			// createDAGR(dagr_name, creator)
			
			// <input type="hidden" name="object" value="file">
			var obj = document.createElement('input');
			obj.type 	= 'hidden';
			obj.name 	= 'object';
			obj.value 	= 'file';
			form.appendChild(obj);
			
			// <input type="submit" name="submit" value="Submit" class='submit-button' id='file-add-button'/>
			var sub = document.createElement('input');
			sub.type 	= 'submit';
			sub.name 	= 'submit';
			sub.value 	= 'Submit';
			//sub.class	= 'submit-button';
			sub.id		= 'file-add-button';
			form.appendChild(sub);
			
			document.body.appendChild(form);
			//form.submit();
			
			/*
			xhr.open("POST", "http://www.bagelcron.com/php/responses/parsehtml.php", true);
  
 			xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  			xhr.setRequestHeader("Content-length", ($('#file-add-form').serialize().length));
  			xhr.setRequestHeader("Connection", "close");
  			
  			xhr.onload = function() {
  				if (request.status === 200) {
          			alert("It worked");
          			console.log("Words");
     			} else {
     				alert("could not connect");
     				console.log("could not connect");
     			}
  			}
  			*/
			
			/*
			 xhr.send(JSON.stringify(document.getElementById('file-add-form')));
 			 xhr.onreadystatechange = function() { 
   			 	if(xhr.readyState == 4 && xhr.status == 200) { 
           		 	//debugger;
         	   		// alert("Logged in");
         	   		form.submit();
            		//flag = 1;
           			 //_callBack(xhr, xhr.readyState);
    		 	}
    		 }*/

			/*
    		xhr.send($('#file-add-form').serialize());
    		
    		xhr.onreadystatechange = function() { 
   			 	if(xhr.readyState == 4 && xhr.status == 200) { 
           		 	//debugger;
         	   		alert("Logged in");
         	   	}
         	}*/
    	})
  	}, false);
  }

  if (homepageButton) {
  	homepageButton.addEventListener('click', function() {
    var homepage = "http://www.bagelcron.com/index.php";
    	chrome.tabs.create({ url: homepage });
  		}, false);
  }

}, false);


/*
function createDAGR() {
	// if user requests a name, use this name, otherwise use the GUID as the name
	// use a current timestamp function to create the time
	// once form is completed, send it
	// website accepts it, create the DAGR in the database
	// so this is just the extension half, the website carries the rest of the load
	
	// BUG CHECK: see if using the var form works for all of the different functions
	// or if we need different names for all of these vars

	// ---------

	var form = document.createElement('form');
	//form.action = TODO!!!! something like 'http://gtmetrix.com/analyze.html?bm';
	form.method = 'post';

	// generate GUID in the space that calls this function so it can be used in other function calls
	var fguid = document.createElement('dagrGUID');
	fguid.type = 'hidden';
	fguid.name = 'GUID';
	fguid.value = GUID;
	form.appendChild(fguid);

			document.body.appendChild(form);
			
			
};

	var fcreator = document.createElement('dagrCreator');
	fcreator.type = 'hidden';
	fcreator.name = 'creator';
	fcreator.value = creator;
	form.appendChild(fcreator);
*/

    		/****************************************
    		 *										*
    		 *				FORM					*
    		 *			   (FILE)					*
    		 ****************************************/
function createFile() {
	// same concept as the above function, but with more values. make sure input includes all database values
	// parent id should be from a new DAGR or a specified DAGR
	// input to consider: either null or other file guid. is this file a file contained in the html file?
	// for example, one time we call createfile to create the html file
	// after that, we can call createfile to create the internal image files, etc
	// basically an input for the function can be parentFile.
	// -- if value not null, create a new call to the website to add a line to the file_to_file table
	// -- just like above, this creates a form that would send the parent file id and child file id
	// -- if child file, just insert it into the same DAGR parent folder for simplicity
	
	// time and local_or_online not included in the function handle because the first is just generated
	// and the second is always online for this function call
    		 
    		// <form method="post" action="<?php echo htmlspecialchars('php/responses/add.php');?>" id="dagr-add-form">
			var form 	= document.createElement('form');
			form.method = 'post';
			form.action = escapeHTML('http://www.bagelcron.com/php/responses/add.php');
			form.id 	= 'file-add-form';
			
			// NAME
			// File Name: <input type="text" name="name" id="file-name"><br>
			var file_name 	= document.createElement('input');
			file_name.type 	= 'text';
			file_name.name 	= 'name';
			form.appendChild(file_name);
			
			// CREATOR
			// Creator Name: * <input type="text" name="creator" id="file-creator"><br>
			var creator = document.createElement('input');
			creator.type = 'text';
			creator.name = 'creator';
			form.appendChild(creator);
			
			// PARENT
			//DAGR Parent: * <select name="parent" id="file-parent">
			var parent   = document.createElement('input');
			parent.type  = 'hidden';
			parent.name  = 'parent';
			parent.value = 'null';
			form.appendChild(parent);
			
			// URL
			var url   = document.createElement('input');
			url.type  = 'hidden';
			url.name  = 'url';
			url.value = window.location.href;
			form.appendChild(url);
			
			// <input type="hidden" name="object" value="file">
			var obj = document.createElement('input');
			obj.type 	= 'hidden';
			obj.name 	= 'object';
			obj.value 	= 'ext';
			form.appendChild(obj);
			
			// <input type="submit" name="submit" value="Submit" id='dagr-add-button'/>
			var sub = document.createElement('input');
			sub.type 	= 'submit';
			sub.name 	= 'submit';
			sub.value 	= 'Submit';
			sub.id		= 'file-add-button';
			form.appendChild(sub);

			document.body.appendChild(form);
};

/*
function ClickSuggestionsLink(data){
    var request = new XMLHttpRequest();
    var data = document.getElementById('file-add-form').serialize();

    request.open("POST", 'http://www.bagelcron.com/php/responses/parsehtml.php', true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.setRequestHeader("Content-length", data.length);
    request.setRequestHeader("Connection", "close");

    request.onload = function() {
      if (request.status === 200) {
          // code if everything went fine
          // request.responseText for printing echoes
          alert("WE HERE!");
      } else {
          // code if otherwise
      }
    };

    // sending data here
    request.send(data);
}
*/

function req() {
$('#file-add-button').on('click', function(e) {
  // TODO do a check to see if any input values are missing
  e.preventDefault();
    $.ajax({
        url : 'http://www.bagelcron.com/php/responses/parsehtml.php',
        type: "POST",
        data: $('#file-add-form').serialize(),
        success: function (result) {
            $("#results").html(result);
        },
        error: function (jXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
  $("#results").html('<p>Adding file...</p>');
});
}

/*
document.addEventListener('', function() {
$('#file-add-button').on('click', function(e) {
  // TODO do a check to see if any input values are missing
  e.preventDefault();
    $.ajax({
        url : 'http://www.bagelcron.com/php/responses/parsehtml.php',
        type: "POST",
        data: $('#file-add-form').serialize(),
        success: function (result) {
            $("#results").html(result);
        },
        error: function (jXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
  $("#results").html('<p>Adding file...</p>');
});

}, false);

*/