<?php

namespace App\Helpers\Eloquent;

use Exception;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait Except
{
    public function scopeExcept(Builder $builder, $term = '',$relationField=false)
    {
        if(!$this->except){
            throw new Exception("Please define except Property");
        }
        foreach ($this->except as $except) {
            if (str_contains($except, '.') && $relationField) {
                $relation = Str::beforeLast($except, '.');
                $column = Str::afterLast($except, '.');
                $builder->orWhereRelation($relation, $column, '!=', $term);
                continue;
            }
            $builder->Where($except, '!=', $term);
        }
        return $builder;
    }
}
