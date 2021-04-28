<?php
trait LenguageB{
	function LngRad($leng)
	{
    	if ($this->ot_getinside($leng,'Lenguages.tas','main')){
    		$this->lengR = $leng;
       	} 
    	else 
    	{
    		$this->lengR = 'none';
		}			
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}

	function LngRadMsr($leng)
	{
		if ($this->ot_connect(FALSE)) {
	    	if ($this->ot_getinside($leng,'Lenguages.tas','main')){
	    		$this->lengR = $leng;
	       	} 
	    	else 
	    	{
	    		$this->lengR = 'none';
			}			
			$this->ot_addchangein('lr',$this->lengR,'admin.json','usr/'.$this->id);
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}
	function LngWrtMsr($leng)
	{
		if ($this->ot_connect(FALSE)) {
	    	if ($this->ot_getinside($leng,'Lenguages.tas','main')){
	    		$this->lengW = $leng;
	       	} 
	    	else 
	    	{
	    		$this->lengW = 'none';
			}			
			$this->ot_addchangein('lr',$this->lengR,'admin.json','usr/'.$this->id);
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}
}
