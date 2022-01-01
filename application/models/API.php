<?php


class API extends CI_Model
{

    public function getData($table)
    {
        return $this->db->get($table);
    }
}
