<!DOCTYPE html>

<html>

  <head>
    <meta charset="utf-8">

    <style>
      #render {
      background-color: #ffffff;
      }
    </style>
  </head>

  <body>

    <div id="data_input">

      <?php
	 $base_plates = array();
	 if('POST' === $_SERVER['REQUEST_METHOD']) {
	 if( ! empty($_POST['base_plate'])) {
         $base_plates[] = $_POST['base_plate'];
	 }
	 if(isset($_POST['base_plates']) && is_array($_POST['base_plates'])) {
         foreach($_POST['base_plates'] as $base_plate) {
         $base_plates[] = $base_plate;
         }
	 }
	 }

	 ?>

      <iframe src="tools_edit.php" style="width=30%, height=30%"> </iframe>

      <?php if($base_plates): ?>
      <ul>
	<?php foreach($base_plates as $tool): ?>
	<li><?php echo $tool; ?></li>
	<?php endforeach; ?>
      </ul>
      <?php endif; ?>

      <form method="post">
	<input type="text" name="base_plate" />
	<input type="submit" value="Add Base Plate" />
	<?php if($base_plates): ?>
	<?php foreach($base_plates as $tool): ?>
	<input type="hidden" name="base_plates[]" value="<?php echo $tool; ?>" />
	<?php endforeach; ?>
	<?php endif; ?>
      </form>
      
    </div>

    <div id="render">

      <script src="js/three.js"> </script>
      <script src="js/render_mesh.js"> </script>
      <script>
	var mesh = httpGet("/meshes/test_mesh.json");
	var m = build_mesh(mesh);
	/* var light = new THREE.AmbientLight( 0xf0f0f0 ); // soft white light */
	/* var light = new THREE.PointLight( 0xffffff, 10, 100 ); */
	/* light.position.set( 2.0, 2.0, 3.0); */
	var light = new THREE.DirectionalLight( 0xffffff );
	light.position.set( 1, 1, 1 );
	scene.add( light );
	scene.add( m );
	camera.position.x = 5.0;
	camera.position.y = 5.0;
	camera.position.z = 5.0;
	render(scene, camera, renderer);
      </script>

    </div>

  </body>

</html>
