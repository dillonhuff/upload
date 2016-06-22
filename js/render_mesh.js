function basic_init() {
    scene = new THREE.Scene();
    camera = new THREE.PerspectiveCamera( 75, window.innerWidth/window.innerHeight, 0.1, 1000 );

    renderer = new THREE.WebGLRenderer();
    renderer.setClearColor( 0xffffff );

    renderer.setSize( window.innerWidth, window.innerHeight );
    document.body.appendChild( renderer.domElement );

    var axisHelper = new THREE.AxisHelper( 5 );
    scene.add( axisHelper );

    var pointLight =
	new THREE.PointLight(0xFFFFFF);

    // set its position
    pointLight.position.x = 10;
    pointLight.position.y = 50;
    pointLight.position.z = 130;

    // add to the scene
    scene.add(pointLight);

    // var amb_light = new THREE.AmbientLight( 0xbbbbbb ); // soft white light
    // scene.add( amb_light );

    camera.position.z = 12;

    controls = new THREE.OrbitControls(camera, renderer.domElement);
    
}

function init() {
    basic_init();
    
    var mesh = httpGet("/meshes/test_mesh.json");
    var m = build_mesh(mesh);
    scene.add( m );
}

function add_vice_list(vices) {
    for (var i = 0; i < vices.length; i++) {
	scene.add(vices[i]);
    }
}

function setup_vice_lists(plan, mat) {
    var vice_lists = [];
    var s = plan.setups;
    for (var i = 0; i < s.length; i++) {
	var vl = s[i].vice;
	var lst = [];
	for (var j = 0; j < vl.length; j++) {
	    lst.push(build_m(vl[j], mat));
	}
	vice_lists.push(lst);
    }
    return vice_lists;
}

function setup_meshes(plan, mat) {
    var meshes = [];
    var s = plan.setups;
    for (var i = 0; i < s.length; i++) {
	meshes.push(build_m(s[i].partMesh, mat));
    }
    return meshes;
}

function show_plan(plan, i) {
    var s = p.setups;
    scene.add( build_mesh(s[i].partMesh) );
}

function initPlan(plan, i) {
    basic_init();
    show_plan(plan, i);
}

function render() {
    requestAnimationFrame( render );

    renderer.render(scene, camera);
    controls.update();
};


