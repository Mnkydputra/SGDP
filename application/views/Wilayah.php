<?php
class Wilayah extends CI_Controller
{

    public function index(Type $var = null)
    {
        $region = new Dekiakbar\IndonesiaRegionsPhpClient\Region();
        $provinsi = $region->getAllProvince('pos');
        $data = [
            'provinsi'  => $provinsi
        ];
        $this->load->view("wilayah", $data);
    }

    public function kota()
    {
        $provinceId = $this->input->post("provinsi_id");

        $region = new Dekiakbar\IndonesiaRegionsPhpClient\Region();
        $kota  = $region->getCityListByProvinceId('pos', $provinceId);
        echo json_encode($kota->list);
    }

    public function kecamatan()
    {
        $cityId = $this->input->post("kota_id");

        $region = new Dekiakbar\IndonesiaRegionsPhpClient\Region();
        $kelurahan  =  $region->getSubdistrictListByCityId('pos', $cityId);
        echo json_encode($kelurahan->list);
    }

    public function desa()
    {
        $cityId = $this->input->post("kecamatan_id");
        $region = new Dekiakbar\IndonesiaRegionsPhpClient\Region();
        $kelurahan  = $region->getVillageListBySubdistrictId('pos', $cityId);
        echo json_encode($kelurahan->list);
    }
}
