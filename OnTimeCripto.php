<?php
trait Cripto{	
	protected function ot_read($file, $inside='no'){
		$this->ot_funct( __METHOD__ , __FUNCTION__ , func_get_args() );
		if ($inside=='no') {
			$file=$this->container.'/'.$file;
		} else {
			$file=$this->container.'/'.$inside. '/'.$file;
		}
		$vread=[];
		if ( ($this->lengR!='none') ){
			$file2 = $file.'.'.$this->lengW;
		}
		if ( $this->lengF!='no' ){
			if ( file_exists($file) )  {
				$stream=fopen($file,"r");
				if ($stream) {
					$vread='';
					while (!feof($stream)) {
						$vread.=fgets($stream);
					}
					$vread=json_decode($vread,true);
					fclose($stream);
				} else {
					fclose($stream);
					$this->ot_ae('C0010M001',$inside.'/'.$file);
				}
			} else {
				$this->ot_ae('C0010M005',$inside.'/'.$file);
			}
		}		
		
		if (($this->lengR!='none') ){
			if ( file_exists($file2) )  {
				$stream=fopen($file2,"r");
				if ($stream) {
					$vread='';
					while (!feof($stream)) {
						$vread.=fgets($stream);
					}
					echo $vread;
					$vread2=json_decode($vread,true);
					print_r($vread2);
					$vread = array_merge($vread2,$vread);
					fclose($stream);
				} else {
					fclose($stream);
					$this->ot_ae('C0010M001',$inside.'/'.$file2);
				}
			} else {
				$this->ot_ae('C0010M005',$inside.'/'.$file2);
			}
		}		
		unset($stream);
		return $vread;
	}	
	protected function ot_readif($file, $inside='no'){
		$this->ot_funct( __METHOD__ , __FUNCTION__ , func_get_args() );		
		if ($inside=='no') {
			$file=$this->container.'/'.$file;
		} else {
			$file=$this->container.'/'.$inside. '/'.$file;
		}
		$aread=[];
		if (($this->lengR != 'none') ){
			$file2 = $file.'.'.$this->lengR;
		} 
		if ( $this->lengF!='no' ){
			if (file_exists($file)) {
				$stream=fopen($file,"r");
				if ($stream) {
					$vread='';
					while (!feof($stream)) {
						$vread.=fgets($stream);
					}
					$aread=json_decode($vread,true);
					fclose($stream);
				} else {
					fclose($stream);
					$this->ot_ae('C0010M001',$inside.'/'.$file);
				}
			}
		}
		if (($this->lengR!='none') ){
			if ( file_exists($file2) )  {
				$stream=fopen($file2,"r");
				if ($stream) {
				$vread='';
					while (!feof($stream)) {
						$vread.=fgets($stream);
					}
					$vread2=json_decode($vread,true);
					$aread = array_merge($aread,$vread2);
					fclose($stream);
				} else {
					fclose($stream);
					$this->ot_ae('C0010M001',$inside.'/'.$file2);
				}
			}
		}		
		
		unset($stream);
		return $aread;
	}	
	protected function ot_write($file, $data, $inside="no"){
		$this->ot_funct( __METHOD__ , __FUNCTION__ , func_get_args() );
		if ( ($inside!='no' and $this->ot_exist($inside)) or ($inside=='no')) {
			if ($inside=='no') {
				$file=$this->container.'/'.$file;
			} else {
				$file=$this->container.'/'.$inside. '/'.$file;
			}
			if (($this->lengW!='none') ){
				$file .= '.'.$this->lengW;
			}
			$this->err='0';
			$stream=fopen($file, "w");
			if ($stream) {
				$save=fwrite($stream,json_encode($data,JSON_UNESCAPED_SLASHES));
				if ($save) {
					$this->retval=FALSE;
					fclose($stream);
				} else {
					fclose($stream);
					$this->ot_ae('C0010M003',$inside.'/'.$file);
					
				}
			} else {
				fclose($stream);
				$this->ot_ae('C0010M002',$inside.'/'.$file);
				$this->errtext['C0010M002']='Failing create content';
			}
		} else {
			$this->ot_ae('C0010M002',$inside.'/'.$file);
			$this->errtext['C0010M002']='Failing create content';			
		}
		unset($stream);
		return $this->err;
	}

	protected function ot_write_p($file, $data, $inside="no"){
		$this->ot_funct( __METHOD__ , __FUNCTION__ , func_get_args() );
		if ( ($inside!='no' and $this->ot_exist($inside)) or ($inside=='no')) {
			if ($inside=='no') {
				$file=$this->container.'/'.$file;
			} else {
				$file=$this->container.'/'.$inside. '/'.$file;
			}
			if (($this->lengW!='none') and ($this->lengW!=$this->lengD)){
				$file .= '.'.$this->lengW;
			}
			$this->err='0';
			$stream=fopen($file, "w");
			if ($stream) {
				$save=fwrite($stream,$data);
				if ($save) {
					$this->retval=FALSE;
					fclose($stream);
				} else {
					fclose($stream);
					$this->ot_ae('C0010M003',$inside.'/'.$file);
					
				}
			} else {
				fclose($stream);
				$this->ot_ae('C0010M002',$inside.'/'.$file);
				$this->errtext['C0010M002']='Failing create content';
			}
		} else {
			$this->ot_ae('C0010M002',$inside.'/'.$file);
			$this->errtext['C0010M002']='Failing create content';			
		}
		unset($stream);
		return $this->err;
	}

	protected function ot_write_public($file, $data, $inside="no"){
		$this->ot_funct( __METHOD__ , __FUNCTION__ , func_get_args() );
		if ( ($inside!='no' and $this->ot_exist($inside)) or ($inside=='no')) {
			if ($inside=='no') {
				$file=$file;
			} else {
				$file=$inside. '/'.$file;
			}
			if (($this->lengW!='none') and ($this->lengW!=$this->lengD)){
				$file .= '.'.$this->lengW;
			}
			$this->err='0';
			$stream=fopen($file, "w");
			if ($stream) {
				$save=fwrite($stream,$data);
				if ($save) {
					$this->retval=FALSE;
					fclose($stream);
				} else {
					fclose($stream);
					$this->ot_ae('C0010M003',$inside.'/'.$file);
					
				}
			} else {
				fclose($stream);
				$this->ot_ae('C0010M002',$inside.'/'.$file);
				$this->errtext['C0010M002']='Failing create content';
			}
		} else {
			$this->ot_ae('C0010M002',$inside.'/'.$file);
			$this->errtext['C0010M002']='Failing create content';			
		}
		unset($stream);
		return $this->err;
	}

	protected function ot_read_p($file, $inside='no'){
		$this->ot_funct( __METHOD__ , __FUNCTION__ , func_get_args() );
		if ($inside=='no') {
			$file=$this->container.'/'.$file;
		} else {
			$file=$this->container.'/'.$inside. '/'.$file;
		}
		$vread='';
		if (($this->lengR!='none') and ($this->lengR!=$this->lengD)){
				$file2 = $file.'.'.$this->lengW;
		}
		if (file_exists($file) or file_exists($file2)) {
			if (file_exists($file2)) {
				$file = $file2;
			}
			$stream=fopen($file,"r");
			if ($stream) {
				$vread='';
				while (!feof($stream)) {
					$vread.=fgets($stream);
				}
				fclose($stream);
			} else {
				fclose($stream);
				$this->ot_ae('C0010M001',$inside.'/'.$file);

			}
		} else {
			$this->ot_ae('C0010M005',$inside.'/'.$file);
		}
		unset($stream);
		return $vread;
	}	

	protected function ot_readif_p($file, $inside='no'){
		$this->ot_funct( __METHOD__ , __FUNCTION__ , func_get_args() );		
		if ($inside=='no') {
			$file=$this->container.'/'.$file;
		} else {
			$file=$this->container.'/'.$inside. '/'.$file;
		}
		$aread='';
		if (($this->lengR!='none') and ($this->lengR!=$this->lengD)){
				$file2 = $file.'.'.$this->lengW;
		}
		if (file_exists($file) or file_exists($file2)) {
			if (file_exists($file2)) {
				$file = $file2;
			}
			$stream=fopen($file,"r");
			if ($stream) {
				$vread='';
				while (!feof($stream)) {
					$vread.=fgets($stream);
				}
				fclose($stream);
			} else {
				fclose($stream);
				$this->ot_ae('C0010M001',$inside.'/'.$file);
			}
		}
		unset($stream);
		return $aread;
	}	


}	
