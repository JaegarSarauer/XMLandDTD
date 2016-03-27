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
        $this->xml = simplexml_load_file(DATAPATH . 'timetable.xml');
        //Days perspective
        foreach($this->xml->days->day as $day) {
            foreach($day->booking as $book) {
                $tmp = array();
                $tmp['day'] = (string) $day['date'];
                $tmp['classtype'] = (string) $book['classtype'];
                $tmp['timeslot'] = (string) $book->timeslot;
                $tmp['course'] = (string) $book->course;
                $tmp['room'] = (string) $book->room;
                $tmp['instructor'] = (string) $book->instructor;
                $this->days[] = new Booking($tmp);
            }
        }
        
        //Courses perspective
        foreach($this->xml->courses->course as $course) {
            foreach($course->booking as $book) {
                $tmp = array();
                $tmp['day'] = (string) $book->day;
                $tmp['classtype'] = (string) $book['classtype'];
                $tmp['timeslot'] = (string) $book->timeslot;
                $tmp['course'] = (string) $course['course'];
                $tmp['room'] = (string) $book->room;
                $tmp['instructor'] = (string) $book->instructor;
                $this->courses[] = new Booking($tmp);
            }
        }
        
        //Timeslot perspective
        foreach($this->xml->timeslots->timeslot as $timeslot) {
            foreach($timeslot->booking as $book) {
                $tmp = array();
                $tmp['day'] = (string) $book->day;
                $tmp['classtype'] = (string) $book['classtype'];
                $tmp['timeslot'] = (string) $timeslot['time'];
                $tmp['course'] = (string) $book->course;
                $tmp['room'] = (string) $book->room;
                $tmp['instructor'] = (string) $book->instructor;
                $this->timeslots[] = new Booking($tmp);
            }
        }
    }
    
    public function getPossibleDays() {
        $days = array(
            'Monday' => 'Monday',
            'Tuesday' => 'Tuesday',
            'Wednesday' => 'Wednesday',
            'Thursday' => 'Thursday',
            'Friday' => 'Friday'
        );
        return $days;
    }
    
    public function getPossibleTimes() {
        $time = array (
            "8:30-10:30" => "8:30-10:30",
            "8:30-11:30" => "8:30-11:30",
            "9:30-10:30" => "9:30-10:30",
            "9:30-11:30" => "9:30-11:30",
            "10:30-11:30" => "10:30-11:30",
            "10:30-12:30" => "10:30-12:30",
            "11:30-12:30" => "11:30-12:30",
            "11:30-1:30" => "11:30-1:30",
            "12:30-1:30" => "12:30-1:30",
            "12:30-2:30" => "12:30-12:30",
            "1:30-2:30" => "1:30-2:30",
            "1:30-3:30" => "1:30-3:30",
            "2:30-3:30" => "2:30-3:30",
            "2:30-4:30" => "2:30-4:30",
            "3:30-4:30" => "3:30-4:30",
            "3:30-5:30" => "3:30-5:30",
            "4:30-5:30" => "4:30-5:30"
        );
        return $time;   
    }
    
    public function getPossibleCourses() {
        $courses = array (
            "COMP4111" => "COMP4111",
            "COMP4135" => "COMP4135"
        );
        return $courses;
    }
    
    public function getCourses($time = null, $day = null, $course = null) {
        $result = array();
        foreach($this->courses as $booking) {
            if (($time == null || $booking->timeslot == $time) && 
                    ($day == null || $booking->day == $day) && 
                    ($course == null || $booking->course == $course)) {
                array_push($result, $booking);
            }
        }
        return $result;
    }
    
    public function getTimeslots($time = null, $day = null, $course = null) {
        $result = array();
        foreach($this->timeslots as $booking){
            if (($time == null || $booking->timeslot == $time) && 
                    ($day == null || $booking->day == $day) && 
                    ($course == null || $booking->course == $course)) {
                array_push($result, $booking);
            }
        }
        return $result;
    }
    
    public function getDays($time = null, $day = null, $course = null) {
        $result = array();
        foreach($this->days as $booking){
            if (($time == null || $booking->timeslot == $time) && 
                    ($day == null || $booking->day == $day) && 
                    ($course == null || $booking->course == $course)) {
                array_push($result, $booking);
            }
        }
        return $result;
    }
}

class Booking extends CI_Model {
    public $day;
    public $classtype;
    public $timeslot;
    public $course;
    public $room;
    public $instructor;
    
    public function __construct($b) {
        $this->day = $b['day'];
        $this->classtype = $b['classtype'];
        $this->timeslot = $b['timeslot'];
        $this->course = $b['course'];
        $this->room = $b['room'];
        $this->instructor = $b['instructor'];
    }
}