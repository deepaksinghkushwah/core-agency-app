<?php
namespace classes;
class Flash {

    /**
     * Add flash to session
     * $msg can be any string
     * $category can be alert message type like success, danger, info, warning
     * @param string $msg
     * @param string $category
     */
    public static function addFlash($msg, $category) {
        $_SESSION['msg'][$category][] = $msg;
    }
    
    public static function showFlash(){
        foreach($_SESSION['msg'] as $cat => $msg){
            foreach($msg as $msg){
                echo "<div class='alert alert-".$cat."' alert-dismissible fade show>".$msg
                        ,'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>'
                        ."</div>";
            }
        }
        unset($_SESSION['msg']);
    }

}
