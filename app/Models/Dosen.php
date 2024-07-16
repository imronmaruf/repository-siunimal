<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'nip',
    ];

    public function kerjaPraktek()
    {
        return $this->hasMany(KerjaPraktek::class, 'dosen_pembimbing');
    }
    public function tugasAkhirPembimbing1()
    {
        return $this->hasMany(TugasAkhir::class, 'dosen_pembimbing_1');
    }
    public function tugasAkhirPembimbing2()
    {
        return $this->hasMany(TugasAkhir::class, 'dosen_pembimbing_2');
    }
    public function tugasAkhirPenguji1()
    {
        return $this->hasMany(TugasAkhir::class, 'dosen_penguji_1');
    }
    public function tugasAkhirPenguji2()
    {
        return $this->hasMany(TugasAkhir::class, 'dosen_penguji_2');
    }
}
