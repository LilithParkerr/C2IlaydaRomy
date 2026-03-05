<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Brand;
use App\Models\Type;

class Manual extends Model
{
    use HasFactory;

    /**
     * RELATIE MET BRAND
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * RELATIE MET TYPE
     */
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    /**
     * Returns the filesize in a human readable format
     */
    public function getFilesizeHumanReadableAttribute()
    {
        $size = $this->filesize;
        $unit = "";

        if ((!$unit && $size >= 1 << 30) || $unit == "GB")
            $value = number_format($size / (1 << 30), 2) . " GB";
        elseif ((!$unit && $size >= 1 << 20) || $unit == "MB")
            $value = number_format($size / (1 << 20), 2) . " MB";
        elseif ((!$unit && $size >= 1 << 10) || $unit == "KB")
            $value = number_format($size / (1 << 10), 2) . " KB";
        else
            $value = number_format($size) . " bytes";

        return $value;
    }

    /**
     * Returns true if the file is locally available
     */
    public function getLocallyAvailableAttribute()
    {
        // Local files are no longer used
        return false;
    }

    /**
     * Returns the manual URL
     */
    public function getUrlAttribute()
    {
        return $this->originUrl;
    }
}
