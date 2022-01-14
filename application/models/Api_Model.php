<?php


class Api_Model extends CI_Model
{

    public function getData($table, $where)
    {
        return $this->db->get_where($table, $where);
    }

    public function update($table, $data, $where)
    {
        $this->db->where($where);
        $query =  $this->db->update($table, $data);
        return $query;
    }
}
