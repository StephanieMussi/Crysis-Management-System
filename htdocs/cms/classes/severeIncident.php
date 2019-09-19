<?php
    include_once ('incident.php');
	class severeIncident extends incident{
		//attributes

    	protected $suggestionOnAction;
    	protected $proposedSuggestion;
    	protected $severityLevel;
    	protected $pmo_username;
    	protected $cmo_username;

    	public function getSuggestionOnAction(){
    		return $this->suggestionOnAction;
    	}

   	 	public function setSuggestionOnAction($suggestionOnAction){ 
        	 $this->suggestionOnAction = $suggestionOnAction;
    	}

    	public function getProposedSuggestion(){
    		return $this->proposedSuggestion;
    	}

   	 	public function setProposedSuggestion($proposedSuggestion){ 
        	 $this->proposedSuggestion = $proposedSuggestion;
    	}

    	public function getSeverityLevel(){
    		return $this->severityLevel;
    	}

   	 	public function setSeverityLevel($severityLevel){ 
        	 $this->severityLevel = $severityLevel;
    	}

    	public function getPmoUsername(){
    		return $this->pmo_username;
    	}

   	 	public function setPmoUsername($pmo_username){ 
        	 $this->pmo_username = $pmo_username;
    	}

    	public function getCmoUsername(){
    		return $this->cmo_username;
    	}

   	 	public function setCmoUsername($cmo_username){ 
        	 $this->cmo_username = $cmo_username;
    	}
	}
?>