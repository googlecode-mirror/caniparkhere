<?php
require_once("./_logic.php");
$passes = GetPassTypes("name");
?>

<script type="text/javascript">
function check_form(form) {
	if(form.fname.value == '') {
		alert('First name cannot be blank.');
		return false;
	}
	else if(form.lname.value == '') {
		alert('Last name cannot be blank.');
		return false;
	}
	else if(form.email.value == '') {
		alert('E-mail cannot be blank.');
		return false;
	}
	else if(form.pass1.value == '') {
		alert('Password cannot be blank.');
		return false;
	}
	else if(form.pass2.value != form.pass1.value) {
		alert('Passwords do not match.');
		return false;
	}
	return true;
}
</script>

<div id="accordion">
	<h1><a href="#">New User</a></h1>
	<div>
		<form name="register" id="register" method="POST" action="?page=register-exec" onSubmit="return check_form(this)">
			<label for="fname">First Name</label>
			<input id="fname" name="fname" type="text"/><br/>

			<label for="lname">Last Name</label>
			<input id="lname" name="lname" type="text"/><br/>

			<label for="email">E-Mail</label>
			<input id="email" name="email" type="text"/><br/>

			<label for="pass1">Password</label>
			<input id="pass1" name="pass1" type="password"/><br/>

			<label for="pass2">Confirm</label>
			<input id="pass2" name="pass2" type="password"/><br/>

			<label for="passtype">Pass Type</label>
			<select id="passtype" name="passtype">
				<optgroup label="Pass Type">
					<?php
					if(is_array($passes))
						foreach($passes as $pass) {
							echo "<option value=\"".$pass["id"]."\">".$pass["name"]."</option>\n";
						}
					?>
				</optgroup>
			</select><br/>
			<input type="submit" value="Register" /><br/>
			<small>All fields required.</small>
		</form>
	</div>
</div>
