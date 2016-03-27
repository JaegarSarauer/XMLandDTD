<?php
/**
 * core/MY_Controller.php
 *
 * Default application controller
 *
 * @author		JLP
 * @copyright           2010-2013, James L. Parry
 * ------------------------------------------------------------------------
 */
class Application extends CI_Controller {
    protected $data = array();	  // parameters for view components
    protected $id;				  // identifier for our content
    /**
     * Constructor.
     * Establish view parameters & load common helpers
     */
    function __construct()
    {
            parent::__construct();
            $this->data = array();
            $this->errors = array();
            $this->data['pageTitle'] = 'Welcome';   // our default page
    }
    /**
     * Render this page
     */
    function render()
    {
            $this->data['data'] = $this->data;
            $this->data['content'] = $this->parser->parse($this->data['pagebody'], $this->data, true);
            $this->parser->parse('_template', $this->data);
    }

    function getColumnNames($data) {
        $result = "";
        if(count($data) < 1)
            return "Error parsing Columns";
        $inner = ((array)$data[0]);
        while (list($key, $val) = each($inner)) {
            $result .= '<td>' . $key  . '</td>';
        }
        $result .= '</tr>';
        return $result;
    }

    function parseToTable($data) {
        $result = "";
        foreach($data as $obj) {
            $result .= '<tr>';
            $inner = array_values((array)$obj);
            foreach ($inner as $tmp) {
                $result .= '<td>' . $tmp  . '</td>';
            }
            $result .= '</tr>';
        }
        return $result;
    }
        
    function createDropDownDays() {
        $URI = "$_SERVER[REQUEST_URI]"; //reloading page
        //error check URI is right
        if (strlen($URI) > 1) {
            $arr = explode('/', $URI);
            $URI = $arr[0].'/'.$arr[1];
        }
        //populates the dropdown & if you change the item it will reload page
        $result = '<select onchange="window.location=\''."http://$_SERVER[HTTP_HOST]$URI".'\' + this.value;">';
        $result .= '<option value="all">All</option>';
        foreach($this->timetable->getPossibleDays() as $key => $value) {
            $result .= '<option value="'.$key.'">'.$key. '</option>';
        }
        $result .= '</select>';
        return $result;
    }
    
    function createDropDownTimes() {
        $URI = "$_SERVER[REQUEST_URI]"; //reloading page
        //error check URI is right
        if (strlen($URI) > 1) {
            $arr = explode('/', $URI);
            $URI = $arr[0].'/'.$arr[1];
        }
        //populates the dropdown & if you change the item it will reload page
        $result = '<select onchange="window.location=\''."http://$_SERVER[HTTP_HOST]$URI".'\' + this.value;">';
        $result .= '<option value="all">All</option>';
        foreach($this->timetable->getPossibleTimes() as $key => $value) {
            $result .= '<option value="'.$key.'">'.$key. '</option>';
        }
        $result .= '</select>';
        return $result;
    }
    
    function createDropDownCourses() {
        $URI = "$_SERVER[REQUEST_URI]"; //reloading page
        //error check URI is right
        if (strlen($URI) > 1) {
            $arr = explode('/', $URI);
            $URI = $arr[0].'/'.$arr[1];
        }
        //populates the dropdown & if you change the item it will reload page
        $result = '<select onchange="window.location=\''."http://$_SERVER[HTTP_HOST]$URI".'\' + this.value;">';
        $result .= '<option value="all">All</option>';
        foreach($this->timetable->getPossibleCourses() as $key => $value) {
            $result .= '<option value="'.$key.'">'.$key. '</option>';
        }
        $result .= '</select>';
        return $result;
    }
}
/* End of file MY_Controller.php */
/* Location: application/core/MY_Controller.php */