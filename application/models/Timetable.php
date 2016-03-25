<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Timetable extends CI_Model {
    
    protected $xml = null;
    protected $course = array();
    
    public function _construct() {
        parent::_construct();
        $this->xml = simplexml_load_file(DATAPATH . 'data/timetable.xml');
        
        foreach($this->xml->day as $day) {
            foreach($day->booking as $book) {
                $tmp = array();
                $tmp['day'] = (string) $book['date'];
                $tmp['classtype'] = (string) $book['classtype'];
                $tmp['timeslot'] = (string) $book['timeslot'];
                $tmp['course'] = (string) $book['course'];
                $tmp['room'] = (string) $book['room'];
                $tmp['instructor'] = (string) $book['instructor'];
                $tmp['class'] = (string) $book['class'];
                $this->course[] = new Booking($tmp);
                
            }
        }
    }
}

class Booking extends CI_Model {
    public $day;
    public $classtype;
    public $timeslot;
    public $course;
    public $room;
    public $instructor;
    public $class;
    
    public function __construct($b) {
        $this->day = $b['day'];
        $this->classtype = $b['classtype'];
        $this->timeslot = $b['timeslot'];
        $this->course = $b['course'];
        $this->room = $b['room'];
        $this->instructor = $b['instructor'];
        $this->class = $b['class'];
    }
}