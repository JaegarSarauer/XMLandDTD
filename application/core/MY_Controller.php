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
}
/* End of file MY_Controller.php */
/* Location: application/core/MY_Controller.php */