<!DOCTYPE html>
<html>
<body>
<textarea id="pasteArea" placeholder="Paste Image Here"></textarea>

<form method="post">
 encoded Data: <input id="post_data" name="post_data"></input><br>
<input type="submit">
<br><a href="display foler contents.php">Click to view uploaded imgaes</a><br>

<script>
document.getElementById('pasteArea').onpaste = function (event) {
  // use event.originalEvent.clipboard for newer chrome versions
  var items = (event.clipboardData  || event.originalEvent.clipboardData).items;
  console.log(JSON.stringify(items)); // will give you the mime types
  // find pasted image among pasted items
  var blob = null;
  for (var i = 0; i < items.length; i++) {
    if (items[i].type.indexOf("image") === 0) {
      blob = items[i].getAsFile();
    }
  }
  // load image if there is a pasted image
  if (blob !== null) {
    var reader = new FileReader();
    reader.onload = function(event) {
      console.log(event.target.result); // data url!
      //document.getElementById("pastedImage").src = event.target.result;
      document.getElementById("post_data").value = event.target.result;
    };
    reader.readAsDataURL(blob);
  }
}
</script>


</body>
</html>

<?php
if (!file_exists('upload')) {
    mkdir('upload', 0777, true);
}
 if (isset($_POST['post_data'])) {
$request = $_POST['post_data'];
echo "<br><img src=$request></img>";

/************* saving image ***********/

define('UPLOAD_DIR', 'upload/');
$img = $_POST['post_data'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);
$file = UPLOAD_DIR . uniqid() . '.png';

file_put_contents($file, $data);
}

?>
