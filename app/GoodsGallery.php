<?php

namespace App;

use App\Plugins\FileManager;
use Illuminate\Database\Eloquent\Model;

class GoodsGallery extends Model
{
    protected $table = 'goods_gallery';

    protected $fillable = ['goods_id', 'filename', 'hash'];

    public function goods()
    {
        return $this->belongsTo('App\Goods');
    }

    public function getImagePathAttribute()
    {
        return FileManager::getFileName($this->filename, $this->goods->imagesDir);
    }

    public function setFilenameAttribute($value)
    {
        if ($value and $value !== $this->filename) {
            FileManager::deleteFile($this->filename, $this->goods->imagesDir);
        }

        $this->attributes['filename'] = $value;
    }
}
