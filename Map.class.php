<?php

class Map extends VectualGraph{


	function __construct($data, $config){
		parent::__construct($data, $config);
	}


	public function getMap(){
		return $this->compileMap();
	}
	
	
	private function compileMap(){
	
		$map =
		'<g id="whole_map"
			transform="translate('.-($this->width * 0.03).', '.($this->height * 0.18).')
			scale('.(min($this->height,$this->width) * 0.00065).')"
		>';
		
		$map .= $this->setColors();
		
		$map .= file_get_contents("/var/www/vectual-dev/class/map.txt");
		
		$map .='</g>';
			
		
		return $map;
	}
	
	
	private function setColors(){
		
		$style ='<style>';
		
			for($i=0; $i < $this->numValues; $i++){	
				$color = (255 - ($this->data[1]['value'][$i]/$this->maxValue * 255));
			
				$style .= '.'.$this->data[1]['location'][$i].'{fill: rgb(255,'.round($color).','.round($color).');} ';	
			}
			
		$style .='</style>';
		
		return $style;
	}

}


?>