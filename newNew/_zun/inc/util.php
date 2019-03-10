<?php
class Util {
    function __construct($db) {
        $this->db = $db;
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    function createActiveSesh($user) {
        $sesh = $this->generateRandomString();
        $unique = FALSE;
        while(!$unique) {
            $stmt = $this->db->prepare("SELECT * FROM active WHERE seshId = ?");
            $stmt->execute([$sesh]);
            if($stmt->rowCount() > 0) {
                $sesh = $this->generateRandomString();
            } else {
                $unique = TRUE;
            }
        }
        session_start();
        $_SESSION['sid'] = $sesh;
        $_SESSION['lastActivity'] = time();
        $this->db->prepare("INSERT INTO active (uname, seshId) VALUES (?, ?)")->execute([$user, $sesh]);
    }

    function isSeshActive() {
        session_start();
        if(isset($_SESSION['sid'])) {
            if($_SESSION['lastActivity'] > time()-(3*60*60)) {
                $stmt = $this->db->prepare("SELECT * FROM active WHERE seshId = ?");
                $stmt->execute([$_SESSION['sid']]);
                if($stmt->rowCount() > 0) {
                    return TRUE;
                }
            } else {
                $this->removeSesh();
            } 
        }
        return FALSE;
    }

    function removeSesh() {
        $this->db->prepare("DELETE FROM active WHERE seshId = ?")->execute([$_SESSION['sid']]);
    }
}