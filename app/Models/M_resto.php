<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class M_resto extends Model
{

    // Menentukan nama tabel
    protected $table = 'tb_resto'; // Ganti dengan nama tabel yang sesuai

    // Menentukan primary key tabel
    protected $primaryKey = 'id_resto'; // Ganti dengan nama primary key yang sesuai

    // Kolom yang bisa diisi (mass assignable)
    protected $fillable = ['kode_resto', 'nama_resto', 'alamat_resto']; // Ganti dengan kolom yang sesuai

    // Menentukan tipe data untuk beberapa kolom
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getById($id)
{
    return User::find($id);
}

    public function sqlquery($query)
    {
        return DB::select(DB::raw($query));
    }

    public function tampil($table)
    {
        $this->setTable($table);
        return DB::table($this->table)->get();
    }

    public function tambah($table, $data)
    {
        $this->setTable($table); 
        return DB::table($this->table)->insert($data); 
    }

    public function getWhere($table, $where)
{
    return DB::table($table)->where($where)->first();
}


public function edit($table, $where, $data)
{
    $this->setTable($table);
    return DB::table($this->table)->where($where)->update($data);
}

public function edit2($table, $data, $where)
{
    return DB::table($table)->where($where)->update($data);
}

public function hapus($table, $where)
{
    $this->setTable($table);
    return DB::table($this->table)->where($where)->delete();
}

    public function tampil2($tabel)
    {
        return DB::table($tabel)
                 ->whereNull('deleted_at') 
                 ->get();
    }

    public function join($table1, $table2, $on1, $on2) {
        $this->setTable($table1);
        return DB::table($this->table)
                    ->join($table2, $on1, '=', $on2) 
                    ->get(); 
    }

    public function join2($table1, $table2, $on1, $on2) {
        $this->setTable($table1);
        return DB::table($this->table)
                    ->join($table2, $on1, '=', $on2)
                    ->get(); 
    }

    public function join3tbl($table1, $table2, $on1, $on2, $table3, $on3, $on4) {
        $this->setTable($table1);
        return DB::table($this->table)
                    ->join($table2, $on1, '=', $on2)
                    ->join($table3, $on3, '=', $on4)
                    ->get();
    }

    public function getLogData()
    {
        return DB::table('log')
                 ->select('log.*', 'user.username')
                 ->join('user', 'log.id_user', '=', 'user.id_user')
                 ->orderBy('time', 'DESC')
                 ->get();
    }

    public function logActivity($data)
    {
        return DB::table('log')->insert($data);
    }

  
    public function getBackupData()
    {
        return DB::table('user_backup')->get();
    }
  
    public function getProductById($id)
    {
        return DB::table('user')->where('id_user', $id)->first();
    }

    
}

