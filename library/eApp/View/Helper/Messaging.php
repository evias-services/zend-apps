<?php

class eApp_View_Helper_Messaging
    extends Zend_View_Helper_Abstract
{
    /**
     * View helper for displaying common messages
     * such as information messages or error 
     * messages. 
     * Messages are displayed in a <div> container
     * class'd "msg" or "error".
     *
     * @param $messages array information messages
     * @param $errors array error messages
     *
     * @return string
     */
    public function messaging($messages = array(), $errors = array(), $warnings = array())
    {
        $html = "";

        if (! empty($errors))
            $html .= $this->getContainer($errors, "error");

        if (! empty($warnings))
            $html .= $this->getContainer($warnings, "warning");

        if (! empty($messages))
            $html .= $this->getContainer($messages, "info");

        return $html;
    }

    protected function getContainer($lines, $class = "warning")
    {
        $bg  = "#9ae3a4";
        $col = "#40834a";

        if ($class == "error") 
            list($bg, $col) = array("#ef9d9d", "#c93e3e");
        elseif ($class == "warning")
            list($bg, $col) = array("#e6cd6a", "#eea43b");

        switch ($class) {
            default:
            case 'info':
                $position = "-96px 0px";
                break;
            case 'error':
                $position = "0px -32px";
                break;
            case 'warning':
                $position = "-32px -32px";
                break;
        }

        $icon  = "<div style='height: 32px; width: 32px; float: left;'></div>";
        $attr  = " style='border: 1px solid {$col}; border-radius: 5px; background: {$bg}; width: 80%;margin-left:100px; height: 32px;' class='msg'";
        $sattr = " style='font-size: 13pt; line-height: 32px; float:left; margin-left: 5px;'";
        $html = 1 == count($lines) && is_string($lines[0]) ? "<h3 '" . $attr . ">" . $icon . "<div" . $sattr . ">{$lines[0]}</div><div class='clear'></div></h3>" : $lines;
        if (is_array($html)) {
            $html = "";
            foreach ($lines as $mod => $msg) :
                if (empty($msg))
                    continue;

                if (!is_array($msg)) 
                    $msg = array($msg);
                $html .= "<h3{$attr} style='width:50%;' class='msg {$class}'>" . $icon . "<div{$sattr}>" . implode("</div><div class='clear'></div></h3><h3{$attr} class='{$class}'>{$icon}<div{$sattr}>", $msg) . "</div><div class='clear'></div></h3>";
            endforeach;
        }       

        return $html;
    }
}