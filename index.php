<html>
<head>
	<script language="Javascript" src="js/calm-int.js"></script>
	<link rel="stylesheet" src="">
	<title></title>
</head>
<body>
	<form id="app_form" name="app_form" action="POST" method="">
		<table id="tbl_one" name="tbl_one">
			<tr><th></th><th></th></tr>
			<tr><td>Application Name:</td><td><input id="app_name" name="app_name" type="text" width="55"></td></tr>
			<tr><td>Application Description:</td><td><input id="app_description" name="app_description" type="text" width="255" height="15"></td></tr>
			<tr><td><input id="btn_clear" name="btn_clear" type="button" value="CLEAR"></td><td><input id="btn_submit" name="btn_submit" type="button" onclick="m_launchApplication(0)" value="SUBMIT"></tr>
			<tr><td><div id="infoPanel" name="infoPanel"></div></td></tr>
		</table>
		<input id="app_blueprint_uuid" name="app_blueprint_uuid" type="hidden" value="">
		<input id="app_blueprint_name" name="app_blueprint_name" type="hidden" value="">
		<input id="app_blueprint_profile" name="app_blueprint_profile" type="hidden" value="app_profile">
		<input id="hostIP" name="hostIP" type="hidden" value="app_profile">
		<input id="hostPort" name="hostPort" type="hidden" value="app_profile">
		<input id="hostEndPoint" name="hostEndPoint" type="hidden" value="app_profile">
		<input id="t_app_profile_name" name="t_app_profile_name" type="hidden" value="app_profile">
	</form>
</body>
</html>
