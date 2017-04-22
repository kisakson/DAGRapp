document.addEventListener('DOMContentLoaded', function() {
  var addDAGRButton = document.getElementById('addDAGR');
  var homepageButton = document.getElemenyById('homepage');

  // I am following this tutorial: https://www.sitepoint.com/create-chrome-extension-10-minutes-flat/

  addDAGRButton.addEventListener('click', function() {
    /*chrome.tabs.getSelected(null, function(tab) {
      d = document;
      var f = d.createElement('form');
      f.action = 'http://gtmetrix.com/analyze.html?bm';
      f.method = 'post';
      var i = d.createElement('input');
      i.type = 'hidden';
      i.name = 'url';
      i.value = tab.url;
      f.appendChild(i);
      d.body.appendChild(f);
      f.submit();

      // make a call that adds current DAGR to the database.
      // I think we need to make a call to the webserver, THEN the webserver connects to the database
      // I believe the extension itself cannot connect to the database. we need the mediator
      // read this: http://stackoverflow.com/questions/20048483/insert-into-mysql-from-chrome-extension

    });*/
  }, false);

  homepageButton.addEventListener('click', function() {
    /*chrome.tabs.getSelected(null, function(tab) {
      d = document;
      var f = d.createElement('form');
      f.action = 'http://gtmetrix.com/analyze.html?bm';
      f.method = 'post';
      var i = d.createElement('input');
      i.type = 'hidden';
      i.name = 'url';
      i.value = tab.url;
      f.appendChild(i);
      d.body.appendChild(f);
      f.submit();

      // open new tab that links to our webpage

    }); */
  }, false);

}, false);