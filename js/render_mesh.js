var scene = new THREE.Scene();
var camera = new THREE.PerspectiveCamera( 75, window.innerWidth/window.innerHeight, 0.1, 1000 );

var renderer = new THREE.WebGLRenderer();
renderer.setSize( window.innerWidth, window.innerHeight );
document.body.appendChild( renderer.domElement );

var build_mesh = function(json_mesh) {
    var m = {"pts" : [new THREE.Vector3(-.20, .20, 0),
		      new THREE.Vector3(-.20, -.20, 0),
		      new THREE.Vector3(.20, -.20, 0)],
	     "faces" : [new THREE.Face3(0, 1, 2)]};
    
    var geometry = new THREE.Geometry();
    geometry.vertices = m.pts;
    geometry.faces = m.faces;

    // geometry.vertices.push(new THREE.Vector3(-.20, .20, 0));
    // geometry.vertices.push(new THREE.Vector3(-.20, -.20, 0));
    // geometry.vertices.push(new THREE.Vector3(.20, -.20, 0));

    // geometry.faces.push(new THREE.Face3(0, 1, 2));
    var material = new THREE.MeshBasicMaterial( { color: 0x00ff00 } );
    var mesh = new THREE.Mesh( geometry, material );
    return mesh
};

var render = function (sc, cam, rr) {
    requestAnimationFrame( render );

    rr.render(sc, cam);
};


