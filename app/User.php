<?php

namespace App;

use App\Plugins\FileManager;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Intervention\Image\Facades\Image;

class User extends Authenticatable
{
    const PATH_TO_AVATARS = '/avatars/';
    const INDIVIDUAL_TYPE = 1;
    const ENTITY_TYPE = 2;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'login', 'phone', 'is_admin', 'type', 'image', 'may_sell'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    protected $dates = ['created_at', 'updated_at'];

    /**
     * Get the pages for the user.
     */
    public function pages()
    {
        return $this->hasMany('App\Page', 'creator_id');
    }

    /**
     * The user's address.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function address()
    {
        return $this->hasOne('App\Address');
    }

    /**
     * The user's company.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function company()
    {
        return $this->hasOne('App\Company');
    }

    /**
     * The user's goods.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function goods()
    {
        return $this->hasMany('App\Goods');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function sales()
    {
        return $this->hasMany('App\Order', 'user_owner_id');
    }

    /**
     * Scope a query to only administrators.
     *
     * @param $query
     * @return mixed
     */
    public function scopeAdministrators($query)
    {
        return $query->where('is_admin', true);
    }

    /**
     * Scope a query to only not administrators.
     *
     * @param $query
     * @return mixed
     */
    public function scopeNotAdministrators($query)
    {
        return $query->where('is_admin', false);
    }

    /**
     * Set the user's password from plain to hash.
     *
     * @param $password
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
    
    public function getCityAttribute()
    {
        return $this->address ? $this->address->cityName : null;
    }
    
    public function getRegionAttribute()
    {
        return $this->address ? $this->address->regionName : null;
    }
    
    public function getCompanyNameAttribute()
    {
        return $this->company ? $this->company->name : null;
    }
    
    public function getAddsAttribute()
    {
        return $this->address ? $this->address->address : null;
    }
    
    public function getPostcodeAttribute()
    {
        return $this->address ? $this->address->postcode : null;
    }
    
    public function getInnAttribute()
    {
        return $this->company ? $this->company->inn : null;
    }
    
    public function getAddressDescAttribute()
    {
        return $this->address ? $this->address->description : null;
    }

    public function getImagesDirAttribute()
    {
        return '/users/' . $this->id . '/';
    }
    
    public function getImagePathAttribute()
    {
        return FileManager::getFileName($this->image, $this->imagesDir) ?: '/static/default/user.png' ;
    }

    public function getImage30PathAttribute()
    {
        return FileManager::getFileName('30_' . $this->image, $this->imagesDir) ?: '/static/default/user30.png';
    }

    public function getImage80PathAttribute()
    {
        return FileManager::getFileName('80_' . $this->image, $this->imagesDir) ?: '/static/default/user80.png';
    }

    public function setImageAttribute($value)
    {
        if ($value !== $this->image) {
            FileManager::deleteFile($this->image, $this->imagesDir);
            FileManager::deleteFile('30_' . $this->image, $this->imagesDir);
            FileManager::deleteFile('80_' . $this->image, $this->imagesDir);

            if ($value) {
                $img = Image::make('static' . $this->imagesDir . $value);
                $img = ($img->height() > $img->width()) ?
                    $img->resize(null, 30, function($constraint) {
                        $constraint->aspectRatio();
                    }) :
                    $img->resize(30, null, function($constraint) {
                        $constraint->aspectRatio();
                    });
                $img->save('static' . $this->imagesDir . '30_' . $img->basename);
                $img = Image::make('static' . $this->imagesDir . $value);
                $img = ($img->height() > $img->width()) ?
                    $img->resize(null, 80, function($constraint) {
                        $constraint->aspectRatio();
                    }) :
                    $img->resize(80, null, function($constraint) {
                        $constraint->aspectRatio();
                    });
                $img->save('static' . $this->imagesDir . '80_' . $img->basename);
            }
        }

        $this->attributes['image'] = $value;
    }

    public function getRegisterDateAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d.m.Y');
    }

    public function getImagePathEmpty()
    {
        return FileManager::getFileName($this->image, $this->imagesDir);
    }
}
