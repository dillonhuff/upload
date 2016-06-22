<!DOCTYPE html>

<html>

  <head>
    <meta charset="utf-8">

    <style>
      #left_div {
      background-color: #00eeff;
      width: 30px;
      }
      
      #button_list {
      background-color: #00eeff;
      }

      #render {
      background-color: #0000ff;
      }

      #text_box {
      background-color: #0000ff;
      }

    </style>

  </head>

  <body>

      <div id="left_div">
	<?php
	   $target_file = "uploads/active_stl.stl";
	   exec("./json-plan " . $target_file . " meshes/final_plan.json");

	   ?>

	<script src="js/three.min.js"> </script>
	<script src="js/OrbitControls.js"> </script>
	<script src="js/build_mesh.js"> </script>
	<script src="js/render_mesh.js"> </script>

	<script>
	  var pl = httpGet("/meshes/final_plan.json");
	  var p = JSON.parse(pl);
	  var vcolor = new THREE.MeshPhongMaterial({ color: 0x00aaff });
	  var mcolor = new THREE.MeshPhongMaterial({ color: 0xaaaaaa });
	  var meshes = setup_meshes(p, mcolor);
	  var vice_lists = setup_vice_lists(p, vcolor);
	  var current_mesh = 0;
	</script>

	
	<div id="button_list">
	  <div id="select_buttons">
	  </div>
	</div>

	<div id="text_box">

	  <textarea rows="15" cols="50" id="gcode_text" style="resize: none;"></textarea>

	  <script>
	    document.getElementById("gcode_text").value = p.setups[current_mesh].gcode;
	  </script>

	</div>
      </div>



      <div id="render">

	<script> 

	  var scene, camera, renderer;
	  for (var ind = 0; ind < p.setups.length; ind++)
				  {
				  var step_button = document.createElement("input");
				  step_button.setAttribute("type", "button");
				  step_button.setAttribute("value", ind);
				  step_button.setAttribute("onclick", "scene.remove(meshes[current_mesh]); current_mesh = " + ind + "; scene.add(meshes[current_mesh]);" +
				  "document.getElementById(\"gcode_text\").value = p.setups[current_mesh].gcode;");
				  document.getElementById("select_buttons").appendChild(step_button);
				  }
				  basic_init();
				  var edges = new THREE.FaceNormalsHelper( vice_lists[current_mesh][0], 2, 0x00ff00, 1 );
				  /*scene.add(edges);*/
				  scene.add(meshes[current_mesh]);
				  add_vice_list(vice_lists[current_mesh]);
				  render();
				  
				  </script>

      </div>


  </body>

</html>
