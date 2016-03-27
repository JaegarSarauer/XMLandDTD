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
        if ($day != null) {
            $_SESSION['day'] = $day;
        } else {
            $_SESSION['day'] = "All";
        }
        if ($time != null) {
            $_SESSION['time'] = $time;
        } else {
            $_SESSION['time'] = "All";
        }
        if ($course != null) {
            $_SESSION['course'] = $time;
        } else {
            $_SESSION['course'] = "All";
        }
        if ($day == "All") {
            $day = null;
        }
        if ($time == "All") {
            $time = null;
        }
        if ($course == "All") {
            $course = null;
        }
        //$this->load->view('tables');
        $this->data['pagebody'] = 'tables';
       // var_dump($this->timetable->getDays());
       // var_dump($this->timetable->getTimeslots());
        $this->data['table1names'] = $this->getColumnNames($this->timetable->getCourses($time, $day, $course));
        $this->data['table1'] = $this->parseToTable($this->timetable->getCourses($time, $day, $course));

        $this->data['table2names'] = $this->getColumnNames($this->timetable->getTimeslots($time, $day, $course));
        $this->data['table2'] = $this->parseToTable($this->timetable->getTimeslots($time, $day, $course));

        $this->data['table3names'] = $this->getColumnNames($this->timetable->getDays($time, $day, $course));
        $this->data['table3'] = $this->parseToTable($this->timetable->getDays($time, $day, $course));

        $this->data['pickday'] = $this->createDropDownDays(); //create drop down
        $this->data['picktime'] = $this->createDropDownTimes(); //create drop down
        $this->data['pickcourse'] = $this->createDropDownCourses();
        //$this->data['table1'] = 
        $this->render();
    }
}
