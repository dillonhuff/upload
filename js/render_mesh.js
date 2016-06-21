function init() {
    scene = new THREE.Scene();
    camera = new THREE.PerspectiveCamera( 75, window.innerWidth/window.innerHeight, 0.1, 1000 );

    renderer = new THREE.WebGLRenderer();
    renderer.setClearColor( 0xffffff );

    renderer.setSize( window.innerWidth, window.innerHeight );
    document.body.appendChild( renderer.domElement );

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

controls = new THREE.OrbitControls(camera, renderer.domElement);

}

var render = function (sc, cam, rr) {
    requestAnimationFrame( render );

    rr.render(sc, cam);
    controls.update();
};


