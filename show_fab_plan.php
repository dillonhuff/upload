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

    <script src="js/three.min.js"> </script>
    <script src="js/OrbitControls.js"> </script>
    <script src="js/build_mesh.js"> </script>
    <script src="js/render_mesh.js"> </script>

    <script>
      var pl = httpGet("/meshes/final_plan.json");
      var p = JSON.parse(pl);
      var meshes = setup_meshes(p);
      var current_mesh = 0;
    </script>

    <div id="Button List">
      <form id="select_buttons">
	Select A Step
      </form>
    </div>

    <div id="render">

      <script> 

	var scene, camera, renderer;
	for (var ind = 0; ind < p.setups.length; ind++)
			{
				var step_button = document.createElement("input");
				step_button.setAttribute("type", "button");
				step_button.setAttribute("value", ind);
				step_button.setAttribute("onclick", "scene.remove(meshes[current_mesh]); current_mesh = " + ind + "; scene.add(meshes[current_mesh])");
				document.getElementById("select_buttons").appendChild(step_button);
				}
	basic_init();
	scene.add(meshes[current_mesh]);
	render();

      </script>

    </div>

  </body>

</html>