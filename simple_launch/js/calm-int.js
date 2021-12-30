
function l_invokeLauncher(l_xhr, l_form) {
		
	// document.forms[l_form].elements["vol_val"].value = document.forms[l_form].elements["z_volume"].value;
	if(l_xhr.readyState == 4 && l_xhr.status == 200) {
		t_state = JSON.parse(JSON.stringify(l_xhr.responseText));
		document.getElementById("infoPanel").innerHTML = t_state + ' : ' + l_xhr.readyState + ' : ' +l_xhr.status + ' : ' + l_xhr.responseText;
	//	document.forms[l_form].elements["infoPanel"].innerHTML = t_state;
	}
	// document.getElementById("infoPanel").innerHTML = t_state + ' : ' + l_xhr.readyState + ' : ' +l_xhr.status + ' : ' + l_xhr.responseText;


}

function m_launchApplication(v_form) {
	
	m_url = "engine/temp-poster.php";
	t_state = "{}";

	var rspObj = new XMLHttpRequest();


	// rspObj.onreadystatechange = l_invokeLauncher(rspObj, v_form);

	rspObj.onreadystatechange = function() {
		if(this.readyState == 4 && this.status == 200) {
			// var t_state = JSON.parse(this.responseText);
			var t_state = JSON.parse(this.responseText);
			// document.getElementById("infoPanel").innerHTML = t_state + ' : ' + this.readyState + ' : ' + this.status + ' : ' + this.responseText;
			btn_refresh = '<input id="btn_refresh" name="btn_refresh" type="button" value="REFRESH" onclick="m_refreshRequestStatus(' +  t_state.status.request_id + ')"><br>';
			document.getElementById("infoPanel").innerHTML = btn_refresh + '<table class="progressMon"><tr><th>Request ID</th><th>App ID</th><th>App Name</th></tr><tr><td>' + t_state.status.request_id + '</td><td>' + t_state.spec.app_name + '</td><td>' + t_state.spec.app_name + '</td></tr></table>';
		}


	}

	t_app_profile = document.forms[v_form].elements["app_blueprint_profile"].value;
	t_app_bp_name = document.forms[v_form].elements["app_blueprint_name"].value;
	t_app_name = document.forms[v_form].elements["app_name"].value;
	t_app_description = document.forms[v_form].elements["app_description"].value;
	t_app_username = document.forms[v_form].elements["app_username"].value;
	t_app_password = document.forms[v_form].elements["app_password"].value;
	t_blueprint_uuid = document.forms[v_form].elements["app_blueprint_uuid"].value;
	t_app_uuid = document.forms[v_form].elements["app_uuid"].value;
	t_hostIP = document.forms[v_form].elements["hostIP"].value;
	t_hostPort = document.forms[v_form].elements["hostPort"].value;
	t_endPoint = document.forms[v_form].elements["hostEndPoint"].value;



	m_params = "kind=" + t_app_profile;
	m_params += "&app_name=" + t_app_name;
	m_params += "&app_blueprint_name=" + t_app_bp_name;
	m_params += "&app_username=" + t_app_username;
	m_params += "&app_password=" + t_app_password;
	m_params += "&name=" + t_app_profile_name;
	m_params += "&app_description=" + t_app_description;
	m_params += "&uuid=" + t_blueprint_uuid;
	m_params += "&app_uuid=" + t_app_uuid;
	m_params += "&hostIP=" + t_hostIP;
	m_params += "&hostPort=" + t_hostPort;
	m_params += "&hostEndPoint=" + t_endPoint;


	rspObj.open("POST", m_url, true);
	rspObj.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	rspObj.send(m_params);

}

