<?php
/**
 *

 *
 */
class Get
{

    private $base_url='http://music.163.com/';
    public $topListIds = ["new"=>3779629,"hot"=>3778678,"el"=>3812895];


    /**
     *
     * @parm id - is 163 music list id
     *
     * @return all music object in this list
     *
     */

    public function getList($id){
        $url = $this->base_url."/playlist?id=".$id;
        $dom = new DOMDocument();
        $dom->loadHTML($this->getCache($url));
        $xpath = new DOMXPath($dom);
        $as = $xpath->query('//textarea');
        return array_slice(json_decode($as[0]->nodeValue), 0, 20);
    }

    private function getCache($url){
        require_once 'cache.class.php';
        $c = new Cache();
        $key = base64_encode($url);
        if($c->isCached($key)){
            $content = $c->retrieve($key);
        }else{
            $content = file_get_contents($url);
            $c->store($key, $content);
        }
        return $content;
    }

    public function getSong($age,$smile){
        if($age<12){
            if($smile<2){
                return 108896108;
            }else if($smile>=2 && $smile < 60){
                return 97451000;
            }else{
                return 108118234;
            }
        }else if($age<=30 && $age>=12){
            if($smile<2){
                return 110516885;
            }else if($smile>=2 && $smile < 60){
                return 123426505;
            }else{
                return 122260748;
            }
        }else if($age > 30){
            if($smile<2){
                return 113529799;
            }else if($smile>=2 && $smile<60){
                return 113243339;
            }else{
                return 108662571;
            }
        }
    }

}