<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GalleryAlbum extends Model {
    protected $table = "gallery_album";
    protected $primaryKey = 'id';

    public function galleries(){
        return $this->hasMany('App\Models\Gallery', 'gallery_album_id', 'id');
    }

    public function account(){
        return $this->belongsTo('App\Models\Account', 'account_id', 'id');
    }

    public function listAlbumWithCountQuery(){
        $query = $this->select('gallery_album.*', DB::raw('(CASE WHEN items.count is not null THEN items.count ELSE 0 END) AS count_item'));
        $query->leftJoin(DB::raw('(select gallery_album_id, count(*) as count from gallery GROUP BY gallery_album_id) items'), function ($join) {
            $join->on('items.gallery_album_id', '=', 'gallery_album.id');
        });
        $query->orderBy('created_at', 'DESC');

        return $query;
    }


    public function listAlbumWithCountAndSimplePagination($perPage = 12){
        return $this->listAlbumWithCountQuery()->simplePaginate($perPage);
    }

    public function listAlbumWithCountAndPagination($perPage = 12){
        return $this->listAlbumWithCountQuery()->paginate($perPage);
    }
}