<?php

    $req_data["kind"] = $_POST['kind'];
    $req_data["app_name"] = $_POST['app_name'];
    $req_data["app_blueprint_name"] = $_POST['app_blueprint_name'];
    $req_data["app_username"] = $_POST['app_username'];
    $req_data["app_password"] = $_POST['app_password'];
    $req_data["app_description"] = $_POST['app_description'];
    $req_data["uuid"] = $_POST['uuid'];
    $req_data["app_uuid"] = $_POST['app_uuid'];
    $req_config["hostIP"] = $_POST['hostIP'];
    $req_config["hostPort"] = $_POST['hostPort'];
    $req_config["hostEndPoint"] = $_POST['hostEndPoint'];

    // $req_data_raw = '{"spec":{"app_profile_reference":{"kind":"app_profile","name":"rcj_test_multi","uuid":"' . $req_data["uuid"] . '"},"app_name":"' . $req_data["app_name"] . '","app_description":"' . $req_data["app_description"] . '"}}';

    $req_data_raw = array("spec" => array("app_profile_reference" => array("kind" => $req_data["kind"], "name" => $req_data["app_blueprint_name"], "uuid" => $req_data["app_uuid"]), "app_name" => $req_data["app_name"], "app_description" => $req_data["app_description"]));

    // $req_data_raw = file_get_contents('calm-api-data.json');
    $req_data_temp = json_encode($req_data_raw);

    $auth_creds = base64_encode($req_data["app_username"] . ":" . $req_data["app_password"]);

$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, "https://" . $req_config["hostIP"] . ":" . $req_config["hostPort"] . "/api/nutanix/v3/blueprints/" . $req_data["uuid"] . "/simple_launch");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, false);
curl_setopt($curl, CURLOPT_ENCODING, "");
curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
curl_setopt($curl, CURLOPT_TIMEOUT, 30);
curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($curl, CURLOPT_POSTFIELDS, $req_data_temp);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic ' . $auth_creds, 'Content-Type: application/json'));
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

$m_pattern = '/1$';
$m_str = '1';

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo preg_replace($m_pattern, $response, $m_str);
}
?>
