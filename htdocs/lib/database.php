<?php
class database
{
	var $db;
	var $quary;
	function database()
	{
	$this->db=mysql_connect("localhost","uiclubne_prod");
	mysql_select_db("pic", $this->db);
	mysql_query("SET NAMES 'UTF8'"); 
	
	}
	function fetch($sql)
	{
	
	 $this->query=mysql_unbuffered_query($sql,$this->db);
	}
	function fetch2($sql)
	{
	
	 $this->query=mysql_query($sql,$this->db);
	}
	 function getRow () {
	
        if ( $row=mysql_fetch_array($this->query,MYSQL_ASSOC) )
	{	
		
            return $row;
        }else
	{
		
            return false;}
    }
}
?>
