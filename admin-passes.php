<?php
# Create/delete pass types.

require("./auth.php");
require_once("./_logic.php");

echo "<div class=\"ui-widget\">\n";
switch($_POST["action"]) {
	case "create":
		$passID = @UpdatePassType($_POST["update_id"], $_POST["pass_name"]);

		if($passID > 0 && $_POST["update_id"] == 0) {
			printf("%sCreated Pass: <strong>%s</strong>\n\t</div>\n", $ui_info, $_POST["pass_name"]);
		} elseif($passID > 0 && $_POST["update_id"] != 0) {
			printf("%sRenamed Pass: <strong>%s</strong> to <strong>%s</strong>\n\t</div>\n", $ui_info, $_POST["update_id"], $_POST["pass_name"]);
		} elseif($passID == 0 && $_POST["update_id"] != 0) {
			printf("%sFailed to rename pass: <strong>%s</strong> to <strong>%s</strong>\n\t</div>\n", $ui_alert, $_POST["update_id"], $_POST["pass_name"]);
		} else {
			printf("%sFailed to create pass: <strong>%s</strong>\n\t</div>\n", $ui_alert, $_POST["pass_name"]);
		}
		break;
	case "delete":
		$result = @DeletePassTypes($_POST["delete_passes"]);

		if($result) {
			printf("%sDeleted Passes: <strong>%d</strong>\n\t</div>\n", $ui_info, count($_POST["delete_passes"]));
		} else {
			printf("%sFailed to delete passes: <strong>%d</strong>\n\t</div>\n", $ui_alert, count($_POST["delete_passes"]));
		}
		break;
	default:
		break;
}
echo "</div>\n";

$passes = GetPassTypes("name");
?>

<script type="text/javascript" src="http://dev.jquery.com/view/trunk/plugins/validate/jquery.validate.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("#update_form").validate();
		$("#delete_form").validate();

		$("#update_id").bind("change keypress", function() {
			if($("#update_id").val() == 0) $("#update_form :submit").val("Create Pass");
			else $("#update_form :submit").val("Rename Pass");
		});
	});
</script>

<div id="tabs">
	<ul>
		<li><a href="#update_tab">Update Pass Type</a></li>
		<li><a href="#delete_tab">Delete Pass Type</a></li>
	</ul>

	<div id="update_tab">
		<form id="update_form" name="update" method="POST" action="">
			<label for="update_id">Current Pass</label>
			<select id="update_id" name="update_id">
				<optgroup label="New Pass">
					<option value="0">Create New Pass</option>
				</optgroup>
				<optgroup label="Existing Passes">
				<?php
				if(is_array($passes))
					foreach($passes as $pass) {
						echo "<option value=\"".$pass["id"]."\">".$pass["name"]."</option>\n";
					}
				?>
				</optgroup>
			</select>
			<br/>
			<label for="pass_name">Pass Name</label>
			<input id="pass_name" name="pass_name" type="text" class="required" minlength="1"/>
			<input type="hidden" name="action" value="update"/>
			<br/>
			<input id="create_submit" type="submit" value="Create Pass"/>
		</form>
		<?php echo $ui_help_create; ?>
		<div id="create_help_dialog" title="Update Pass Help">
			<h3>Create New Pass</h3>
			<ol>
				<li>Select <strong>Create New Pass</strong>.</li>
				<li>Enter the name of the <strong>Pass Type</strong> to create.</li>
			</ol>

			<h3>Rename Pass</h3>
			<ol>
				<li>Select an <strong>Existing Pass</strong> to rename.</li>
				<li>Enter the new name of the <strong>Pass Type</strong>.</li>
			</ol>

			<p>Note that renaming a <strong>Pass Type</strong> will not affect the <strong>Rules</strong> or <strong>Exceptions</strong> associated with it.</p>
		</div>
	</div>

	<div id="delete_tab">
		<form id="delete_form" name="delete" method="POST" action="">
			<select id="delete_passes" name="delete_passes[]" multiple="multiple" size="15">
				<optgroup label="Passes">
				<?php
				if(is_array($passes))
					foreach($passes as $pass) {
						echo "<option value=\"".$pass["id"]."\">".$pass["name"]."</option>\n";
					}
				?>
				</optgroup>
			</select>
			<input type="hidden" name="action" value="delete"/>
			<p><input type="submit" value="Delete Passes"/></p>
		</form>
		<?php echo $ui_help_delete; ?>
		<div id="delete_help_dialog" title="Delete Pass Help">
			<p>Select all <strong>Passes</strong> to delete.</p>
			<p>Hold <em>Shift</em> to make continuous selections.</p>
			<p>Hold <em>Ctrl</em> to make discontinuous selections.</p>
		</div>
	</div>
</div>
