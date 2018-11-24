<?php
    // odhlaseni uzivatele
    if(isset($_POST["logout"])){
        $this->db->userLogout();
    }
?>