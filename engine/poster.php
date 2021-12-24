<?php
    
    
    $req_data = array();
    
    // Gather data from the input form here
    
    $req_data["v_rcvr"] = $_POST['v_rcvr'];
    $req_data["v_actn"] = $_POST['v_actn'];
    $req_data["v_cmd"] = $_POST['v_cmd'];
    $req_data["v_zone"] = $_POST['v_zone'];
    $req_data["sbcNode"] = $_POST['sbcNode'];

    $config_vals["baseUrl"] = "http://" . $req_data["sbcNode"]. ":8095";
    
    $req_data_q = http_build_query($req_data);
    
    // ****
    
    // Setup HTTP options
    $req_files = array();
    $req_options = array( 'http' => array('method' => 'POST', 'content' => $req_data_q, 'header' => "Content-type: application/x-www-form-urlencode" . "Content-length: " . strlen($req_data_q) . "Authorization: None "));
    $ret_info = array();

    // ****
    
    // Initialize stream
    
    $req_stream = stream_context_create($req_options);
    $req_fileptr = fopen($config_vals["baseUrl"], 'rb', false, $req_stream);

    echo stream_get_contents($req_fileptr, -1);

?>
