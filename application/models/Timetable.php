<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Timetable extends CI_Model {
    
    protected $xml = null;
    protected $year = array();
    protected $term = array();
    
    public function _construct() {
        parent::_construct();
        $this->xml = simplexml_load_file(DATAPATH . 'timetable.xml');
        
        foreach($this->xml->timestable->year as $tmp) {
            array_push ($year, $tmp);
        }
        
        foreach($this->xml->timestable->term as $tmp) {
            array_push ($term, $tmp);
        }
    }
}
