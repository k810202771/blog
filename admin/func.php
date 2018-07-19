<?php
class Funcp {
    public function is_Power($Route=''){
        $filename = time().''.rand(10000,99999).'.txt';
        $myfile = @fopen($Route.$filename, "w");
        @fwrite($myfile, $filename);
        @fclose($myfile);
        $myfile = @fopen($Route.$filename, "r");
        $text = @fread($myfile,filesize($Route.$filename));
        @fclose($myfile);
        @unlink($Route.$filename);
        return $filename === $text;
    }
}
?>