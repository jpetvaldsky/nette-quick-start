<?php

$newPass = password_hash("szif-heslo", PASSWORD_DEFAULT);
// szif-heslo : $2y$10$i7o/kz4fCSfsnUfLpVhJDuSjSl9PJDa/tNKKhHWcxRxeGkICtk65K
//deloitteAdmin2018 : $2y$10$mqxLWad4xLXEPYx94VOBYurqzPRTJoYbYvOYn7PHp4d5o3s6NzVWi
//phpinfo();
echo '<hr>';
var_dump(password_verify('szif-heslo',$newPass));