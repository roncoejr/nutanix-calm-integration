function m_toggleNetworkSourceOptionsAvailable(v_form) {

	var theSelectedForm = document.forms[v_form];

	if(theSelectedForm.elements["v_cmd"].value == "NETWORK") {

		n_buttons = theSelectedForm.elements["v_cmd_type"].length;
		// alert("Network Option Selected: " + n_buttons);
		for(n_fields = 0; n_fields <= n_buttons-1; n_fields++) {
			theSelectedForm.elements["v_cmd_type"][n_fields].disabled = false;			
		}
	}
	else {
		// alert("Other source chosen");
		for(n_fields = 0; n_fields <= n_buttons-1; n_fields++) {
			theSelectedForm.elements["v_cmd_type"][n_fields].disabled = true;			
		}
	}
}

function m_changeNetworkSource(v_form) {

}

function m_allreceivers_power() {

	t_forms = document.forms[0].elements["all_forms"].value;
	t_cmd = document.forms[0].elements["v_cmd"].value;

	list_forms = t_forms.split(",");

	// alert(list_forms.length);
	//
	//
	
	for(i=0; i <= list_forms.length-1; i++) {
	
		document.forms[list_forms[i]].elements["v_cmd"].value = t_cmd;
		m_changeReceiverPowerState(list_forms[i]);

		// alert("Form: " + list_forms[i] + " would be changed.");
	}
}

function l_setreceivers_volume(l_forms, l_cmd) {

	
	for(i=0; i <= l_forms.length-1; i++) {
		if(document.forms[l_forms[i]].elements["v_zone"].value != "MAIN") {
			// alert(l_cmd);
			// alert(parseInt(l_cmd));
			// alert(parseInt(l_cmd)*.18);
			lm_cmd = parseInt(l_cmd)+(parseInt(parseInt(l_cmd))*.28);
		//	alert(lm_cmd);
		}
		else {
			lm_cmd = l_cmd;
		}
		document.forms[l_forms[i]].elements["z_volume"].value = lm_cmd;
		m_changeReceiverVolume(list_forms[i]);
	}
}

function l_setreceivers_tuner(l_forms, l_cmd) {

	for(i=0; i <= l_forms.length-1; i++) {
	
		document.forms[l_forms[i]].elements["station_val"].value = l_cmd;
		m_changeReceiverTuner(list_forms[i]);
	}
}

function m_setreceivers_tuner() {

	t_forms = document.forms[1].elements["all_forms_source"].value;
	t_cmd = document.forms[1].elements["station_val"].value;
	// document.forms[1].elements["station_val"].value = t_cmd;

	list_forms = t_forms.split(",");

	l_setreceivers_tuner(list_forms, t_cmd);

}


function m_setreceivers_volume() {

	t_forms = document.forms[0].elements["all_forms"].value;
	t_cmd = document.forms[0].elements["z_volume"].value;
	document.forms[0].elements["vol_val"].value = t_cmd;

	list_forms = t_forms.split(",");

	l_setreceivers_volume(list_forms, t_cmd);

}

function l_change_station(l_xhr, l_form) {
		
	// document.forms[l_form].elements["vol_val"].value = document.forms[l_form].elements["z_volume"].value;
	if(l_xhr.readyState == 4 && l_xhr.status == 200) {
		t_state = JSON.parse(JSON.stringify(l_xhr.responseText));
	}

}

function m_changeReceiverTuner(v_form) {
	
	m_url = "engine/poster.php";
	t_state = "{}";

	var rspObj = new XMLHttpRequest();


	rspObj.onreadystatechange = l_change_station(rspObj, v_form);

	t_action = document.forms[v_form].elements["v_actn_sta"].value;
	t_receiver = document.forms[v_form].elements["v_rcvr"].value;
	t_zone = document.forms[v_form].elements["v_zone"].value;
	t_cmd = document.forms[v_form].elements["v_actn_sta"].value + document.forms[v_form].elements["station_val"].value;
	t_sbcNode = document.forms[v_form].elements["sbcNode"].value;



	m_params = "v_actn=" + t_action;
	m_params += "&v_rcvr=" + t_receiver;
	m_params += "&v_zone=" + t_zone;
	m_params += "&v_cmd=" + t_cmd;
	m_params += "&sbcNode=" + t_sbcNode;


	rspObj.open("POST", m_url, true);
	rspObj.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	rspObj.send(m_params);

}

function l_setreceivers_source(l_forms, l_cmd) {

	for(i=0; i <= l_forms.length-1; i++) {
	
		document.forms[l_forms[i]].elements["v_cmd"].value = l_cmd;
		m_changeReceiverInputSource(l_forms[i]);
	}
}

function m_setreceivers_source() {

	t_forms = document.forms[1].elements["all_forms_source"].value;
	t_cmd = document.forms[1].elements["v_cmd"].value;
	// alert(t_cmd);
	// document.forms[0].elements["vol_val"].value = t_cmd;

	list_forms = t_forms.split(",");

	l_setreceivers_source(list_forms, t_cmd);
}

function l_changeVolume(l_xhr, l_form) {
	
		document.forms[l_form].elements["vol_val"].value = document.forms[l_form].elements["z_volume"].value;
		if(l_xhr.readyState == 4 && l_xhr.status == 200) {
			t_state = JSON.parse(JSON.stringify(l_xhr.responseText));
		}

}

function m_changeReceiverVolume(v_form) {

	m_url = "engine/poster.php";
	t_state = "{}";

	var rspObj = new XMLHttpRequest();


	document.forms[v_form].elements["vol_val"].value = document.forms[v_form].elements["z_volume"].value;
	rspObj.onreadystatechange = l_changeVolume(rspObj, v_form);

	t_action = document.forms[v_form].elements["v_actn_vol"].value;
	t_receiver = document.forms[v_form].elements["v_rcvr"].value;
	t_zone = document.forms[v_form].elements["v_zone"].value;
	t_cmd = document.forms[v_form].elements["v_cmd_vol"].value + document.forms[v_form].elements["z_volume"].value;
	t_sbcNode = document.forms[v_form].elements["sbcNode"].value;



	m_params = "v_actn=" + t_action;
	m_params += "&v_rcvr=" + t_receiver;
	m_params += "&v_zone=" + t_zone;
	m_params += "&v_cmd=" + t_cmd;
	m_params += "&sbcNode=" + t_sbcNode;


	rspObj.open("POST", m_url, true);
	rspObj.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	rspObj.send(m_params);

}

function m_changeReceiverPowerState(v_form) {

	m_url = "engine/poster.php";
	t_state = "{}";

	rspObj = new XMLHttpRequest();


	rspObj.onreadystatechange = function () {
		if(this.readyState == 4 && this.status == 200) {
			t_state = JSON.parse(JSON.stringify(this.responseText));
			// document.forms[v_form].elements["status_div"].innerHTML = this.responseText;
		}
	}

	t_action = document.forms[v_form].elements["v_actn"].value;
	t_receiver = document.forms[v_form].elements["v_rcvr"].value;
	t_zone = document.forms[v_form].elements["v_zone"].value;
	t_cmd = document.forms[v_form].elements["v_cmd"].value;
	t_sbcNode = document.forms[v_form].elements["sbcNode"].value;



	m_params = "v_actn=" + t_action;
	m_params += "&v_rcvr=" + t_receiver;
	m_params += "&v_zone=" + t_zone;
	m_params += "&v_cmd=" + t_cmd;
	m_params += "&sbcNode=" + t_sbcNode;


	// alert(m_params);

	// m_url += "?" + m_params;

	rspObj.open("POST", m_url, true);
	rspObj.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	rspObj.send(m_params);

}

function m_changeReceiverInputSource(v_form) {

	m_url = "engine/poster.php";
	t_state = "{}";

	rspObj = new XMLHttpRequest();


	rspObj.onreadystatechange = function () {
		if(this.readyState == 4 && this.status == 200) {
			t_state = JSON.parse(JSON.stringify(this.responseText));
			// document.forms[v_form].elements["status_div"].innerHTML = this.responseText;
		}
	}
	
	
	t_action = document.forms[v_form].elements["v_actn"].value;
	t_receiver = document.forms[v_form].elements["v_rcvr"].value;
	t_zone = document.forms[v_form].elements["v_zone"].value;
	t_cmd = document.forms[v_form].elements["v_cmd"].value;
	t_sbcNode = document.forms[v_form].elements["sbcNode"].value;



	m_params = "v_actn=" + t_action;
	m_params += "&v_rcvr=" + t_receiver;
	m_params += "&v_zone=" + t_zone;
	m_params += "&v_cmd=" + t_cmd;
	m_params += "&sbcNode=" + t_sbcNode;


	// alert(m_params);

	// m_url += "?" + m_params;

	rspObj.open("POST", m_url, true);
	rspObj.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	rspObj.send(m_params);

}
