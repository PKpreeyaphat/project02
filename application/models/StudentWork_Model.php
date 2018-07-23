<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class StudentWork_Model extends CI_Model {

    public function insert_tmp($data)
    {
        $this->db->insert('StudentWork_tmp', $data);
    }

    public function insert($data)
    {
        $this->db->insert('StudentWork', $data);
    }

    public function tmp2Work($data)
    {
        $select_tmp = $this->getWork_tmp($data);
        // clear
        $this->deleteBySubject($data);
        foreach($select_tmp as $row){
            $insert = array(
                'sw_Section_id' => $row->Section_id,
                'sw_Student_id' => $row->Student_id,
                'sw_Subject_id' => $row->Subject_id,
            );
            $this->insert($insert);
        }
    }

    public function getWork_tmp($data)
    {
        $this->db->join('Section', 'Section.Section_id = StudentWork_tmp.Section_id');
        $this->db->join('Room', 'Room.Room_id = Section.Room_id');
        $this->db->where('Section.Subject_id', $data['Subject_id']);
        $res = $this->db->get('StudentWork_tmp');
        return $res->result();
    }

    public function getWork($data)
    {
        $this->db->join('Section', 'Section.Section_id = sw_Section_id');
        $this->db->join('Room', 'Room.Room_id = Section.Room_id');
        $this->db->where('Section.Subject_id', $data['Subject_id']);
        $res = $this->db->get('StudentWork');
        return $res->result();
    }

    public function delete_tmp($data)
    {
        $this->db->where('Student_id', $data['Student_id']);
        $this->db->where('Section_id', $data['Section_id']);
        $res = $this->db->delete('StudentWork_tmp');
    }

    public function delete($data)
    {
        $this->db->where('sw_Student_id', $data['sw_Student_id']);
        $this->db->where('sw_Section_id', $data['sw_Section_id']);
        $res = $this->db->delete('StudentWork');
    }

    public function deleteBySubject($data)
    {
        $this->db->where('sw_Subject_id', $data['Subject_id']);
        $res = $this->db->delete('StudentWork');
    }

    public function get_tmp($data)
    {
        $this->db->where('Student_id', $data['Student_id']);
        $this->db->where('Section_id', $data['Section_id']);
        $res = $this->db->get('StudentWork_tmp');
        return $res->result();
    }

    public function get($data)
    {
        $this->db->where('sw_Student_id', $data['Student_id']);
        $this->db->where('sw_Section_id', $data['Section_id']);
        $res = $this->db->get('StudentWork');
        return $res->result();
    }

    public function save_tmp($data)
    {
        $select = $this->get_tmp($data);
        if(count($select) == 0){
            $this->insert_tmp($data);
        }
    }

    public function save($data)
    {
        $select = $this->get($data);
        if(count($select) == 0){
            $this->insert($data);
        }
    }



}

/* End of file StudentWork_tmp.php */


?>