<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Timetable extends CI_Model {
    
    protected $xml = null;
    protected $courses = array();
    protected $timeslots = array();
    protected $days = array();
    
    public function __construct() {
        parent::__construct();
        $this->xml = simplexml_load_file(DATAPATH . 'data/timetable.xml');
        
        //Days perspective
        foreach($this->xml->days as $day) {
            foreach($day->booking as $book) {
                $tmp = array();
                $tmp['day'] = (string) $book['date'];
                $tmp['classtype'] = (string) $book['classtype'];
                $tmp['timeslot'] = (string) $book['timeslot'];
                $tmp['course'] = (string) $book['course'];
                $tmp['room'] = (string) $book['room'];
                $tmp['instructor'] = (string) $book['instructor'];
                $tmp['class'] = (string) $book['class'];
                $this->days[] = new Booking($tmp);
                
            }
        }
        
        //Courses perspective
        foreach($this->xml->courses as $course) {
            foreach($course->booking as $book) {
                $tmp = array();
                $tmp['day'] = (string) $book['date'];
                $tmp['classtype'] = (string) $book['classtype'];
                $tmp['timeslot'] = (string) $book['timeslot'];
                $tmp['course'] = (string) $book['course'];
                $tmp['room'] = (string) $book['room'];
                $tmp['instructor'] = (string) $book['instructor'];
                $tmp['class'] = (string) $book['class'];
                $this->courses[] = new Booking($tmp);
            }
        }
        
        //Timeslot perspective
        foreach($this->xml->timeslots as $timeslot) {
            foreach($timeslot->booking as $book) {
                $tmp = array();
                $tmp['day'] = (string) $book['date'];
                $tmp['classtype'] = (string) $book['classtype'];
                $tmp['timeslot'] = (string) $book['timeslot'];
                $tmp['course'] = (string) $book['course'];
                $tmp['room'] = (string) $book['room'];
                $tmp['instructor'] = (string) $book['instructor'];
                $tmp['class'] = (string) $book['class'];
                $this->timeslots[] = new Booking($tmp);
            }
        }
    }
    
    public function getCourses() {
        return $this->course;
    }
    
    public function getTimeslots() {
        return $this->timeslots;
    }
    
    public function getDays() {
        return $this->days;
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