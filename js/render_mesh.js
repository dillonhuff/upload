var render = function(scene, camera) {
    requestAnimationFrame( render );

    renderer.render(scene, camera);
};

var build_json_mesh = function(json_mesh) {
    var renderer = new THREE.WebGLRenderer();
    renderer.setSize( window.innerWidth, window.innerHeight );
    document.body.appendChild( renderer.domElement );

    var geometry = new THREE.Geometry();
    geometry.vertices.push(new THREE.Vector3(-.20, .20, 0));
    geometry.vertices.push(new THREE.Vector3(-.20, -.20, 0));
    geometry.vertices.push(new THREE.Vector3(.20, -.20, 0));

    geometry.faces.push(new THREE.Face3(0, 1, 2));
    
    var material = new THREE.MeshBasicMaterial( { color: 0x00ff00 } );
    return new THREE.Mesh( geometry, material );
}

var render_json_mesh = function (scene, camera, json_mesh) {
    var scene = new THREE.Scene();
    var camera = new THREE.PerspectiveCamera( 75, window.innerWidth/window.innerHeight, 0.1, 1000 );

    //    var cube = build_json_mesh(json_mesh);
    var renderer = new THREE.WebGLRenderer();
    renderer.setSize( window.innerWidth, window.innerHeight );
    document.body.appendChild( renderer.domElement );

    var geometry = new THREE.Geometry();
    geometry.vertices.push(new THREE.Vector3(-.20, .20, 0));
    geometry.vertices.push(new THREE.Vector3(-.20, -.20, 0));
    geometry.vertices.push(new THREE.Vector3(.20, -.20, 0));

    geometry.faces.push(new THREE.Face3(0, 1, 2));
    
    var material = new THREE.MeshBasicMaterial( { color: 0x00ff00 } );
    var cube = new THREE.Mesh( geometry, material );
    
    scene.add( cube );

    camera.position.z = 5;
    render(scene, camera);
};

