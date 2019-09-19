<?php
	class updates {
		//attributes
    	protected $incidentId;
    	protected $msg;
        protected $updateDateTime;
        protected $agency_username;
        protected $updateStatus;
        protected $numDeaths;
        protected $numInjured;
    
    	//getter and setter methods
    	public function getIncidentId(){
    		return $this->incidentId;
    	}

   	 	public function setIncidentId($incidentId){ 
        	 $this->incidentId = $incidentId;
    	}

    	public function getMsg(){
    		return $this->msg;
    	}

   	 	public function setMsg($msg){ 
        	 $this->msg = $msg;
    	}

    	public function getUpdateDateTime(){
    		return $this->updateDateTime;
    	}

   	 	public function setUpdateDateTime($updateDateTime){ 
        	 $this->updateDateTime = $updateDateTime;
    	}

    	public function getAgencyUsername(){
    		return $this->agency_username;
    	}

   	 	public function setAgencyUsername($agency_username){ 
        	 $this->agency_username = $agency_username;
    	}

    	public function getUpdateStatus(){
    		return $this->updateStatus;
    	}

   	 	public function setUpdateStatus($updateStatus){ 
        	 $this->updateStatus = $updateStatus;
    	}

    	public function getNumDeaths(){
    		return $this->numDeaths;
    	}

   	 	public function setNumDeaths($numDeaths){ 
        	 $this->numDeaths = $numDeaths;
    	}

    	public function getNumInjured(){
    		return $this->numInjured;
    	}

   	 	public function setNumInjured($numInjured){ 
        	 $this->numInjured = $numInjured;
    	}
	} 
?>