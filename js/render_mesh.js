var scene = new THREE.Scene();
var camera = new THREE.PerspectiveCamera( 75, window.innerWidth/window.innerHeight, 0.1, 1000 );

var renderer = new THREE.WebGLRenderer();
renderer.setSize( window.innerWidth, window.innerHeight );
document.body.appendChild( renderer.domElement );

var parse_pts = function(jpts) {
    var ptArray = [];
    for (var i = 0; i < jpts.length; i++) {
	var v = new THREE.Vector3(jpts[i][0], jpts[i][1], jpts[i][2]);
	ptArray.push(v);
    }
    return ptArray;
};

var parse_faces = function(jfaces) {
    var ptArray = [];
    for (var i = 0; i < jfaces.length; i++) {
	ptArray.push(new THREE.Face3(jfaces[i][0], jfaces[i][1], jfaces[i][2]));
    }
    return ptArray;
};

var build_three_mesh = function(json_mesh) {
    //alert(json_mesh);
    var jm = JSON.parse(json_mesh);
//    alert(jm.pts);
    var pts = parse_pts(jm.pts);
//    alert(pts);
    var faces = parse_faces(jm.faces);
//    alert(faces);
    return {"pts" : pts, "faces" : faces};
}

var build_mesh = function(json_mesh) {
//    alert(json_mesh);
    var m = build_three_mesh(json_mesh);
    alert(m);
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


