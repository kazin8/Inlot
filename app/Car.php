<?php

namespace App;

use App\Http\Controllers\Goods\FilterController;
use App\Http\Controllers\Goods\SortController;
use App\Interfaces\Category as CategoryItem;
use App\Plugins\FileManager;
use Illuminate\Database\Eloquent\Model;

class Car extends Model implements CategoryItem
{

    const AIRBAGS_NONE = 1;
    const AIRBAGS_DRIVER = 2;
    const AIRBAGS_DRIVER_PASSENGERS = 3;
    const AIRBAGS_FRONT_BACK = 4;
    const SALON_CLOTH = 1;
    const SALON_VELOUR = 2;
    const SALON_SKIN = 3;
    const SALON_COMBO = 4;
    const SALON_COLOR_DARK = 1;
    const SALON_COLOR_LIGHT = 2;
    const WINDOWS_MANUAL = 1;
    const WINDOWS_ELECTRO_FRONT = 2;
    const WINDOWS_ELECTRO_ALL = 3;
    const DRIVER_SEAT_MANUAL = 1;
    const DRIVER_SEAT_MANUAL_VERTICAL = 2;
    const DRIVER_SEAT_ELECTRO = 3;
    const DRIVER_SEAT_MEMORY = 4;
    const PASSENGER_SEAT_MANUAL = 1;
    const PASSENGER_SEAT_MANUAL_VERTICAL = 2;
    const PASSENGER_SEAT_ELECTRO = 3;
    const PASSENGER_SEAT_MEMORY = 4;
    const STEERING_CONTROL_NONE = 1;
    const STEERING_CONTROL_ONE = 2;
    const STEERING_CONTROL_TWO = 3;
    const STEERING_CONTROL_ELECTRO = 4;
    const CLIMATE_NONE = 1;
    const CLIMATE_CONDITIONER = 2;
    const CLIMATE_ONE_ZONE = 3;
    const CLIMATE_TWO_ZONE = 4;
    const CLIMATE_THREE_ZONE = 5;

    public static $airbagNames = [
        self::AIRBAGS_NONE => 'отсутствуют',
        self::AIRBAGS_DRIVER => 'водителя',
        self::AIRBAGS_DRIVER_PASSENGERS => 'водителя и пассажиров',
        self::AIRBAGS_FRONT_BACK => 'передние и задние'
    ];

    public static $salonNames = [
        self::SALON_CLOTH => 'ткань',
        self::SALON_VELOUR => 'велюр',
        self::SALON_SKIN => 'кожа',
        self::SALON_COMBO => 'комбинированный'
    ];

    public static $salonColorNames = [
        self::SALON_COLOR_DARK => 'темный',
        self::SALON_COLOR_LIGHT => 'светлый'
    ];

    public static $windowsNames = [
        self::WINDOWS_MANUAL => 'ручные',
        self::WINDOWS_ELECTRO_FRONT => 'электро передние',
        self::WINDOWS_ELECTRO_ALL => 'электро все'
    ];

    public static $driverSeatNames = [
        self::DRIVER_SEAT_MANUAL => 'ручная регулировка',
        self::DRIVER_SEAT_MANUAL_VERTICAL => 'ручная регулировка по высоте',
        self::DRIVER_SEAT_ELECTRO => 'электро регулировка',
        self::DRIVER_SEAT_MEMORY => 'с памятью положения'
    ];

    public static $steeringControlNames = [
        self::STEERING_CONTROL_NONE => 'отсутствует',
        self::STEERING_CONTROL_ONE => 'в одной плоскости',
        self::STEERING_CONTROL_TWO => 'в двух плоскостях',
        self::STEERING_CONTROL_ELECTRO => 'электро регулировка'
    ];

    public static $climateNames = [
        self::CLIMATE_NONE => 'отсутствует',
        self::CLIMATE_CONDITIONER => 'кондиционер',
        self::CLIMATE_ONE_ZONE => 'климат-контроль 1-зонный',
        self::CLIMATE_TWO_ZONE => 'климат-контроль 2-зонный',
        self::CLIMATE_THREE_ZONE => 'климат-контроль 3-зонный'
    ];

    public static $passengerSeatNames = [
        self::PASSENGER_SEAT_MANUAL => 'ручная регулировка',
        self::PASSENGER_SEAT_MANUAL_VERTICAL => 'ручная регулировка по высоте',
        self::PASSENGER_SEAT_ELECTRO => 'электро регулировка',
        self::PASSENGER_SEAT_MEMORY => 'с памятью положения'
    ];

    protected $fillable = [
        'category_id',
        'region_id',
        'city_id',
        'address',
        'mark_id',
        'model_id',
        'date_release_id',
        'run',
        'state_id',
        'vin',
        'pts_id',
        'pts_owner_number_id',
        'gear_id',
        'body_id',
        'color_id',
        'engine_id',
        'engine_capacity',
        'power',
        'rudder_id',
        'kpp_id',
        'sunroof',
        'tinted_windows',
        'xenon_headlights',
        'alloy_wheels',
        'antilock_system',
        'traction_control_system',
        'stability_system',
        'parktronic',
        'airbags',
        'salon',
        'salon_color',
        'on_board_computer',
        'rain_sensor',
        'light_sensor',
        'cruise_control',
        'navigation_system',
        'mirror_heating',
        'headlight_washer',
        'power_steering',
        'central_locking',
        'electric_mirrors',
        'windows',
        'driver_seat',
        'passenger_seat',
        'steering_control',
        'wheel_heating',
        'seat_heating',
        'climate',
        'full_time_alarm',
        'immobilizer',
        'feedback',
        'remote_engine_start',
        'cd',
        'tv',
        'tyre_id',
        'fl_disk_defect',
        'fl_cap_defect',
        'fl_profile_depth',
        'fl_tyre_image',
        'fr_disk_defect',
        'fr_cap_defect',
        'fr_profile_depth',
        'fr_tyre_image',
        'bl_disk_defect',
        'bl_cap_defect',
        'bl_profile_depth',
        'bl_tyre_image',
        'br_disk_defect',
        'br_cap_defect',
        'br_profile_depth',
        'br_tyre_image',
    ];

    /**
     * The binding handbook mark.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function marks()
    {
        return $this->belongsTo('App\Mark', 'mark_id');
    }

    /**
     * The binding handbook model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function models()
    {
        return $this->belongsTo('App\CarModel', 'model_id');
    }

    public function scopeFindById($query, $id)
    {
        return $query->find($id);
    }

    public function scopeCarList($query)
    {
        return $query->join('goods', 'cars.id', '=', 'goods.item_id')
            ->where('goods.status', Goods::ON_SALE)
            ->where('goods.active', true)
            ->where('goods.category_id', 2)
            ->whereNull('deleted_at')
            ->select('cars.*', 'goods.price', 'goods.name');
    }

    public function scopeFilter($query, FilterController $filter)
    {
        return $filter->apply($query);
    }

    public function scopeSort($query, SortController $sort)
    {
        return $sort->apply($query);
    }

    public function scopePagination($query, $page = 1, $perPage = 30)
    {
        return $query->skip(($page - 1) * $perPage)->take($perPage);
    }

    public function getGoodsAttribute()
    {
        return Goods::where('item_id', $this->id)->where('category_id', 2)->first();
    }

    public function getStateAttribute()
    {
        return $this->state_id ? HandbookContent::findById($this->state_id)['name'] : null;
    }

    public function getRunFormatAttribute()
    {
        return number_format($this->run, 0, '', ' ');
    }
    
    public function getPtsAttribute()
    {
        return $this->pts_id ? HandbookContent::findById($this->pts_id)['name'] : null;
    }
    
    public function getPtsOwnerNumberAttribute()
    {
        return $this->pts_owner_number_id ? HandbookContent::findById($this->pts_owner_number_id)['name'] : null;
    }
    
    public function getGearAttribute()
    {
        return $this->gear_id ? HandbookContent::findById($this->gear_id)['name'] : null;
    }
    
    public function getBodyAttribute()
    {
        return $this->body_id ? HandbookContent::findById($this->body_id)['name'] : null;
    }
    
    public function getColorAttribute()
    {
        return $this->color_id ? HandbookContent::findById($this->color_id)['name'] : null;
    }
    
    public function getEngineAttribute()
    {
        return $this->engine_id ? HandbookContent::findById($this->engine_id)['name'] : null;
    }
    
    public function getRudderAttribute()
    {
        return $this->rudder_id ? HandbookContent::findById($this->rudder_id)['name'] : null;
    }
    
    public function getKppAttribute()
    {
        return $this->kpp_id ? HandbookContent::findById($this->kpp_id)['name'] : null;
    }

    public function getTyreAttribute()
    {
        return $this->tyre_id ? HandbookContent::findById($this->tyre_id)['name'] : null;
    }

    public function getFlTyreImagePathAttribute()
    {
        return FileManager::getFileName($this->fl_tyre_image, $this->goods->imagesDir);
    }

    public function getFrTyreImagePathAttribute()
    {
        return FileManager::getFileName($this->fr_tyre_image, $this->goods->imagesDir);
    }

    public function getBlTyreImagePathAttribute()
    {
        return FileManager::getFileName($this->bl_tyre_image, $this->goods->imagesDir);
    }

    public function getBrTyreImagePathAttribute()
    {
        return FileManager::getFileName($this->br_tyre_image, $this->goods->imagesDir);
    }

    public function setEngineCapacityAttribute($value)
    {
        $this->attributes['engine_capacity'] = $value ?: null;
    }

    public function setPowerAttribute($value)
    {
        $this->attributes['power'] = $value ?: null;
    }

    public function setFlTyreImageAttribute($value)
    {
        if ($value and $value !== $this->fl_tyre_image) {
            FileManager::deleteFile($this->fl_tyre_image, $this->goods->imagesDir);
        }

        $this->attributes['fl_tyre_image'] = $value;
    }

    public function setFrTyreImageAttribute($value)
    {
        if ($value and $value !== $this->fr_tyre_image) {
            FileManager::deleteFile($this->fr_tyre_image, $this->goods->imagesDir);
        }

        $this->attributes['fr_tyre_image'] = $value;
    }

    public function setBlTyreImageAttribute($value)
    {
        if ($value and $value !== $this->bl_tyre_image) {
            FileManager::deleteFile($this->bl_tyre_image, $this->goods->imagesDir);
        }

        $this->attributes['bl_tyre_image'] = $value;
    }

    public function setBrTyreImageAttribute($value)
    {
        if ($value and $value !== $this->br_tyre_image) {
            FileManager::deleteFile($this->br_tyre_image, $this->goods->imagesDir);
        }

        $this->attributes['br_tyre_image'] = $value;
    }

}
