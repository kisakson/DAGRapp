document.addEventListener('DOMContentLoaded', function() {
  var addDAGRButton = document.getElementById('addDAGR');
  var homepageButton = document.getElemenyById('homepage');

  // I am following this tutorial: https://www.sitepoint.com/create-chrome-extension-10-minutes-flat/

  addDAGRButton.addEventListener('click', function() {
    chrome.tabs.getSelected(null, function(tab) {
			var form = document.createElement('form');
			//form.action = TODO!!!! something like 'http://gtmetrix.com/analyze.html?bm';
			form.method = 'post';

			var url = document.createElement('url');
			url.type = 'hidden';
			url.name = 'url';
			url.value = tab.url;
			form.appendChild(url);

			// things to insert: name, creator, time_created, local_of_online = online, url, size, file_type = html, parent_id set later
			// create some kind of website function that creates the DAGR with random guid and all that, creates the file with
			// the random guid and all of the input values, parent id is the DAGR guid, etc.
			// basically the extension sends over all of this info then creates the stuff
			// maybe runs another function over and over for all of the other files in the html doc, runs a similar call
			// but the insertion code all happens in the web application side
			// idea: click the add dagr button, it asks for a custom name which will be sent with name
			// include a call to the website to get all DAGR names and guids, ask to add file to a new DAGR or to an already made DAGR
			// use this as a dropdown thing
			// then it's like an if/else, either create the dagr or just insert the file and use p_id as the guid you selected  

			document.body.appendChild(form);
			form.submit();
    });
    /*
      // make a call that adds current DAGR to the database.
      // I think we need to make a call to the webserver, THEN the webserver connects to the database
      // I believe the extension itself cannot connect to the database. we need the mediator.actio
      // read this: http://stackoverflow.com/questions/20048483/insert-into-mysql-from-chrome-extension
    */
  }, false);

  homepageButton.addEventListener('click', function() {
    var homepage = "http://www.baglecron.com";
    chrome.tabs.create({ url: homepage });
  }, false);

}, false);

function createDAGR(guid, name, creator) {
	// make a call to the website to create the dagr
	// generate a random GUID
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

	var fname = document.createElement('dagrName');
	fname.type = 'hidden';
	fname.name = 'name';
	fname.value = name != null ? name : GUID;
	form.appendChild(fname);

	var fcreator = document.createElement('dagrCreator');
	fcreator.type = 'hidden';
	fcreator.name = 'creator';
	fcreator.value = creator;
	form.appendChild(fcreator);

	// generate current time
	var time = null;
	var ftime = document.createElement('dagrTime');
	ftime.type = 'hidden';
	ftime.name = 'time';
	ftime.value = time;
	form.appendChild(ftime);

	document.body.appendChild(form);
	form.submit();
};

function createFile(guid, name, creator, url, size, fileType, parentGUID, parentFile) {
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
};

function getIncludedFiles() {
	// return some file structure that contains all of the nested files we need to insert into the database
	// this is basically the huge HTML parsing part
	// for each of these files, include the create file
};
