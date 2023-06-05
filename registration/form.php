<?php

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/formslib.php');

class custom_registration_form extends moodleform {

    public function definition() {
        $mform = $this->_form;

        $mform->addElement('text', 'username', 'Username (Email)');
        $mform->setType('username', PARAM_RAW);
        $mform->addRule('username', 'Please enter a valid email address', 'email');
        $mform->setDefault('username', '');

        $mform->addElement('text', 'name', 'Name');
        $mform->setType('name', PARAM_TEXT);

        $mform->addElement('text', 'surname', 'Surname');
        $mform->setType('surname', PARAM_TEXT);

        $mform->addElement('text', 'country', 'Country');
        $mform->setType('country', PARAM_TEXT);

        // Mobile number field
        $mform->addElement('text', 'phone', 'Mobile');
        $mform->setType('phone', PARAM_TEXT);
        $mform->addRule('phone', 'Please enter a valid mobile number', 'regex', '/^\+\d{1,3}\d{9}$/');
        $mform->setDefault('phone', '+');

        $this->add_action_buttons(true, 'Register');
    }

    public function validation($data, $files) {
        $errors = array();

        // Validate form fields
        
       // Validate username (email) field
       if (empty($data['username'])) {
        $errors['username'] = 'Please enter a valid email address';
        }
        
        if (empty($data['name'])) {
            $errors['name'] = 'Please enter a first name';
        }

        if (empty($data['surname'])) {
            $errors['surname'] = 'Please enter a last name';
        }

        if (empty($data['country'])) {
            $errors['country'] = 'Please enter country data';
        }

          // Validate mobile number field
          if (empty($data['phone'])) {
            $errors['phone'] = 'Please enter a mobile number';
        }

        return $errors;
    }
}