<?php 

class Flasher {

    public static function setFlash($success, $message){
        $_SESSION['flash'] = [
            'message' => $message,
            'success' => $success
        ];
    }

    public static function flash(){
        if (isset($_SESSION['flash'])){
            $msg = $_SESSION['flash']['message'];
            $success = $_SESSION['flash']['success'];

            $class = "notification ";
            if ($success){
                $class .= 'green';
            }
            else{
                $class .= 'red';
            }

            $html = '<div class="' .$class. '" id="notification">
            <div id="close-button" onclick="closeNotification()">x</div>
            <p id="message">' . $msg . '</p>
        </div>';


            // TODO: Change flasher
            echo $html;

            unset($_SESSION['flash']);
        }
    }

}