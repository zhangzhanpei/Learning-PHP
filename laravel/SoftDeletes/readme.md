Eloquent ORM 软删除字段 `deleted_at` 默认为 `datetime` 类型，并且可以为 `null`。现改为 int 类型保存时间戳，默认值为 0。   
1、重写 `SoftDeletes` 和 `SoftDeletingScope`   
2、修改 `Illuminate\Database\Eloquent\Relations` 中的两处 `whereNull` 方法   
