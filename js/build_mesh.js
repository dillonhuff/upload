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

var httpGet = function(theUrl) {
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open("GET", theUrl, false); // false for synchronous request
    xmlHttp.send(null);
    return xmlHttp.responseText;
}

var build_three_mesh = function(json_mesh) {
    var pts = parse_pts(json_mesh.pts);
    var faces = parse_faces(json_mesh.faces);
    return {"pts" : pts, "faces" : faces};
}

function build_m(json_mesh, material) {
    var m = build_three_mesh(json_mesh);
    var geometry = new THREE.Geometry();
    geometry.vertices = m.pts;
    geometry.faces = m.faces;
    
    geometry.computeFaceNormals();

    var mesh = new THREE.Mesh( geometry, material );
    mesh.material.side = THREE.DoubleSide;

    return mesh
};

function build_mesh(json_mesh) {
    return build_m(json_mesh,
		   new THREE.MeshPhongMaterial( {
		       color: 0xff0000,
		       wireframe : false
		   }));
}
