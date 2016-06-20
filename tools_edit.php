<!DOCTYPE html>

<html>

  <head>
    <meta charset="utf-8">
  </head>

  <body>

  <?php
	if ('POST' === $_SERVER['REQUEST_METHOD']) {
	   if ($_POST['tool']) {
	      file_put_contents("tool_table.txt", $_POST['tool'] . PHP_EOL, FILE_APPEND);
	   }
	   if ($_POST['base_plate']) {
	      file_put_contents("base_plate_table.txt", $_POST['base_plates'] . PHP_EOL, FILE_APPEND);
	   }

	   if ($_POST['vice']) {
	      file_put_contents("vice.txt", $_POST['base_plates'] . PHP_EOL, FILE_APPEND);
	   }

	 }
	
	$tool_str = file_get_contents("tool_table.txt");
	if ($tool_str) {
	   echo $tool_str;
	} else {
	echo "No tools yet";
	}
	
  ?>

      <form method="post">
	<input type="text" name="tool" />
	<input type="submit" value="Add Tool" />
      </form>

      <form method="post">
	<input type="text" name="base_plate" />
	<input type="submit" value="Add Base Plate" />
      </form>

      <form method="post">
	<input type="text" name="vice" />
	<input type="submit" value="Set Vice" />
      </form>


      <form action="tools_edit.php" method="post" enctype="multipart/form-data">
	Select STL file to upload:
	<input type="file" name="fileToUpload" id="fileToUpload">
	<input type="submit" value="Upload" name="submit">
      </form>

      <?php
	 $target_dir = "uploads/";
	 $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	 $mesh_file = "meshes/test_mesh.json";

	 if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	 exec("./json-mesh " . $target_file . " meshes/test_mesh.json");
	 echo "Current STL model: " . $target_file;
	 /* foreach ($output as $k => $v) */
      /*     echo $v . "<br>"; */
      }

      ?>


  </body>

</html>
