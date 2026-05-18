<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'category_id',
        'thumbnail'
    ];

    // Автоматически генерируем slug при создании
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }
    public  static function uploadImage(Request $request, $image=null)
    {
        if($request->hasFile('thumbnail')) {
            if($image){
                Storage::delete($image);
            }
            $folder=date('Y-m-d');
            return $request->file('thumbnail')->store("images/{$folder}");
        }
        return null;
    }
    public function getImage()
    {
        if(!$this->thumbnail){
            return asset("no-image.png");
        }
        return asset("uploads/{$this->thumbnail}");
    }
        public function getPostDate()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d F,Y');
    }
}