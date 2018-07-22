<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Table extends CI_Controller {

    public function index()
    {
		$this->load->model("Table_Model");
		$this->load->model('AllSubject_Model');
        $data['subject'] = $this->AllSubject_Model->getSubject();
    	$data['getRoom'] = $this->Table_Model->getRoom();
        $this->load->view('table_data',$data);
        
	}

	public function loadSection()
	{
		$this->load->model('Section_Model');
		$data = $this->input->post('data');
		$rs = $this->Section_Model->getTime($data);
		echo json_encode($rs);
	}

	public function loadFreeTime()
	{
		$this->load->model('Register_Model');
		$data = $this->input->post('data');
		if(!isset($data['Semester_ID'])){
			$data['Semester_ID'] = $this->CurrentSemester_Model->getSemester_ID();
		}
		$rs = $this->Register_Model->getFreeTime($data);
		echo json_encode($rs);
	}

	public function loadRoom()
	{
		$this->load->model('Section_Model');
		$data = $this->input->post('data');
		$rs = $this->Section_Model->getRoom($data['id']);
		echo json_encode($rs);
	}
	
	public function loadStudent()
	{
		$this->load->model('CurrentSemester_Model');
		$this->load->model('Section_Model');
		$data = $this->input->post('data');
		if(!isset($data['Semester_ID'])){
			$data['Semester_ID'] = $this->CurrentSemester_Model->getSemester_ID();
		}
		$rs = $this->Section_Model->getStudent($data);
		echo json_encode($rs);
	}

    public function loadTable(){
    	//วันเวลาของแต่ละวิชาที่ใช้ห้องนี้
    	//รายชื่อนิสิต
    	
    	$RoomID = $this->input->post('Room_id');
    	$this->load->model('Table_Model');
    	$data['Room'] = $this->Table_Model->getRoomByID($RoomID);
    	if($data['Room'] != null){
    		$this->load->view("loadTable_View");	
    	}else{?>
    		<h3><center>ไม่มีข้อมูลห้องเรียน</center></h3>
<?php 	}    	
    }

}

/* End of file Page4.php */

//$this->load->view('page4_data');
?>

