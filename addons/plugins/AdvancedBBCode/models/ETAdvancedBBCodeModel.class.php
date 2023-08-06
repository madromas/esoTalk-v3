<?php
if (!defined("IN_ESOTALK")) exit;
class ETAdvancedBBCodeModel extends ETModel {
    
    const CACHE_KEY = "bbcodes";    
    
    public function __construct()
    {
            parent::__construct("bbcodes");
    }
    
    public function setup()
    {
        $structure = ET::$database->structure();

        if (!$structure ->table($this->table)->exists())
        {  
            $structure
                    ->table($this->table)
                    ->column("bbcode_id", "smallint(4) unsigned", '0')
                    ->column("bbcode_tag", "varchar(16)",'')
                    ->column("bbcode_helpline", "varchar(255)")
                    ->column("display_on_posting", "tinyint(1) UNSIGNED")
                    ->column("bbcode_match", "text")
                    ->column("bbcode_tpl", "mediumtext")
                    ->column("first_pass_match", "mediumtext")
                    ->column("first_pass_replace", "mediumtext")
                    ->column("second_pass_match", "mediumtext")
                    ->column("second_pass_replace", "mediumtext")
                    ->key("bbcode_id", "primary")
                    ->key("display_on_posting")
                    ->exec();
            $this->CreateTag(array(
                            "bbcode_id"=>1,
                            "bbcode_tag"=>"yamusic",
                            "bbcode_helpline"=>"yandex music example [yamusic]574996[/yamusic]",
                            "bbcode_match"=>'[yamusic]{NUMBER}[/yamusic]',
                            "bbcode_tpl"=>'<object width="350" height="48" data="http://music.yandex.ru/embed/{NUMBER}/track.swf"></object>',
                            "second_pass_match"=>'!\\[yamusic\\]([0-9]+)\\[/yamusic\\]!s',
                            "second_pass_replace"=>'<object width="350" height="48" data="http://music.yandex.ru/embed/${1}/track.swf"></object>'
                            ));
            $this->CreateTag(array(
                            "bbcode_id"=>2,
                            "bbcode_tag"=>"pleer",
                            "bbcode_helpline"=>"pleer.com music example [pleer]B60vaaB7e2dtqBhwh[/pleer]",
                            "bbcode_match"=>'[pleer]{SIMPLETEXT}[/pleer]',
                            "bbcode_tpl"=>'<object width="550" height="42" data="http://embed.pleer.com/track?id={SIMPLETEXT}"</object>',
                            "second_pass_match"=>'!\\[pleer\\]([a-zA-Z0-9-+.,_ ]+)\\[/pleer\\]!s',
                            "second_pass_replace"=>'<object width="550" height="42" data="http://embed.pleer.com/track?id=${1}"</object>'
                            ));            
         }
        $structure
                ->table("bbcache")
                ->column("postId", "int(11) unsigned")
                ->column("bbcode_bitfield", "varchar(255)",'')
                ->key("postId", "primary")
                ->exec(1);
        if (!$structure ->table("bbmap")->exists())
        {  
            $structure
                    ->table("bbmap")
                    ->column("bitgroup", "int(1) unsigned")
                    ->column("b_match", "varchar(1)",'')
                    ->column("b_replace", "varchar(1)",'')
                    ->key("bitgroup")
                    ->key("b_match")
                    ->exec();
            $chars=array();
            for($i=ord('A');$i<=ord('Z');$i++)
            {
                $chars[count($chars)] =  chr($i);
            }
            for($i=ord('a');$i<=ord('z');$i++)
            {
                $chars[count($chars)] =  chr($i);
            }
            for($i=ord('0');$i<=ord('9');$i++)
            {
                $chars[count($chars)] =  chr($i);
            }     
            $chars[count($chars)] = '+';            
            $chars[count($chars)] = '/';
            foreach ($chars as $key => $value) {                
                $line = array(
                    "bitgroup" => 2,
                    "b_match" => $value,
                    "b_replace" => $chars[$key & 0x3c]
                );                
                if ($line["b_match"]!=$line["b_replace"])
                    ET::SQL()->insert("bbmap")->set($line)->exec();            

                $line = array(
                    "bitgroup" => 1,
                    "b_match" => $value,
                    "b_replace" => $chars[$key & 0x33]
                );                
               if ($line["b_match"]!=$line["b_replace"])
                    ET::SQL()->insert("bbmap")->set($line)->exec();            
                
                $line = array(
                    "bitgroup" => 0,
                    "b_match" => $value,
                    "b_replace" => $chars[$key & 0x0f]
                );                      
                if ($line["b_match"]!=$line["b_replace"])
                    ET::SQL()->insert("bbmap")->set($line)->exec();            
            }
         }   
    }
    
    public function uninstall()
    {
        $structure = ET::$database->structure();

        // Activity table.
        $structure
                ->table($this->table)
                ->drop();
        $structure
                ->table("bbcache")
                ->drop();        
        $structure
                ->table("bbmap")
                ->drop();                
        return true;    
    }    
    
    public function getBBcodes()
    {        
        $sql = ET::SQL()
                ->select("bbcode_id,bbcode_tag,bbcode_match, bbcode_tpl, bbcode_helpline")
                ->from("bbcodes")
                ->orderBy("bbcode_id")
                ->exec();
        return $sql;
    }

    public function getBBcodesRegexps()
    {        
        $sql = ET::SQL()
                ->select("bbcode_id,bbcode_tag,second_pass_match,second_pass_replace")
                ->from("bbcodes")
                ->orderBy("bbcode_id")
                ->exec();
        return $sql;
    }
    
    public function getBBcodeById($bbcode_Id)
    {        
        $sql = ET::SQL()
                ->select("bbcode_id,bbcode_tag,bbcode_match, bbcode_tpl, bbcode_helpline, second_pass_match")
                ->from("bbcodes")
                ->where("bbcode_id",$bbcode_Id)
                ->exec();
        
        return $sql->nextRow();
    }

    public function deleteBBcodeById($bbcode_Id)
    {        
        ET::SQL()
                ->delete()
                ->from("bbcodes")
                ->where("bbcode_id",$bbcode_Id)
                ->exec();
        
        return true;
    }    
    
    public function getMaxBBcodeId()
    {       
        //fill the gaps
        $sql = ET::SQL()
                ->select("min(b1.bbcode_id) max_bbcode_id")
                ->from("bbcodes b1")
                ->from("bbcodes b2","b2.bbcode_id=(b1.bbcode_id+1)","left")
                ->where("b2.bbcode_id is null")
                ->exec();           
        return $sql->nextRow();
    }
    
    public function getTagExists($bbcode_tag)
    {        
        $sql = ET::SQL()
                ->select("1 test")
                ->from("bbcodes")
                ->where("bbcode_tag",$bbcode_tag)
                ->exec();
        
        return $sql->nextRow();
    }    

    public function CreateTag($values)
    {        
        return parent::create($values);
    }     

    public function UpdateTag($values, $wheres = array())
    {
        return parent::update($values,$wheres);
    }    
    
    public function UpdateBBCache($postId,$bbcode_bitfield)
    {
        if (!$bbcode_bitfield)
        {
            ET::SQL()
                ->delete()
                ->from("bbcache")
                ->where("postId",$postId)
                ->exec();
            return;
        }   
        $sql = ET::SQL()
                ->select("1 test")
                ->from("bbcache")
                ->where("postId",$postId)
                ->exec();        
        $info =  $sql->nextRow();
        if ($info['test'] === '1')
        {
                ET::SQL()->update("bbcache")
                    ->set(array(
                                'bbcode_bitfield'=> $bbcode_bitfield))
                    ->where("postId",$postId)
                    ->exec();            
        }
        else {
            ET::SQL()->insert("bbcache")
                    ->set(array(
                            'bbcode_bitfield'=> $bbcode_bitfield,
                            'postId'=> $postId,
                        ))
                    ->exec();            
        }
    }
    public function ResetBBCache($bbcode_Id)
    {
        $pos=$bitgroup = 0;
        $pos = (int) floor(($bbcode_Id-1) / 3);
        $bitgroup = ($bbcode_Id-1)%3;
        $query = ET::SQL()
                ->update("bbcache bc")
                ->from("bbmap bm")
                ->set("bc.bbcode_bitfield","concat(left(bc.bbcode_bitfield,$pos),bm.b_replace,substring(bc.bbcode_bitfield," . ($pos+2) ."))",0)
                ->where("bm.bitgroup",$bitgroup)
                ->where("ord(bm.b_match)=ord(substring(bc.bbcode_bitfield," . ($pos+1) . ",1))")
                ->exec();
    }    
    
    public function GetBitfield($postId)
    {        
        $sql = ET::SQL()
                ->select("bbcode_bitfield")
                ->from("bbcache")
                ->where("postId",$postId)
                ->exec();
        
        return $sql->nextRow();
    }  
    
}
?>
