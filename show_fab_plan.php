<!DOCTYPE html>

<html>

  <head>
    <meta charset="utf-8">
  </head>

  <body>
    <?php
       $mesh_file = "meshes/test_mesh.json";

       exec("./json-plan " . "uploads/ComplexRectanglePart1.stl" . " meshes/final_plan.json");

       ?>

    <div id="render">

      <script src="js/three.min.js"> </script>
      <script src="js/OrbitControls.js"> </script>
      <script src="js/build_mesh.js"> </script>
      <script src="js/render_mesh.js"> </script>
      <script> 

	var scene, camera, renderer;
	
	initPlan();
	render();

      </script>

    </div>

  </body>

</html>
