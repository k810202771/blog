<?php
class Funcp {
    public function is_Power($Route=''){
        $Route = (substr($Route,0,strlen($Route)-1) == "/"?$Route:$Route.'/');
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