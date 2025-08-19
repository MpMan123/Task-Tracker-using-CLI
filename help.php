<?php
    const STT_WIDTH = 3;
    const DES_WIDTH = 50;
    const STATUS_WIDTH = 10;

    function repeatChar($c, $num) {
        $result = "";
        for($i = 0; $i < $num; ++$i) {
            $result .= $c;
        }
        return $result;
    }
    function printCenter($content, $width) {
        $content_width = is_numeric($content) ? strlen((string)$content): strlen($content);
        
        $result = "";
        if ($content_width > $width) {
            $result .= substr($content, 0, $width - 3) . "...";
        }
        else {
            $padding = intval(($width - $content_width) / 2);
            $result .= repeatChar(' ', $padding);
            $result .= $content;
            $result .= repeatChar(' ', $width - $content_width - $padding);
        }
        return $result;
    }
    function displayData($id, $description, $status) {
        echo "|" . printCenter($id, STT_WIDTH) . "|" . printCenter($description, DES_WIDTH) . "|" . printCenter($status, STATUS_WIDTH) . "|\n";
    }
    function displayLine() {
        echo  "+" . repeatChar('-', STT_WIDTH) . "+" . repeatChar("-",DES_WIDTH) . "+" . repeatChar('-',STATUS_WIDTH) . "+\n";
    }
    function displayCell($id, $description, $status) {
        displayData($id, $description, $status);
        displayLine();
    }
?>