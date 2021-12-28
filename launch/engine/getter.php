11192019/js/                                                                                        0000775 0001750 0001750 00000000000 13565120020 010553  5                                                                                                    ustar   ron                             ron                                                                                                                                                                                                                    11192019/js/automation.js                                                                           0000644 0001750 0001750 00000004420 13565120020 013267  0                                                                                                    ustar   ron                             ron                                                                                                                                                                                                                    
function m_checkPinStateFP(m_callingForm, status_div) {

	m_url = "./getter.php";
	t_state = "{}";

	rspObj = new XMLHttpRequest();


	rspObj.onreadystatechange = function () {

		if(this.readyState == 4 && this.status == 200) {
			t_state = JSON.parse(JSON.stringify(this.responseText));
			document.getElementById(status_div).innerHTML = this.responseText;
		}
	}


	v_m_PIN = m_callingForm.m_PIN.value;
	v_m_sbcNode = m_callingForm.sbcNode.value;
	v_m_agc = m_callingForm.a_graphical_switch.value;

	m_data = "?v_ACTION=test&m_PIN=" + v_m_PIN + "&sbcNode=" + v_m_sbcNode + "&a_graphical_switch=" + v_m_agc;

	m_url += m_data;
	// alert(m_url);
	rspObj.open("GET", m_url, true);
	rspObj.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	rspObj.send();
}


function m_changeSwitchState(v_form) {

	m_url = "./poster.php";
	t_state = "{}";

	rspObj = new XMLHttpRequest();


	rspObj.onreadystatechange = function () {

		if(this.readyState == 4 && this.status == 200) {
			t_state = JSON.parse(JSON.stringify(this.responseText));
			// document.forms[v_form].elements["status_div"].innerHTML = this.responseText;
		}
	}

	t_action = document.forms[v_form].elements["cmdAction"].value;
	t_pulsePIN = document.forms[v_form].elements["m_pulse_PIN"].value;

	if(t_action == "ON") {
		t_action = "OFF";
	}
	else {
		t_action = "ON";
	}

	if(t_pulsePIN == 0) {
		t_cmdType = "toggle";
	}
	else {
		t_cmdType = "pulse";
	}

	m_params = "cmdAction=" + t_action + "&sbcNode=" + document.forms[v_form].elements["sbcNode"].value;
	m_params += "&m_PIN=" + document.forms[v_form].elements["m_PIN"].value;
	m_params += "&cmdType=" + t_cmdType;
	m_params += "&m_pulse_PIN=" + document.forms[v_form].elements["m_pulse_PIN"].value;
	m_params += "&m_mon_PIN=" + document.forms[v_form].elements["m_mon_PIN"].value;
	m_params += "&m_duty_CYCLE=" + document.forms[v_form].elements["m_duty_CYCLE"].value;
	m_params += "&a_graphical_switch=" + document.forms[v_form].elements["a_graphical_switch"].value;

	tmp_ACTION = document.forms[v_form].elements["cmdAction"].value;
	m_params += "&v_ACTION=" + tmp_ACTION.toLowerCase();

	// alert(m_params);

	// m_url += "?" + m_params;

	rspObj.open("POST", m_url, true);
	rspObj.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	rspObj.send(m_params);

}
                                                                                                                                                                                                                                                11192019/poster.php                                                                                 0000644 0001750 0001750 00000003112 13565117667 012206  0                                                                                                    ustar   ron                             ron                                                                                                                                                                                                                    <?php
    
    # $config_vals = parse_ini_file("web.config");
    
    $req_data = array();
    
    $api_node = "ivrBrandingProfiles";
    
    // Gather data from the input form here
    
    $req_data["cmdType"] = $_POST['cmdType'];
    $req_data["cmdAction"] = $_POST['cmdAction'];
    $req_data["m_PIN"] = $_POST['m_PIN'];
    $req_data["v_ACTION"] = $_POST['v_ACTION'];
    $req_data["sbcNode"] = $_POST['sbcNode'];
    $req_data["m_pulse_PIN"] = $_POST['m_pulse_PIN'];
    $req_data["m_mon_PIN"] = $_POST['m_mon_PIN'];
    $req_data["m_duty_CYCLE"] = $_POST['m_duty_CYCLE'];

    $config_vals["baseUrl"] = "http://" . $req_data["sbcNode"]. ":8090";
    # $config_vals["baseUrl"] = "http://192.168.0.79:8090";
    
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

    # preg_match($config_vals["guid_pattern"], $http_response_header[5], $req_matches);
    
    //****
    
    // Expect the GUUID for the new Webbridge to be found at the following array index
    # echo $req_fileptr;    
    # echo $req_response;
    # header("Location:./switch.php");
?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                      11192019/styles/                                                                                    0000775 0001750 0001750 00000000000 13565120045 011471  5                                                                                                    ustar   ron                             ron                                                                                                                                                                                                                    11192019/styles/css/                                                                                0000775 0001750 0001750 00000000000 13565120054 012261  5                                                                                                    ustar   ron                             ron                                                                                                                                                                                                                    11192019/styles/css/automation.css                                                                  0000644 0001750 0001750 00000001434 13565120054 015153  0                                                                                                    ustar   ron                             ron                                                                                                                                                                                                                    /** Site Wide Styles **/
body {font-family: Arial, Helvetica, sans-serif; background-image: url(../../images/landingbrand.jpg)}
fieldset {color: white; }

/* Fireplace DIV styles */
div.fireplace {background-color: blue; color: white; }

/* Fireplace FORM styles */
form.fireplace {background-color: blue; color: white; }

/* Fireplace TABLE styles */
div.fireplace th td {background-color: blue; }

/* Fireplace Fan DIV styles */
div.fireplacefan {background-color: red; color: white; }

/* Fireplace FORM styles */
form.fireplacefan {background-color: red; color: white; }

/* Fireplace Fan TABLE styles */
div.fireplacefan th td {background-color: red; }

/* Styles for tables used on the main page */
table.roomLayout { table-layout: fixed; width: 100%; background-color: rgb(201, 200, 20); }                                                                                                                                                                                                                                    11192019/switch-graphical.php                                                                       0000644 0001750 0001750 00000015421 13565117667 014131  0                                                                                                    ustar   ron                             ron                                                                                                                                                                                                                    <html>
<link rel="stylesheet" href="styles/css/automation.css">
<head><title>Automation Switches</title>
<script language="Javascript" src="./js/automation.js">
</script>
</head>
<body>
<table class="roomLayout">
	<tr>
		<td>
			<fieldset class="automation">
				<legend>Family Room</legend>
					<form id="frm_familyroom_fp" name="frm_familyroom_fp" action="m_changeSwitchState(0)" method="POST">
						<fieldset>
							<div class="fireplace">
								<legend>Fireplace State</legend>
								<input type="hidden" name="cmdType" id="cmdType" value="test">
								<input type="hidden" name="m_PIN" width="2" id="m_PIN" value="37">
								<input type="hidden" name="sbcNode" id="sbcNode" value="pi-familyroom">
								<!--input type="radio" name="cmdAction" id="fireplace_state" value="ON">ON -->
								<!--<input type="radio" name="cmdAction" id="fireplace_state_off" value="OFF" checked>OFF<br>-->
								<input type="hidden" name="m_pulse_PIN" id="m_pulse_PIN" value="0">
								<input type="hidden" name="m_mon_PIN" id="m_mon_PIN" value="0">
								<input type="hidden" name="m_duty_CYCLE" id="m_duty_CYCLE" value="0">
								<input type="hidden" name="a_graphical_switch" id="a_graphical_switch" value="1">
								<div id="fld_fpstatus" name="fld_fpstatus">
								</div>
								<script>
									var t_buttons = m_checkPinStateFP(document.getElementById('frm_familyroom_fp'), 'fld_fpstatus');
								</script>
								<!--<input type="button" name="btn_submit" value="CHANGE" onclick="fireplaceFanToggle()">-->
								<input type="button" id="btn_family_fp_submit" name="btn_family_fp_submit" value="CHANGE" onclick="m_changeSwitchState(0)">
								<div class="status_update" id="status_div" name="status_div"></div>
							</div>
						</fieldset>
					</form>
					<form id="frm_familyroom_fpf" name="frm_familyroom_fpf" action="m_changeSwitchState(1)" method="POST">
						<fieldset>
							<div class="fireplacefan">
								<legend>Fireplace Fan State</legend>
								<input type="hidden" name="cmdType" id="cmdType" value="toggle">
								<input type="hidden" name="m_PIN" id="m_PIN" width="2"  value="38">
								<input type="hidden" name="sbcNode" id="sbcNode" value="pi-familyroom">
								<!--<input type="radio" name="cmdAction" id="cmdAction" value="ON">ON-->
								<!--<input type="radio" name="cmdAction" id="cmdAction" value="OFF" checked>OFF<br>-->
								<input type="hidden" name="m_pulse_PIN" id="m_pulse_PIN" value="7">
								<input type="hidden" name="m_mon_PIN" id="m_mon_PIN" value="29">
								<input type="hidden" name="m_duty_CYCLE" id="m_duty_CYCLE" value="45">
								<input type="hidden" name="a_graphical_switch" id="a_graphical_switch" value="1">
								<div id="fld_fan_status" name="fld_fan_status"></div>
								<script>
									var t_buttons = m_checkPinStateFP(document.getElementById('frm_familyroom_fpf'), 'fld_fanstatus');
								</script>
								<!--<script>-->
								<!--	m_checkPinStateFP(document.getElementById('frm_familyroom_fpf'));-->
								<!--</script>-->
								<div id="fld_fanstatus" name="fld_fanstatus"></div>
								<!--<input type="button" name="btn_submit" value="CHANGE" onclick="fireplaceFanToggle()">-->
								<input type="button" id="btn_family_fpf_submit" name="btn_family_fpf_submit" value="CHANGE" onclick="m_changeSwitchState(1)">
								<div class="status_update" id="status_div" name="status_div"></div>
							</div>
						</fieldset>
					</form>
			</fieldset>
		</td>
		<td>
			<fieldset class="automation">
				<legend>Master Suite</legend>
					<form id="frm_master_fp" name="frm_master_fp" action="m_changeSwitchState(2)" method="POST">
						<fieldset>
							<div class="fireplace">
								<legend>Fireplace State</legend>
								<input type="hidden" name="cmdType" id="cmdType" value="toggle">
								<input type="hidden" name="m_PIN" width="2" id="m_PIN" value="37">
								<input type="hidden" name="sbcNode" id="sbcNode" value="pipi-mastersuite">
								<!--input type="radio" name="cmdAction" id="fireplace_state" value="ON">ON -->
								<!--<input type="radio" name="cmdAction" id="fireplace_state_off" value="OFF" checked>OFF<br>-->
								<input type="hidden" name="m_pulse_PIN" id="m_pulse_PIN" value="0">
								<input type="hidden" name="m_mon_PIN" id="m_mon_PIN" value="0">
								<input type="hidden" name="m_duty_CYCLE" id="m_duty_CYCLE" value="0">
								<input type="hidden" name="a_graphical_switch" id="a_graphical_switch" value="1">
								<div id="fld_master_fpstatus" name="fld_master_fpstatus"></div>
								<script>
									var t_buttons = m_checkPinStateFP(document.getElementById('frm_master_fp'), 'fld_master_fpstatus');
								</script>
								<!--<script>-->
								<!--	m_checkPinStateFP(document.getElementById('frm_master_fp'));-->
								<!--</script>-->
								<!--<input type="button" name="btn_submit" value="CHANGE" onclick="fireplaceFanToggle()">-->
								<input type="button" id="btn_master_fp_submit" name="btn_master_fp_submit" value="CHANGE" onclick="m_changeSwitchState(2)">
								<div class="status_update" id="status_div" name="status_div"></div>
							</div>
						</fieldset>
					</form>
					<form id="frm_master_fpf" name="frm_master_fpf" action="m_changeSwitchState(3)" method="POST">
						<fieldset>
							<div class="fireplacefan">
								<legend>Fireplace Fan State</legend>
								<input type="hidden" name="cmdType" id="cmdType" value="toggle">
								<input type="hidden" name="m_PIN" id="m_PIN" width="2"  value="38">
								<input type="hidden" name="sbcNode" id="sbcNode" value="pipi-mastersuite">
								<!--<input type="radio" name="cmdAction" id="cmdAction" value="ON">ON-->
								<!--<input type="radio" name="cmdAction" id="cmdAction" value="OFF" checked>OFF<br>-->
								<input type="hidden" name="m_pulse_PIN" id="m_pulse_PIN" value="7">
								<input type="hidden" name="m_mon_PIN" id="m_mon_PIN" value="29">
								<input type="hidden" name="m_duty_CYCLE" id="m_duty_CYCLE" value="45">
								<input type="hidden" name="a_graphical_switch" id="a_graphical_switch" value="1">
								<div id="fld_master_fan_status" name="fld_master_fan_status"></div>
								<script>
									var t_buttons = m_checkPinStateFP(document.getElementById('frm_master_fpf'), 'fld_master_fan_status');
								</script>
								<!--<script>-->
								<!--	m_checkPinStateFP(document.getElementById('frm_mastersuite_fpf'));-->
								<!--</script>-->
								<div id="fld_fanstatus" name="fld_fanstatus"></div>
								<!--<input type="button" name="btn_submit" value="CHANGE" onclick="fireplaceFanToggle()">-->
								<input type="button" id="btn_master_fpf_submit" name="btn_master_fpf_submit" value="CHANGE" onclick="m_changeSwitchState(3)">
								<div class="status_update" id="status_div" name="status_div"></div>
							</div>
						</fieldset>
					</form>
			</fieldset>
		</td>
	</tr>
</table>
</body>
</html>
                                                                                                                                                                                                                                               11192019/switch.php                                                                                 0000644 0001750 0001750 00000015435 13565117667 012206  0                                                                                                    ustar   ron                             ron                                                                                                                                                                                                                    <html>
<link rel="stylesheet" href="styles/css/automation.css">
<head><title>Automation Switches</title>
<script language="Javascript" src="./js/automation.js">
</script>
</head>
<body>
<table class="roomLayout">
	<tr>
		<td>
			<fieldset class="automation">
				<legend>Family Room</legend>
					<form id="frm_familyroom_fp" name="frm_familyroom_fp" action="m_changeSwitchState(0)" method="POST">
						<fieldset>
							<div class="fireplace">
								<legend>Fireplace State</legend>
								<input type="hidden" name="cmdType" id="cmdType" value="test">
								PIN: <input type="text" name="m_PIN" width="2" id="m_PIN" value="37">
								<input type="hidden" name="sbcNode" id="sbcNode" value="pi-familyroom">
								<!--input type="radio" name="cmdAction" id="fireplace_state" value="ON">ON -->
								<!--<input type="radio" name="cmdAction" id="fireplace_state_off" value="OFF" checked>OFF<br>-->
								<input type="hidden" name="m_pulse_PIN" id="m_pulse_PIN" value="0">
								<input type="hidden" name="m_mon_PIN" id="m_mon_PIN" value="0">
								<input type="hidden" name="m_duty_CYCLE" id="m_duty_CYCLE" value="0">
								<input type="hidden" name="a_graphical_switch" id="a_graphical_switch" value="0">
								<div id="fld_fpstatus" name="fld_fpstatus">
								</div>
								<script>
									var t_buttons = m_checkPinStateFP(document.getElementById('frm_familyroom_fp'), 'fld_fpstatus');
								</script>
								<!--<input type="button" name="btn_submit" value="CHANGE" onclick="fireplaceFanToggle()">-->
								<input type="button" id="btn_family_fp_submit" name="btn_family_fp_submit" value="CHANGE" onclick="m_changeSwitchState(0)">
								<div class="status_update" id="status_div" name="status_div"></div>
							</div>
						</fieldset>
					</form>
					<form id="frm_familyroom_fpf" name="frm_familyroom_fpf" action="m_changeSwitchState(1)" method="POST">
						<fieldset>
							<div class="fireplacefan">
								<legend>Fireplace Fan State</legend>
								<input type="hidden" name="cmdType" id="cmdType" value="toggle">
								PIN: <input type="text" name="m_PIN" id="m_PIN" width="2"  value="38">
								<input type="hidden" name="sbcNode" id="sbcNode" value="pi-familyroom">
								<!--<input type="radio" name="cmdAction" id="cmdAction" value="ON">ON-->
								<!--<input type="radio" name="cmdAction" id="cmdAction" value="OFF" checked>OFF<br>-->
								<input type="hidden" name="m_pulse_PIN" id="m_pulse_PIN" value="7">
								<input type="hidden" name="m_mon_PIN" id="m_mon_PIN" value="29">
								<input type="hidden" name="m_duty_CYCLE" id="m_duty_CYCLE" value="45">
								<input type="hidden" name="a_graphical_switch" id="a_graphical_switch" value="0">
								<div id="fld_fan_status" name="fld_fan_status"></div>
								<script>
									var t_buttons = m_checkPinStateFP(document.getElementById('frm_familyroom_fpf'), 'fld_fanstatus');
								</script>
								<!--<script>-->
								<!--	m_checkPinStateFP(document.getElementById('frm_familyroom_fpf'));-->
								<!--</script>-->
								<div id="fld_fanstatus" name="fld_fanstatus"></div>
								<!--<input type="button" name="btn_submit" value="CHANGE" onclick="fireplaceFanToggle()">-->
								<input type="button" id="btn_family_fpf_submit" name="btn_family_fpf_submit" value="CHANGE" onclick="m_changeSwitchState(1)">
								<div class="status_update" id="status_div" name="status_div"></div>
							</div>
						</fieldset>
					</form>
			</fieldset>
		</td>
		<td>
			<fieldset class="automation">
				<legend>Master Suite</legend>
					<form id="frm_master_fp" name="frm_master_fp" action="m_changeSwitchState(2)" method="POST">
						<fieldset>
							<div class="fireplace">
								<legend>Fireplace State</legend>
								<input type="hidden" name="cmdType" id="cmdType" value="toggle">
								PIN: <input type="text" name="m_PIN" width="2" id="m_PIN" value="37">
								<input type="hidden" name="sbcNode" id="sbcNode" value="pipi-mastersuite">
								<!--input type="radio" name="cmdAction" id="fireplace_state" value="ON">ON -->
								<!--<input type="radio" name="cmdAction" id="fireplace_state_off" value="OFF" checked>OFF<br>-->
								<input type="hidden" name="m_pulse_PIN" id="m_pulse_PIN" value="0">
								<input type="hidden" name="m_mon_PIN" id="m_mon_PIN" value="0">
								<input type="hidden" name="m_duty_CYCLE" id="m_duty_CYCLE" value="0">
								<input type="hidden" name="a_graphical_switch" id="a_graphical_switch" value="0">
								<div id="fld_master_fpstatus" name="fld_master_fpstatus"></div>
								<script>
									var t_buttons = m_checkPinStateFP(document.getElementById('frm_master_fp'), 'fld_master_fpstatus');
								</script>
								<!--<script>-->
								<!--	m_checkPinStateFP(document.getElementById('frm_master_fp'));-->
								<!--</script>-->
								<!--<input type="button" name="btn_submit" value="CHANGE" onclick="fireplaceFanToggle()">-->
								<input type="button" id="btn_master_fp_submit" name="btn_master_fp_submit" value="CHANGE" onclick="m_changeSwitchState(2)">
								<div class="status_update" id="status_div" name="status_div"></div>
							</div>
						</fieldset>
					</form>
					<form id="frm_master_fpf" name="frm_master_fpf" action="m_changeSwitchState(3)" method="POST">
						<fieldset>
							<div class="fireplacefan">
								<legend>Fireplace Fan State</legend>
								<input type="hidden" name="cmdType" id="cmdType" value="toggle">
								PIN: <input type="text" name="m_PIN" id="m_PIN" width="2"  value="38">
								<input type="hidden" name="sbcNode" id="sbcNode" value="pipi-mastersuite">
								<!--<input type="radio" name="cmdAction" id="cmdAction" value="ON">ON-->
								<!--<input type="radio" name="cmdAction" id="cmdAction" value="OFF" checked>OFF<br>-->
								<input type="hidden" name="m_pulse_PIN" id="m_pulse_PIN" value="7">
								<input type="hidden" name="m_mon_PIN" id="m_mon_PIN" value="29">
								<input type="hidden" name="m_duty_CYCLE" id="m_duty_CYCLE" value="45">
								<input type="hidden" name="a_graphical_switch" id="a_graphical_switch" value="0">
								<div id="fld_master_fan_status" name="fld_master_fan_status"></div>
								<script>
									var t_buttons = m_checkPinStateFP(document.getElementById('frm_master_fpf'), 'fld_master_fan_status');
								</script>
								<!--<script>-->
								<!--	m_checkPinStateFP(document.getElementById('frm_mastersuite_fpf'));-->
								<!--</script>-->
								<div id="fld_fanstatus" name="fld_fanstatus"></div>
								<!--<input type="button" name="btn_submit" value="CHANGE" onclick="fireplaceFanToggle()">-->
								<input type="button" id="btn_master_fpf_submit" name="btn_master_fpf_submit" value="CHANGE" onclick="m_changeSwitchState(3)">
								<div class="status_update" id="status_div" name="status_div"></div>
							</div>
						</fieldset>
					</form>
			</fieldset>
		</td>
	</tr>
</table>
</body>
</html>
                                                                                                                                                                                                                                   11192019/switch_save.php                                                                            0000644 0001750 0001750 00000002734 13565117667 013222  0                                                                                                    ustar   ron                             ron                                                                                                                                                                                                                    <html>
<head><title>Automation Switches</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script language="Javascript" src="./js/automation.js">
</script>
</head>
<body>
<form action="poster.php" method="POST">
<fieldset>
	<legend>Fireplace State</legend>
	<input type="hidden" name="cmd_function" id="cmd_function" value="toggle">
	PIN: <input type="text" name="fld_PIN" width="2" id="fld_PIN" value="7">
	<input type="radio" name="fireplace_state" id="fireplace_state" value="ON">ON 
	<input type="radio" name="fireplace_state" id="fireplace_state_off" value="OFF" checked>OFF<br>
	<div id="fld_fpstatus" name="fld_fpstatus"></div>
	<!--<input type="button" name="btn_submit" value="CHANGE" onclick="fireplaceFanToggle()">-->
	<input type="submit" name="btn_submit" value="CHANGE">
</fieldset>
</form>
<form action="poster.php" method="POST">
<fieldset>
	<legend>Fireplace Fan State</legend>
	<input type="hidden" name="cmd_fan_function" id="cmd_fan_function" value="toggle">
	PIN: <input type="text" name="fld_fan_PIN" width="2" id="fld_fan_PIN" value="11">
	<input type="radio" name="fan_state" id="fan_state" value="ON">ON
	<input type="radio" name="fan_state" id="fan_state_off" value="OFF" checked>OFF<br>
	<div id="fld_fanstatus" name="fld_fanstatus"></div>
	<!--<input type="button" name="btn_submit" value="CHANGE" onclick="fireplaceFanToggle()">-->
	<input type="submit" name="btn_submit" value="CHANGE">
</fieldset>
</form>
</body>
</html>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    