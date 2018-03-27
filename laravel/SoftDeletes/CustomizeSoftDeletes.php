<?php
/**
 * 自定义软删除
 * @author zhanpei 2018-03-27
 */
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

trait CustomizeSoftDeletes
{
    use SoftDeletes;

    public static function bootSoftDeletes()
    {
        static::addGlobalScope(new CustomizeSoftDeletingScope());
    }

    protected function runSoftDelete()
    {
        $query = $this->newQueryWithoutScopes()->where($this->getKeyName(), $this->getKey());

        $time = time();
        $columns = [$this->getDeletedAtColumn() => $time];
        $this->{$this->getDeletedAtColumn()} = $time;

        //更新deleted_at为当前时间戳
        $query->update($columns);
    }

    public function restore()
    {
        // If the restoring event does not return false, we will proceed with this
        // restore operation. Otherwise, we bail out so the developer will stop
        // the restore totally. We will clear the deleted timestamp and save.
        if ($this->fireModelEvent('restoring') === false) {
            return false;
        }

        $this->{$this->getDeletedAtColumn()} = 0; //这里

        // Once we have saved the model, we will fire the "restored" event so this
        // developer will do anything they need to after a restore operation is
        // totally finished. Then we will return the result of the save call.
        $this->exists = true;

        $result = $this->save();

        $this->fireModelEvent('restored', false);

        return $result;
    }

    //判断 model 实例是否已被软删除
    public function trashed()
    {
        return $this->{$this->getDeletedAtColumn()} > 0; //这里
    }
}
