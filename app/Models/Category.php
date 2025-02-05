<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
/**
 * Class Category
 *
 * @property $id
 * @property $name
 * @property $description
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Category extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'description'];

    /**
     * Get all of the comments for the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function image()
    {
        return $this->category_image ? asset('storage/'. $this->category_image) : 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMwAAADACAMAAAB/Pny7AAAAPFBMVEX///+hoaGenp6mpqaZmZn5+fn8/PzX19e3t7e/v7/t7e2pqann5+fCwsLg4OCtra3IyMjOzs7z8/OTk5PhY2O7AAAC2klEQVR4nO3a6XKbMBRAYUkIIRazvv+7VtjGYAKkA8xwac/3147rU7SgBKUAAAAAAAAAAAAAAAAAAAAAAAAAAFeKT3VpSpn6UzXthTG1OVdVXNfiHkbr81K0qcpLY2xTnCQrvb065rx/vv2XYjJBMU455458mqSYw4TEhCviyvpRH/sqUmJU4SNtdOSPbHpCYsL30D1jfLt/2kiJSc0zRke22X9/JSSmqN4x2uT7B5qQmCQaYrTNdn+akJhGf3S3jynz8crcfpi1ldXRq8VvLgBx2JBWXxQSoxL9vjR280CSal2r1RwhMc7V1oalzNpk6/Ystf1OtPqykJig9OHi+GJry0zsc/Fu1l6XE6Nc3Mabd81Z99qJdLYy0uTEbN/F9JXDXmTylTfJifntnWHCRMPyvTJtbhOjkm7cWHWy+JbbxMR20mKibGlY3iZmvHlbnzb3iHHqMR1kvXRhybhHjCrnLcYs/Ng9Yr4mzDBtft6QyowppseAsMVU5kfMc32eDTSJMXHVdZP/d6fqnxemV98hpj8OGD3WFPMJ8x5oev6T4mLCwvUcU9YPJ5eFCTOsz7NpIy7mc7Lphptjvxaj56cBcTHt5wDdvY5pzWqLnp/UZMWEkeUnc6I/QJdbLSYq5Mb0v6YZV2Gbhi+ql1bl8S3V9DcGwmLKr1uwLlF+syVcm1SNBzpZMe1sd7QrO8wkRjdKZIxz3kTf3/W3ln59Lj+LgKSYrwnz18z4VxBJMUW+oyXUPIYPEBQTL95O/kXM5xAtKCbd1xJqqvdNtpyYJtobE6ZNLCum2DnIXl63NVJi2t92x+1LEz2njZSY+kCKHqaNkJhk/4R516SxE/LsTJbbw09n1U7GlXGPKM+r/IAqj3wpIybOztBKGGbJaU+bFpfHGJ+exedXP9bY/yHzJGEduDJGNXl0qnT/IxHHtWVyqitbAAAAAAAAAAAAAAAAAAAAAAAAAOC/9we2/TfNeTuRKgAAAABJRU5ErkJggg==';
    }

}
