<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TugasAkhir extends Model
{
    use HasFactory;

    protected $table = 'tugas_akhir';
    protected $primaryKey = 'id';
    protected $fillable = [
        'mahasiswa_id',
        'dosen_pembimbing_1',
        'dosen_pembimbing_2',
        'dosen_penguji_1',
        'dosen_penguji_2',
        'judul_tga',
        'abstrak',
        'dokumen',
        'link_github',
        'link_gdrive',
        'ijazah',
        'bukti_distribusi',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function dosenPembimbing1()
    {
        return $this->belongsTo(Dosen::class, 'dosen_pembimbing_1');
    }

    public function dosenPembimbing2()
    {
        return $this->belongsTo(Dosen::class, 'dosen_pembimbing_2');
    }

    public function dosenPenguji1()
    {
        return $this->belongsTo(Dosen::class, 'dosen_penguji_1');
    }

    public function dosenPenguji2()
    {
        return $this->belongsTo(Dosen::class, 'dosen_penguji_2');
    }
}
