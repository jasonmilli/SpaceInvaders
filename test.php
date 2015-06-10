<?php
    echo "ttest";
    /*readline_callback_handler_install('', function() {
        echo "test";
        while(true) {
            echo "t";
            $r = array(STDIN);
            $w = null;
            $e = null;
            $n = stream_select($r, $w, $e, 2);
            if ($n && in_array(STDIN, $r)) {
                $c = stream_get_contents(STDIN, 1);
                echo "Char read: $c\n";
                break;
            }
        }
    });
    /*$fp=fopen("php://stdin", "r");
    $in=fgets($fp,4094);
    echo $in;
    fclose($fp);
    
    $line = readline("Command: ");
    echo $line;*/
    
    
    /*$tty = fOpen("\con", "rb");*/