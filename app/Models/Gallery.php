<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model {
    protected $table = "gallery";
    protected $primaryKey = 'id';

    protected $touches = ['album'];

    public function album(){
        return $this->belongsTo('App\Models\GalleryAlbum', 'gallery_album_id', 'id');
    }

    public function account(){
        return $this->belongsTo('App\Models\Account', 'account_id', 'id');
    }
}