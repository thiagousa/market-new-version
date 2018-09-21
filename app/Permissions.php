<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permissions extends Model
{
    use SoftDeletes;

    protected $table = 'permissions';

    protected $fillable = ['userId', 'pageAdminId', 'access', 'add', 'edit', 'delete'];

    protected $primaryKey = 'permissionsId';

    public $timestamps = false;

    public static function getUserPermission()
    {
        return self::permissionByUser(Auth::user()->id);
    }

    public static function permissionByUser($userId)
    {
        return self::where('userId', $userId)
            ->whereNull('deleted_at')
            ->join('pagesAdmin', 'pagesAdminId', '=', 'pageAdminId')
            ->orderBy('sortorder', 'ASC')->get();
    }

    public static function permissionByUserAndPage($userId, $pageAdminId)
    {
        return self::where('userId', $userId)->where('pageAdminId', $pageAdminId)->first();
    }

    public static function deletePermissionByUser($userId)
    {
        $query = self::where('userId', $userId);
        if($query->count() > 0) {
            return $query->delete();
        }else{
            return null;
        }
    }

    public function page()
    {
        return $this->belongsTo(PagesAdmin::class, 'pageAdminId', 'pagesAdminId');
    }

}