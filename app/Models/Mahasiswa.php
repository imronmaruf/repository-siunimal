<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'name',
        'foto',
        'nim',
        'hp',
        'dosen_pembimbing_kp',
        'dosen_pembimbing_tga_1',
        'dosen_pembimbing_tga_2',
        'dosen_penguji_tga_1',
        'dosen_penguji_tga_2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function dosenPembimbingKp()
    {
        return $this->belongsTo(Dosen::class, 'dosen_pembimbing_kp');
    }

    public function dosenPembimbingTga1()
    {
        return $this->belongsTo(Dosen::class, 'dosen_pembimbing_tga_1');
    }

    public function dosenPembimbingTga2()
    {
        return $this->belongsTo(Dosen::class, 'dosen_pembimbing_tga_2');
    }

    public function dosenPengujiTga1()
    {
        return $this->belongsTo(Dosen::class, 'dosen_penguji_tga_1');
    }

    public function dosenPengujiTga2()
    {
        return $this->belongsTo(Dosen::class, 'dosen_penguji_tga_2');
    }

    public function kerjaPraktek()
    {
        return $this->hasMany(KerjaPraktek::class, 'mahasiswa_id', 'id');
    }

    public function tugasAkhir()
    {
        return $this->hasMany(TugasAkhir::class, 'mahasiswa_id', 'id');
    }
}
