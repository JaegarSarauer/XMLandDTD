<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Application {
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index($day = null, $time = null, $course = null){
        if ($day == "All") {
            $day = null;
        }
        if ($time == "All") {
            $time = null;
        }
        if ($course == "All") {
            $course = null;
        }
        $queryCourses = $this->timetable->getCourses($time, $day, $course);
        $queryTimeslot = $this->timetable->getTimeslots($time, $day, $course);
        $queryDays = $this->timetable->getDays($time, $day, $course);
        $this->data['pagebody'] = 'tables';
        
        if (count($queryCourses) > 1 && count($queryTimeslot) > 1 && count($queryDays) > 1) {        
            $this->data['Qtable1title'] = "Incomplete Data!";
            $this->data['Qtable1names'] = "";
            $this->data['Qtable1'] = "";

            $this->data['Qtable2title'] = "";
            $this->data['Qtable2names'] = "";
            $this->data['Qtable2'] = "";

            $this->data['Qtable3title'] = "";
            $this->data['Qtable3names'] = "";
            $this->data['Qtable3'] = "";
        } else if (count($queryCourses) == 1 && count($queryTimeslot) == 1 && count($queryDays) == 1) {
            $this->data['Qtable1title'] = "BINGO!";
            $this->data['Qtable1names'] = $this->getColumnNames($this->timetable->getCourses());
            $this->data['Qtable1'] = $this->parseToTable($queryCourses);

            $this->data['Qtable2title'] = "";
            $this->data['Qtable2names'] = "";
            $this->data['Qtable2'] = "";

            $this->data['Qtable3title'] = "";
            $this->data['Qtable3names'] = "";
            $this->data['Qtable3'] = "";
        } else {
            $this->data['Qtable1title'] = "";
            $this->data['Qtable1names'] = "";
            $this->data['Qtable1'] = "";

            $this->data['Qtable2title'] = "";
            $this->data['Qtable2names'] = "";
            $this->data['Qtable2'] = "";

            $this->data['Qtable3title'] = "";
            $this->data['Qtable3names'] = "";
            $this->data['Qtable3'] = "";
        }
        
        
        $this->data['table1title'] = "Courses Faucet";
        $this->data['table1names'] = $this->getColumnNames($this->timetable->getCourses());
        $this->data['table1'] = $this->parseToTable($this->timetable->getCourses());

        $this->data['table2title'] = "Timeslots Faucet";
        $this->data['table2names'] = $this->getColumnNames($this->timetable->getTimeslots());
        $this->data['table2'] = $this->parseToTable($this->timetable->getTimeslots());

        $this->data['table3title'] = "Days Faucet";
        $this->data['table3names'] = $this->getColumnNames($this->timetable->getDays());
        $this->data['table3'] = $this->parseToTable($this->timetable->getDays());

        $this->data['pickday'] = $this->createDropDownDays(); //create drop down
        $this->data['picktime'] = $this->createDropDownTimes(); //create drop down
        $this->data['pickcourse'] = $this->createDropDownCourses();
        //$this->data['table1'] = 
        $this->render();
    }
}
