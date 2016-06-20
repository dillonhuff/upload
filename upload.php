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
$tools = array();
if('POST' === $_SERVER['REQUEST_METHOD']) {
    if( ! empty($_POST['tool'])) {
        $tools[] = $_POST['tool'];
    }
    if(isset($_POST['tools']) && is_array($_POST['tools'])) {
        foreach($_POST['tools'] as $tool) {
            $tools[] = $tool;
        }
    }
}

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

<?php if($tools): ?>
            <ul>
                <?php foreach($tools as $tool): ?>
                    <li><?php echo $tool; ?></li>
                <?php endforeach; ?>
            </ul>
<?php endif; ?>

<form method="post">
            <input type="text" name="tool" />
            <input type="submit" value="Add Tool" />
            <?php if($tools): ?>
                <?php foreach($tools as $tool): ?>
                    <input type="hidden" name="tools[]" value="<?php echo $tool; ?>" />
                <?php endforeach; ?>
            <?php endif; ?>
</form>

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
    
<form action="upload.php" method="post" enctype="multipart/form-data">
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
    echo "Selected new STL model";
    /* foreach ($output as $k => $v) */
    /*     echo $v . "<br>"; */
}

?>

</div>

<div id="render">

<script src="js/three.js"> </script>
<script src="js/render_mesh.js"> </script>
<script>
    var mesh = httpGet("/meshes/test_mesh.json");
    var m = build_mesh(mesh);

    scene.add( m );
    camera.position.x = 5;
    camera.position.z = 10;
    render(scene, camera, renderer);

</script>

</div>

</body>

</html>