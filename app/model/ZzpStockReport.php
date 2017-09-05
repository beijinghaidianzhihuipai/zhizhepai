<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class ZzpStockReport extends Model
{
    protected $table = 'stock_report';
    protected $dateFormat = 'U';
    protected $fillable = [
        'title',
        'only_key',
        'short_url',
        'report_date',
        'url',
        'updated_at',
        'created_at',
      ];

    public static function add($report_data){
        return $rel = self::create($report_data);
    }

    public static function check_key($only_key){
         return self::where('only_key',$only_key)->first();
    }

}