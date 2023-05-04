<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{

    protected $table = 'departments';
    public $timestamps = true;
    protected $fillable = ['name_en','name_ar','slug','branch_id'];


    //  public static function booted()
    // {
    //     // static::addGlobalScope('store', function(Builder $builder) {
    //     //     if(Auth::guard('store')->check()) {
    //     //         $store = Auth::user();
    //     //         $builder->where( 'store_id' , $store->id );
    //     //     }

    //     // });

    //     static::creating(function(User $ser){
    //             return $user->slug = Str::slug($product->name);
    //     });

    //     static::updating(function(Product $product){
    //             return $product->slug = Str::slug($product->name);
    //     });
    // }
    public function users()
    {
        return $this->hasMany('App\Models\User');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

}
