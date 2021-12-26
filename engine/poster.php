<?php
    
    
$req_data = array();
$req_config = array();
    
    // Gather data from the input form here
    
    $req_data["kind"] = $_POST['kind'];
    $req_data["app_name"] = $_POST['app_name'];
    $req_data["app_description"] = $_POST['app_description'];
    $req_data["uuid"] = $_POST['uuid'];
    $req_config["hostIP"] = $_POST['hostIP'];
    $req_config["hostPort"] = $_POST['hostPort'];
    $req_config["hostEndPoint"] = $_POST['hostEndPoint'];

    $config_vals["baseUrl"] = "https://" . $req_config["hostIP"]. ":" . $req_config["hostPort"] . "/" . $req_config["hostEndPoint"] . "blueprints/" . $req_data["uuid"] . "/simple_launch";
    
    $req_data_q = http_build_query($req_data);
    // $req_data_q = urlencode($req_data_qt);
    
    // ****
    
    // Setup HTTP options
    $req_files = array();
    $req_options = array( 'https' => array('method' => 'POST', 'content' => $req_data_q, 'header' => "Authorization: Basic " . "Content-type: application/json" . "Content-length: " . strlen($req_data_q), 'verify_peer' => false, 'verify_peer_name' => false));
    $ret_info = array();

    // ****
    
    // Initialize stream
    
    $req_stream = stream_context_create($req_options);
    $req_fileptr = fopen($config_vals["baseUrl"], 'rb', false, $req_stream);

    if($req_fileptr) {
	    echo stream_get_contents($req_fileptr, -1);
    }

?>
