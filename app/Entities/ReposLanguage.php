<?php

/*
 * This file is part of develophub.net.
 *
 * (c) DevelopHub <master@develophub.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ReposLanguage extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * @var array
     */
    protected $fillable = ['repos_id', 'language', 'bytes'];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return mixed
     */
    public function repos()
    {
        return $this->belongsTo('App\Entities\Repos');
    }
}