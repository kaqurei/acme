<?php
$storedHash = '$2y$12$8NfU8ujIF914LNyM7s9z0eq3KJHxUHwjb/dfoDpEb2Rj8eegjResO';

if(password_verify('kitty', $storedHash)) {
    echo "Login Successful";
} else {
    echo "Login Failed";
}