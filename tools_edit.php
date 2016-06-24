<!DOCTYPE html>

<?php

   $inputs_json_str = file_get_contents("setup_info.json");
   $json = json_decode($inputs_json_str);

if ($_POST['basePlate']) {
$json->fixtures->base_plates[] = $_POST['basePlate'];
}

if ($_POST['toolDiameter']) {
$new_tool = array("tool_diameter"=>$_POST['toolDiameter'], "tool_length"=>$_POST['toolLength']);
$json->tools[] = $new_tool;
}

file_put_contents("setup_info.json", json_encode($json));
$inputs_json_str = file_get_contents("setup_info.json");
$json = json_decode($inputs_json_str);

$tool_list = $json->tools;
$fixtures = $json->fixtures;
$base_plates = $fixtures->base_plates;
$vice = $fixtures->vice;
$workpiece = $json->workpiece;

?>


<html>

  <head>
    <meta charset="utf-8">
  </head>

  <body>

    <ul>
      <?php
	 foreach($tool_list as $tool) {
	 echo "<ul>";
	 echo $tool->tool_diameter . " " . $tool->tool_length;
      echo "</ul>";
    }
       ?>
    </ul>

    <form action="tools_edit.php" method="post">
      <input type="text" name="toolDiameter" />
      <input type="text" name="toolLength" />
      <input type="submit" value="Add Tool" />
    </form>

    <ul>
      <?php
	 foreach($base_plates as $plate) {
	 echo "<ul>";
	 echo $plate;
      echo "</ul>";
    }
       ?>
    </ul>
    
    <form action="tools_edit.php" method="post">
      <input type="text" name="basePlate" />
      <input type="submit" value="Add Base Plate" name="base_plate" />
    </form>

    <ul>

      <?php
	 
      echo "<ul>";
	echo "X length: " . $vice->vice_x_length;
	echo "</ul>";

      echo "<ul>";
	echo "Y length: " . $vice->vice_y_length;
	echo "</ul>";

      echo "<ul>";
	echo "Base height: " . $vice->vice_base_height;
	echo "</ul>";

    echo "<ul>";
      echo "Top height: " . $vice->vice_top_height;
      echo "</ul>";

    echo "<ul>";
      echo "Clamp width: " . $vice->vice_clamp_width;
      echo "</ul>";

    echo "<ul>";
      echo "Max jaw width: " . $vice->vice_max_jaw_width;
      echo "</ul>";

    echo "<ul>";
      if ($vice->vice_protective_base_plate_height > 0.0) {
      echo "Base plate height: " . $vice->vice_protective_base_plate_height;
      }
      echo "</ul>";
    
      ?>
    </ul>

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

    <form action="show_fab_plan.php" method="post">
      <input type="submit" value="Create Fabrication Plan" name="submit">
    </form>

    <?php
       $target_dir = "uploads/";
       $target_file = "uploads/active_stl.stl";

       $mesh_file = "meshes/test_mesh.json";

       if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
       exec("./json-mesh " . $target_file . " meshes/test_mesh.json");
       echo "Current STL model: " . $target_file;
       }

       ?>

  </body>

</html>
