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


  if (addFileButton) {
  	addFileButton.addEventListener('click', function() {
			document.getElementById("addform").innerHTML = "Loading...";

				document.getElementById("addform").innerHTML = "Loading...";
				var xhr = new XMLHttpRequest();
				xhr.open("GET", "http://www.bagelcron.com/php/responses/getdagrs.php", true);
				xhr.onreadystatechange = function() {
  				if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
    				document.getElementById("addform").innerHTML = xhr.responseText;

						var submitfile = document.getElementById('file-add-button');
						submitfile.addEventListener('click', function() {
							var xhr2 = new XMLHttpRequest();
							xhr2.open("POST", "http://www.bagelcron.com/php/responses/parsehtml.php", true);
							xhr2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
							var name = document.getElementById('file-name').value;
							var creator = document.getElementById('file-creator').value;
							var url = encodeURI("yes");
							var parent = document.getElementById('file-parent').value;
							chrome.tabs.query({currentWindow: true, active: true}, function(tabs){
        				url = tabs[0].url;
								var sendstring = 'name=' + name + '&creator=' + creator + '&url=' + url + '&parent=' + parent;
								document.getElementById("results").innerHTML = "Adding...";
								
								xhr2.onreadystatechange = function() {
									if (xhr2.readyState === XMLHttpRequest.DONE && xhr2.status === 200) {
										document.getElementById("results").innerHTML = xhr2.responseText;
									}
								}
								xhr2.send(sendstring);
    					});

						}, false);
  				}
				}
				xhr.send();

		}, false);
	}

  if (homepageButton) {
  	homepageButton.addEventListener('click', function() {
    	var homepage = "http://www.bagelcron.com/index.php";
    	chrome.tabs.create({ url: homepage });
  	}, false);
  }

}, false);
