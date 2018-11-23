<?php
namespace system;

class View
{
	/*
     class for connection view failes
    */
	

	public function generate($content_view, $data)
	{
		
        
		if(is_array($data)) {
			
			
			extract($data);
		}
        
		
		include_once 'application/views/'.$content_view;
        
	}
}
