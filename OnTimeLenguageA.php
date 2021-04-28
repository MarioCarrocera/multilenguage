<?php
trait LenguageA{
	function LngRadSys($leng)
	{
		if ($this->ot_can('change','main')) {
	    	if ($this->ot_getinside($leng,'Lenguages.tas','main')){
	    		$this->lengR = $leng;
	       	} 
	    	else 
	    	{
	    		$this->lengR = 'none';
			}			
			$this->ot_addchangein('lr',$this->lengR,'admin.json','main');
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}
	function LngWrtSys($leng)
	{
		if ($this->ot_can('change','main')) {
	    	if ($this->ot_getinside($leng,'Lenguages.tas','main')){
	    		$this->lengW = $leng;
	       	} 
	    	else 
	    	{
	    		$this->lengW = 'none';
			}			
			$this->ot_addchangein('lw',$this->lengW,'admin.json','main');
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}
	function LngDflSys($leng)
	{
		if ($this->ot_can('change','main')) {
	    	if ($this->ot_getinside($leng,'Lenguages.tas','main')){
	    		$this->lengD = $leng;
	       	} 
	    	else 
	    	{
	    		$this->lengD = 'none';
			}			
			$this->ot_addchangein('ld',$this->lengD,'admin.json','main');
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}
	function LngFllSys($var='yes')
	{
		if ($this->ot_can('change','main')) {
	    	if ($var='yes'){
	    		$this->lengF = 'yes';
	       	} 
	    	else 
	    	{
	    		$this->lengF = 'no';
			}			
			$this->ot_addchangein('lf',$this->lengF,'admin.json','main');
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}
	function LngRadUsr($leng,$usr)
	{
		if ($this->ot_can('change','main')) {
			if ($this->ot_exist($usr,'usr')) {
		    	if ($this->ot_getinside($leng,'Lenguages.tas','main')){
		    		$this->lengR = $leng;
	    	   	} 
	    		else 
	    		{
	    			$this->lengR = 'none';
				}			
				$this->ot_addchangein('lr',$this->lengR,'admin.json','usr/'.$usr);
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}
	function LngWrtUsr($leng,$usr)
	{
		if ($this->ot_can('change','main')) {
			if ($this->ot_exist($usr,'usr')) {
		    	if ($this->ot_getinside($leng,'Lenguages.tas','main')){
		    		$this->lengW = $leng;
	    	   	} 
	    		else 
	    		{
	    			$this->lengW = 'none';
				}			
				$this->ot_addchangein('lw',$this->lengW,'admin.json','usr/'.$usr);
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}
	
	
	
}
