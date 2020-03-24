<?php

namespace App\Imports;

use App\model\NilaiurutModel;
use Maatwebsite\Excel\Concerns\ToModel;

class NilaiurutImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function  __construct($id_urut,$tipe,$update)
    {
        $this->id_urut = $id_urut;
        $this->tipe = $tipe;
        $this->update = $update;
    }
    public function model(array $row)
    {
        if($this->tipe=="tp"){
            $nilai = (int)$row[9]*3.5;
        }else{
            $nilai = (int)$row[9]*2;
        }
        if($this->update==0){
            if($row[0]!=="Surname"){
                $urut = new NilaiurutModel;
                $urut->id_urut = $this->id_urut;
                $urut->nama = $row[0];
                $urut->kelas = $row[1];
                $urut->npm = substr($row[4],0,7);
                if($this->tipe=="tp"){
                    $urut->tp = $nilai;
                }else{
                    $urut->lp = $nilai;
                }

                if($row[0]!=="Overall average"){
                    $urut->save();
                }
            }
        }else{
            $data = array(
                $this->tipe => $nilai
            );
            NilaiurutModel::where('npm',substr($row[4],0,7))->update($data);
        }

        return new NilaiurutModel([
            'id_urut' => $this->id_urut,
            'npm' => "a",
            'nama' => "b",
            'kelas' => "c",
            'tp' => "d"
        ]);
    }
}
