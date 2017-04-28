function changePage(id) {
  if (id !== "index") {
    $('#main-content').load('php/' + id + '.php');
  } else $('#main-content').load('index.php');
}
