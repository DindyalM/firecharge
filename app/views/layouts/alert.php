<?php
// EFFECTS:  renders an alert onto the page if given
// REQUIRES: "flash" must be set, "flash-type" determines the style, if not specified in session
//           defaults to primary
//           On pages with a form this function is called on each request which ends up deleting the
//           flash session variable, use AJAX for pages with form
function alert() {
    $message = @$_SESSION['message'];
    $message_type = @$_SESSION['message-type'];
    
    $close_js = '';
    $btn = '';
    
    if(isset($message)) {
        $close_js = '
            <script>
                var btn = document.getElementById("alert-close");
                btn.addEventListener("click", function(event) {
                    var trget = event.target.parentNode.parentNode;
                    trget.innerHTML = "";
                    trget.className = "";
                });
            </script>
        ';
        $btn = '<button type="button" id="alert-close" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>';
    }
    
    unset($_SESSION['message']);
    unset($_SESSION['message-type']);
    
    $alert = '<div id="alert" class="mb-0 alert alert-' . $message_type . '">'
                        . $message . $btn .'
                    </div>' . $close_js;
    
    return $alert;
}
?>