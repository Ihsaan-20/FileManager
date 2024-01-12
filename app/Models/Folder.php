<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;
    protected $table = 'folders';

    protected $fillable = [
        'name',
        'path',
        'type',
        'size'
    ];

    public function getFolderURL()
    {
        if($this->path){
            return url('storage/'.$this->path);
        }
    }
}
