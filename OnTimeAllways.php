<?php
trait Allways{
	
	private $actses='000000';	
	public  $errvalid = array();
	public  $dataresult = array();
	private $datareview = array();
	private $dataindex = array();
	private $retarr = array();
	private $tstring = ' SKkRil';
	private $force = FALSE;
	private $info = array();
	private $Systimezone='UTC';
	private $Usrtimezone='UTC';
	private $Systimeformat = 'YmdHisP';
	private $Usrtimeformat = 'YmdHisP';
	private $TimeStamp = 'YmdHisP';	
	private $path = 'none';
	private $lengR = 'en';
	private $lengW = 'en';
	private $lengD = 'en';
	private $lengF = 'yes';
	

function __construct($container='../ontime',$user='none',$pass='pass'){
	$this->conected=FALSE;
	$this->container=$container;
	$this->features=$this->ot_readif('features.json');
	$this->content=$this->ot_readif('content.json');
	$this->errtext=$this->ot_readif('err.bas','main');
	$this->level=$this->ot_readif('level.bas','main');
	$this->status=$this->ot_readif('status.bas','main');
   	if ($this->ot_getinside('tz','admin.json','main')){
    	$this->Systimezone=$this->retval;} 
   	if ($this->ot_getinside('ft','admin.json','main')){
   		$this->Systimeformat=$this->retval;} 
   	if ($this->ot_getinside('lr','admin.json','main')){
   		$this->lengR = $this->retval;} 
   	if ($this->ot_getinside('lw','admin.json','main')){
   		$this->lengW = $this->retval;} 
   	if ($this->ot_getinside('ld','admin.json','main')){
    		$this->lengD = $this->retval;} 
   	if ($this->ot_getinside('lf','admin.json','main')){
    	$this->lengF = 'none';} 
	if ($user!='none'){
		$this->Connect($user, $pass);}			

	$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->errvalid  );
    return $this->conected;
}	
function Connect($User, $Password){
			if ($this->ot_connect(FALSE)) {
				if ($this->ot_exist($User,'usr')) {
					$atmp=$this->ot_read('admin.json','usr/'.$User);
					if ($this->ot_value($atmp['password'],MD5($Password),"C0010M012")) {
						if ($this->ot_value($atmp['status'],'active',"C0010M022")) {
							$this->conected=TRUE;
							$this->id=$User;
							$this->ot_addchangein($this->id, $this->Now(), 'online.json');
							$this->nick=$atmp['nick'];
							$this->name=$atmp['name'];
							if ($this->ot_getinside('lr','admin.json','usr/'.$User)){
					    		$this->lengR = $this->retval;} 
					    	if ($this->ot_getinside('lw','admin.json','usr/'.$User)){
    							$this->lengW = $this->retval;} 
							if (!array_key_exists('grp', $this->features)) {
								$this->safety=$this->ot_readif('features.json','usr/'.$User);
							} else {
								$this->groups = $this->ot_readif('groups.json','usr/'.$User);
								$this->safety = $this->MySafety();	
							}
							if (array_key_exists('date', $this->features)) {
						        if ($this->ot_getinside('tz','admin.json','usr/'.$User)){
						        	$this->Usrtimezone=$this->retval;
								} else {
									$this->Usrtimezone=$this->Systimezone; 
								}
						        if ($this->ot_getinside('ft','admin.json','usr/'.$User)){
						        	$this->Usrtimeformat=$this->retval;
								} else {
									$this->Usrtimeformat=$this->Systimeformat; 
								}
								
							}
						}
					}
				}
			}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->conected;
	}	
	function DiscConnect(){
		if ($this->ot_connect()) {
			$this->conected=FALSE;
			$this->ot_deletein($this->id, 'online.json');
			$this->nick='';
			$this->name='';
			$this->user=[];
			$this->userp=[];
			$this->safety=[];
			$this->id='Anonimus';
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return !$this->conected;
	}	
	function UsrDlt($User){
		if ($this->ot_can('remove','usr')) {
			if ($this->not_value($User,'admin',"C0010M035")) {
				if ($this->ot_exist($User,'usr')) {
					$this->ot_deletein($User, 'users.json');
					$atmp=$this->ot_readif('features.json','usr/'.$User);
					foreach ($atmp as $iKey=> $iValue) {
						$this->ot_deletein($User, 'users.json',$iKey);
					}
					$atmp=$this->ot_readif('groups.json','usr/'.$User);
					foreach ($atmp as $iKey=> $iValue) {
						$this->ot_deletein($User, 'users.json','grp/'.$iKey);
					}
					$this->ot_remove($User, 'usr');
				}
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval;
	}	
	function DltGrp($group){
		if ($this->ot_connect()) {
			if ($this->ot_can('remove','grp')) {
				if ($this->ot_exist($group, 'grp')) {
					$this->ot_deletein($group, 'groups.json');
					$atmp=$this->ot_readif('features.json','grp/'.$group);
					foreach ($atmp as $iKey=> $iValue) {
						$this->ot_deletein($group, 'groups.json',$iKey);
					}
					$atmp=$this->ot_readif('users.json','grp/'.$group);
					foreach ($atmp as $iKey=> $iValue) {
						$this->ot_deletein($group, 'groups.json','usr/'.$iKey);
					}
					$this->ot_remove($group, 'grp');
				}
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $this->retval );
		return $this->retval ;
	}
	function MySafety(){
		$retval=[];
		$tmp = $this->ot_readif('groups.json','usr/'.$this->id);
		foreach ($tmp as $iKey=> $iValue) {
			$tmp2 = $this->ot_readif('features.json','grp/'.$iKey);
			foreach ($tmp2 as $jKey=> $jValue) {
				if (array_key_exists($jKey, $retval)) {
					if ($this->level[$retval[$jKey]]>$this->level[$jValue]) {
						$retval[$jKey]=$jValue;
					}
				} else {
					$retval[$jKey]=$jValue;
				}
			}
		}
		$tmp = $this->ot_readif('features.json','usr/'.$this->id);
		foreach ($tmp as $jKey=> $jValue) {
			$retval[$jKey]=$jValue;
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $retval );
		return $retval;
	}	
	function Safety($user){
		if ($this->ot_exist($user,'usr')) {
			$retval=[];
			$tmp = $this->ot_readif('groups.json','usr/'.$user);
			foreach ($tmp as $iKey=> $iValue) {
				$tmp2 = $this->ot_readif('features.json','grp/'.$iKey);
				foreach ($tmp2 as $jKey=> $jValue) {
					if (array_key_exists($jKey, $retval)) {
						if ($this->level[$retval[$jKey]]>$this->level[$jValue]) {
							$retval[$jKey]=$jValue;
						}
					} else {
						$retval[$jKey]=$jValue;
					}
				}
			}
			$tmp = $this->ot_readif('features.json','usr/'.$user);
			foreach ($tmp as $jKey=> $jValue) {
				$retval[$jKey]=$jValue;
			}
		}
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $retval );
		return $retval;
	}	
	function ClnFtr($feature){
		$retval = $this->ot_getlist($feature.'/*.','*');
		foreach ($retval as $clave => $value){
			if (!strrpos ( $value , '.json' )){
			  unlink($value);	
			}
		}		
		$this->ot_log( __METHOD__ , __FUNCTION__ , func_get_args() , $retval );
		return $retval;
	}
}
