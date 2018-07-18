<?php

echo password_hash("deloitteAdmin2018", PASSWORD_DEFAULT);
// szif-heslo : $2y$10$i7o/kz4fCSfsnUfLpVhJDuSjSl9PJDa/tNKKhHWcxRxeGkICtk65K
//deloitteAdmin2018 : $2y$10$mqxLWad4xLXEPYx94VOBYurqzPRTJoYbYvOYn7PHp4d5o3s6NzVWi
//phpinfo();
echo '<hr>';
var_dump(password_verify('deloitteAdmin2018','$2y$10$wzx0BwpNeVmCFpOy1Z3E/Ok4YZN5DoVBo7y4gBQFXxvoXJSvFjEB2'));