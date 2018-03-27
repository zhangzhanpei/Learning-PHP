<?php
/**
 * 自定义软删除
 * @author zhanpei 2018-03-27
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomizeSoftDeletingScope extends SoftDeletingScope
{
    //添加 deleted_at = 0 条件到查询中
    public function apply(Builder $builder, Model $model)
    {
        $builder->where($model->getQualifiedDeletedAtColumn(), 0);
    }

    //加载下面三个add方法
    public function extend(Builder $builder)
    {
        foreach ($this->extensions as $extension) {
            $this->{"add{$extension}"}($builder);
        }

        $builder->onDelete(function (Builder $builder) {
            $column = $this->getDeletedAtColumn($builder);
            return $builder->update([$column => time()]); //这里
        });
    }

    protected function addRestore(Builder $builder)
    {
        $builder->macro('restore', function (Builder $builder) {
            $builder->withTrashed();
            return $builder->update([$builder->getModel()->getDeletedAtColumn() => 0]); //这里
        });
    }

    protected function addWithoutTrashed(Builder $builder)
    {
        $builder->macro('withoutTrashed', function (Builder $builder) {
            $model = $builder->getModel();
            $builder->withoutGlobalScope($this)->where($model->getQualifiedDeletedAtColumn(), 0); //这里
            return $builder;
        });
    }

    protected function addOnlyTrashed(Builder $builder)
    {
        $builder->macro('onlyTrashed', function (Builder $builder) {
            $model = $builder->getModel();
            $builder->withoutGlobalScope($this)->where($model->getQualifiedDeletedAtColumn(), '>', 0); //这里
            return $builder;
        });
    }
}
