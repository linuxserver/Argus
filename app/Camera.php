<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Camera extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cameras';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key', 'name', 'ip', 'feed', 'status', 'preview'
    ];

    public static function populate($cameras)
    {
        foreach($cameras as $camera) {
            self::create($camera);
        }
    }

    /**
     * Scan network for cameras
     * @return [type] [description]
     */
    public static function scan()
    {
        $range = self::scan_range();
        $urls = [];
        for($i=2;$i<=255;$i++) {
            $urls[] = $range.".".$i;
        }

    }

    public static function scan_range()
    {
        preg_match('/^(?P<class_c>[^\.]+.[^\.]+.[^\.]+)/', $_SERVER["REMOTE_ADDR"], $match);
        return $match['class_c'];
    }



}
