<?php

require_once('../../config.php');
require_login();

$PAGE->set_context(context_system::instance());
$PAGE->set_title('Registration');
$PAGE->set_heading('Registration');

$form = new custom_registration_form();

if ($form->is_cancelled()) {
    redirect(new moodle_url('/'));
} else if ($data = $form->get_data()) {
   // Process the form data and register the user
   $user = new stdClass();
   $user->username = $data->username;
   $user->password = random_password(); // Generate a random password
   $user->email = $data->username; // Set the email as the username
   $user->firstname = $data->name;
   $user->lastname = $data->surname;

   $user_id = user_create_user($user); // Register the user

   if ($user_id) {
   // Force password change for the user
    $user = $DB->get_record('user', ['id' => $user_id], '*', MUST_EXIST);
    $user->passwordforcechange = true;
    $DB->update_record('user', $user);

    // Send the password via email
    $emailsubject = 'Your Account Information';
    $emailbody = 'Your username: ' . $user->username . '<br>';
    $emailbody .= 'Your password: ' . $user->password . '<br>';
    $emailbody .= 'Please login using the above credentials.';

    $email = new \core\email\message();
    $email->set_subject($emailsubject);
    $email->set_body($emailbody);
    $email->set_recipient($user->email);
    $email->send();

    redirect(new moodle_url('/'));
  } else {
    echo $OUTPUT->header();
    echo 'Failed to register user.';
    echo $OUTPUT->footer();
  } 


} else {
    echo $OUTPUT->header();
    $form->display();
    echo $OUTPUT->footer();
}