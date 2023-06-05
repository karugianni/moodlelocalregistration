# moodlelocalregistration
A simple test of a local plugin in moodle to test api functionality

The whole development of the plugin consists of three files:

1) version.php (necessary file for a plugin in moodle)

There are 2 lines of code, specifically the $plugin->version and the $plugin->requires which i needed in order for it to work, as suggested by the moodle documentation.

2) form.php

In this file I took advantage of the forms API, created a class to extend the functionality of the moodleforms, by creating my own form. There are two functions in there, the definition of the custom form, where all the fields of the form are defined, and a simple validation function, which validates the data, before submission.

3) register.php

This is a custom page, where the form is rendered, and the submission is handled. After the guest user submits the form successfully, a new registered user is created in the database, and an email is sent to the newly registered user, with his username, and a temporary password, which the user is forced to change after the first login (the password change is forced in lines 27,28,29). 

To be entirely honest, I searched for this specific piece of code for a while.
