<?php
function get_connection() {
    return new mysqli("localhost", "facts", "facts", "facts"); // change that
}
function make_facebook() {
    return new Facebook(
        'appId' => '117743971608120', // change these
        'secret' => '943716006e74d9b9283d4d5d8ab93204',
        'cookie' => true,
    ));
?>
