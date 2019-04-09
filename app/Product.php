<?php

namespace App;

use\Storage;
//use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    use Sluggable;

    protected $fillable = ['name', 'description', 'price','picture',];
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
    public function author()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function orders()
    {
        return $this->belongsToMany(
          Order::class,
           'order_products',
          'product_id',
          'order_id'
        );
    }
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public static function add($fields )
    {
        $products = new static;
        $products->fill($fields);
        $products->user_id = 1;
        $products->save();

        return $products;
    }

    public function edit($fields )
    {
        $this->fill($fields);
        $this->save();
    }

    public function remove()
    {
        $this->removeImage();
        $this->delete();
    }
    public function removeImage()
    {
        if($this->image != null)
        {
            Storage::delete('uploads/' . $this->image);  
        }
    }
    public function uploadImage($image)
    {
        if($image == null) { return; }
        
        $this->removeImage();
        $filename = str_random(10) . '.' . $image->extension();
        $image->storeAS('uploads',$filename);
        $this->picture = $filename;
        $this->save();
    }

    public function getImage()
{
    if ($this->picture == null)
    {
        return '/img/no-image.png';
    }


    return '/uploads/' . $this->picture;
}

    public function setCategory($id)
    {
        if($id == null) { return; }

        $this->category_id = $id;
        $this->save();
    }

    public function setDraft()
    {
        $this->status = 0;
        $this->save();
    }

    public function setPublic()
    {
        $this->status = 1;
        $this->save();
    }

    public function toggleStatus($value)
    {
        if($value == null)
        {
            return $this->setDraft();
        }
           return $this->setPublic();

    }

    public function inStock()
    {
        if($this->status)
        {
            return  'В наличии';
        }
        return 'Нет в наличии';
    }

    public function setFeatured()
    {
        $this->is_featured = 1;
        $this->save();
    }

    public function setStandart()
    {
        $this->is_featured = 0;
        $this->save();
    }

    public function toggleFeatured($value)
    {
        if($value == null)
        {
            return $this->setStandart();
        }
        return $this->setFeatured();

    }
    public function getCategoryTitle()
    {
        if($this->category != null)
        {
          return  $this->category->title;
        }
        return 'Нет категории';
    }

    public function getCategoryID()
    {
        return $this->category != null ? $this->category->id : null;
    }

    public function hasPrevious()
    {
       return self::where('id','<',$this->id)->max('id');
    }

    public function getPrevious()
    {
        $productID = $this->hasPrevious();
        return self::find($productID);
    }

    public function hasNext()
    {
       return self::where('id','>',$this->id)->min('id');
    }

    public function getNext()
    {
        $productID = $this->hasNext();
        return self::find($productID);
    }

    public function related()
    {
        return self::all()->except($this->id);
    }

    public function hasCategory()
    {
      return $this->category != null ? true : false;
    }

    public function getComments()
    {
        return $this->comments()->where('status',1)->get();
    }
}
