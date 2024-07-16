<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KerjaPraktek extends Model
{
    use HasFactory;

    protected $table = 'kerja_praktek';
    protected $primaryKey = 'id';
    protected $fillable = [
        'mahasiswa_id',
        'dosen_pembimbing',
        'judul_kp',
        'latar_belakang',
        'laporan',
        'link_github',
        'link_gdrive',
        'bukti_distribusi',
        'bukti_nilai',
        'nilai',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id', 'id');
    }

    public function dosenPembimbing()
    {
        return $this->belongsTo(Dosen::class, 'dosen_pembimbing');
    }
}
