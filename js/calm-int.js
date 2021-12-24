
function l_invokeLauncher(l_xhr, l_form) {
		
	// document.forms[l_form].elements["vol_val"].value = document.forms[l_form].elements["z_volume"].value;
	if(l_xhr.readyState == 4 && l_xhr.status == 200) {
		t_state = JSON.parse(JSON.stringify(l_xhr.responseText));
	}

}

function m_launchApplication(v_form) {
	
	m_url = "engine/poster.php";
	t_state = "{}";

	var rspObj = new XMLHttpRequest();


	rspObj.onreadystatechange = l_invokeLauncher(rspObj, v_form);

	t_app_profile = document.forms[v_form].elements["app_blueprint_profile"].value;
	t_app_name = document.forms[v_form].elements["app_blueprint_name"].value;
	t_app_description = document.forms[v_form].elements["app_description"].value;
	t_blueprint_uuid = document.forms[v_form].elements["app_blueprint_uuid"].value;
	t_hostIP = document.forms[v_form].elements["hostIP"].value;
	t_hostPort = document.forms[v_form].elements["hostPort"].value;
	t_endPoint = document.forms[v_form].elements["hostEndPoint"].value;



	m_params = "kind=" + t_app_profile;
	m_params += "&app_name=" + t_app_name;
	m_params += "&name=" + t_app_profile_name;
	m_params += "&app_description=" + t_app_description;
	m_params += "&uuid=" + t_blueprint_uuid;
	m_params += "&hostIP=" + t_hostIP;
	m_params += "&hostPort=" + t_hostPort;
	m_params += "&hostEndPoint=" + t_endPoint;


	rspObj.open("POST", m_url, true);
	rspObj.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	rspObj.send(m_params);

}

