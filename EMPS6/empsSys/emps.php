<?php
class empsSys { 

    public function run() {
        echo "Online!";
    }

    public function json_response($data) {
        header("Content-Type: application/json");
        echo json_encode($data);
    }
}
?>
