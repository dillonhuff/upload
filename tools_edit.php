<!DOCTYPE html>

<?php
   if ('POST' === $_SERVER['REQUEST_METHOD']) {
   if ($_POST['tool']) {
   file_put_contents("tool_table.txt", $_POST['tool'] . PHP_EOL, FILE_APPEND);
   }
   if ($_POST['basePlate']) {
   file_put_contents("base_plate_table.txt", $_POST['basePlate'] . PHP_EOL, FILE_APPEND);
   }

   if ($_POST['vice']) {
   file_put_contents("vice.txt", "");
   file_put_contents("vice.txt", $_POST['vice'] . PHP_EOL, FILE_APPEND);
   }

   if ($_POST['clearAll']) {
   file_put_contents("vice.txt", "");
   file_put_contents("tool_table.txt", "");
   file_put_contents("base_plate_table.txt", "");
   }

   $tool_str = file_get_contents("tool_table.txt");
   $base_str = file_get_contents("base_plate_table.txt");
   $vice_str = file_get_contents("vice.txt");

   }
   
   ?>


<html>

  <head>
    <meta charset="utf-8">
  </head>

  <body>

    <?php
       
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

    <?php
       
       if ($base_str) {
       echo $base_str;
       } else {
       echo "No base plates yet";
       }

       ?>

    <form method="post">
      <input type="text" name="basePlate" />
      <input type="submit" value="Add Base Plate" />
    </form>

    <?php
       
       if ($vice_str) {
       echo $vice_str;
       } else {
       echo "No vice yet";
       }

       ?>

    <form method="post">
      <input type="text" name="vice" />
      <input type="submit" value="Set Vice" />
    </form>


    <form action="tools_edit.php" method="post" enctype="multipart/form-data">
      Select STL file to upload:
      <input type="file" name="fileToUpload" id="fileToUpload">
      <input type="submit" value="Upload" name="submit">
    </form>

    <form action="tools_edit.php" method="post" name="clearAll">
      <input type="submit" value="Clear All" name="clearAll">
    </form>

    <?php
       $target_dir = "uploads/";
       $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
       $mesh_file = "meshes/test_mesh.json";

       if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
       exec("./json-mesh " . $target_file . " meshes/test_mesh.json");
       echo "Current STL model: " . $target_file;
       }

       ?>

    <div id="render">

      <script src="js/three.js"> </script>
      <script src="js/render_mesh.js"> </script>
      <script>
<!-- 	var mesh = httpGet("/meshes/test_mesh.json"); -->
<!-- 	var m = build_mesh(mesh); -->
<!-- 		scene.add( m ); -->

<!-- 	<\!-- var light = new THREE.DirectionalLight( 0xffffff ); -\-> -->
<!-- 	<\!-- light.position.set( 1, 1, 1 ); -\-> -->
<!-- 	<\!-- scene.add( light ); -\-> -->

<!-- 	var pointLight = -->
<!-- 	new THREE.PointLight(0xFFFFFF); -->

	
<!-- // set its position -->
<!-- pointLight.position.x = 10; -->
<!-- pointLight.position.y = 50; -->
<!-- pointLight.position.z = 130; -->

<!-- // add to the scene -->
<!-- scene.add(pointLight); -->

<!-- 	var geometry = new THREE.BoxGeometry( 1, 1, 1 ); -->
<!-- var material = new THREE.MeshLambertMaterial( { color: 0xaaaaaa } ); -->
<!-- var cube = new THREE.Mesh( geometry, material ); -->
<!-- scene.add( cube ); -->
	
<!-- 	camera.position.x = 50.0; -->
<!-- 	camera.position.y = 50.0; -->
<!-- 	camera.position.z = 50.0 -->
<!-- 	render(scene, camera, renderer); -->


<!-- var geometry = new THREE.BoxGeometry( 1, 1, 1 ); -->
<!-- var material = new THREE.MeshLambertMaterial( { color: 0xaaaaaa } ); -->
<!-- var cube = new THREE.Mesh( geometry, material ); -->
<!-- scene.add( cube ); -->

var mesh = httpGet("/meshes/test_mesh.json");
var m = build_mesh(mesh);
scene.add( m );

var pointLight =
  new THREE.PointLight(0xFFFFFF);

// set its position
pointLight.position.x = 10;
pointLight.position.y = 50;
pointLight.position.z = 130;

// add to the scene
scene.add(pointLight);

camera.position.z = 12;

render(scene, camera, renderer);

      </script>

    </div>

  </body>

</html>
