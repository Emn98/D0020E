/*This script does the check/uncheck logic for the search checkboxes
  on the admin main page*/

function check_policy_name() {
  $("#policy_name_check").prop("checked", true);
  $("#user_check").prop("checked", false);
  $("#object_check").prop("checked", false);
}

function check_user() {
  $("#policy_name_check").prop("checked", false);
  $("#user_check").prop("checked", true);
  $("#object_check").prop("checked", false);
}

function check_object() {
  $("#policy_name_check").prop("checked", false);
  $("#user_check").prop("checked", false);
  $("#object_check").prop("checked", true);
}
