<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
class ProductModel extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = ['title','description','price','image'];
    /**
     * Get file public url
     *
     * @return String
     */
    public function getImageUrl(){
        if($this->image){
            return Storage::url($this->image);
        }
        return '';
    }
}
