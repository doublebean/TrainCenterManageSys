<?php

namespace App\Models;

use http\Exception;
use Illuminate\Database\Eloquent\Model;
use DB;
class Laboratory extends Model
{
    protected $table = "laboratory";
    public $timestamps = true;
    protected $guarded = [];
    /**
     * @return |null
     * z展示实验室表信息
     */
    public static function dc_getFormInfo(){
        try {
            $data = self::paginate(5);
            return $data;
        }catch (\Exception $e){
            logError('获取实验室表信息错误',$e->getMessage());
            return null;
        }


    }

    /**‘
     * @param $data
     * @return |null
     * 添加场地
     */
    public static function dc_addInfo($data){
        try {
            $data = self::create([
                'laboratory_name' => $data['laboratory_name'],
                'place' => $data['place'],
                'type' => $data['type']
            ]);
            return $data;
        }catch (\Exception $e){
            logError('添加场地失败',$e->getMessage());
            return null;
        }

    }

    /**
     * @param $data
     * @return |null
     * 搜索场地
     */
    public static function dc_selectInfo($data){
        try {
            $data['laboratory_name']?
                $rs = self::where('laboratory_name','like','%'.$data['laboratory_name'].'%')
                    ->paginate(5):
                $rs = self::paginate(5);
            return $rs;

        }catch (\Exception $e){
            logError('搜索场地信息失败',$e->getMessage());
            return null;
        }
    }


    /*
     * 把所有实验室名称给前端
     * @author caiwenpin <github.com/codercwp>
     * return $data
     */
    public static function cwp_back()
    {
        try {
            $data = self::select('laboratory_name')->get();
            return $data;

        } catch (\Exception $e) {
            logError('展示实验室名称错误', [$e->getMessage()]);
            return null;
        }
    }
      /*
      * 根据实验室名称返回实验室对应编号
      * @author caiwenpin <github.com/codercwp>
      * return $data
      */

    public static function cwp_move($name)
    {
        try {
            $result = self::where('laboratory_name', $name)->select('laboratory_id')->get();
            return $result;
        } catch (\Exception $e) {
            logError('联动展示实验室编号错误', [$e->getMessage()]);
            return null;
        }
    }
    /**
     * 实验室下拉框
     * @return |null
     */
    public static function lzz_laboratoryDrop(){
        try {
            $data = self::select('laboratory_name')
                ->get();
            return $data;
        } catch(\Exception $e){
            logError('实验室下拉框错误',[$e->getMessage()]);

            return null;
        }
    }

    /**

     * @param $data
     * @return |null
     * 回显
     */
    public static function dc_getInfoByID($data){
        try {
            $rs = self::where('laboratory_id',$data['laboratory_id'])
                        ->get();
            return $rs;

        }catch (\Exception $e){
            logError('获取回显信息失败',$e->getMessage());
            return null;
        }
    }
    /**
     * 填报实验室借用申请实验室名称编号联动
     * @author HuWeiChen <github.com/nathaniel-kk>
     * @param [String] $laboratory_name
     * @return array
     */
    Public static function hwc_fillLabBorLink($laboratory_name){
        try {
            $data = self::where('laboratory_name',$laboratory_name)
                ->select('laboratory_id')
                ->get();
            return $data;
        } catch(\Exception $e){
            logError('联动展示实验室编号错误',[$e->getMessage()]);
            return null;
        }
    }

    /**

     * @param $data
     * @return |null
     * 修改信息
     */
    public static function dc_exitInfo($data){
        try {
            $rs = self::where('laboratory_id',$data['laboratory_id'])
                ->update([
                    'laboratory_name' => $data['laboratory_name'],
                    'place' => $data['place'],
                    'type' => $data['type']
                ]);
            return $rs;
        }catch (\Exception $e){
            logError('修改信息失败',$e->getMessage());
            return null;
        }
    }
    /**
     * 填报实验室借用申请实验室名称展示
     * @author HuWeiChen <github.com/nathaniel-kk>
     * @return array
     */
    Public static function hwc_fillLabNameDis(){
        try {
            $data = self::select('laboratory_name')
                ->get();
            return $data;
        } catch(\Exception $e){
            logError('展示实验室名称错误',[$e->getMessage()]);
            return null;
        }
    }

    /**
     * @param $data
     * @return |null
     * 删除场地
     */
    public static function dc_rmInfo($data){
        try {
            $rs = self::where('laboratory_id',$data['laboratory_id'])
                ->delete();
            return $rs;
        }catch (\Exception $e){
            LogError('删除失败',$e->getMessage());
            return null;
        }
    }


    /**
     * 系部展示
     * @author yuanshuxin <github.com/CoderYsx>
     * @return \Illuminate\Http\JsonResponse
     */
    public static function ysx_showxibu(){

        try {
            $res = DB::table('xibuview')->get();
            return $res;
        } catch (\Exception $e) {
            logError('失败',[$e->getMessage()]);
            return null;
        }
    }

    /**
     * @author tangshengyou <TangSYc.github>
     * @return $DATA 实验室信息
     */
    public static function tsy_select(){
        try{
            $data = self::select("laboratory_name")
                ->get();
            return $data;
        }catch(Exception $e){
            logError("查找失败",[$e->getMessage()]);
            return null;
        }
    }
    /**
     * 根据实验室名字查找实验室id
     * @author tangshengyou <TangSYc.github>
     * @param $lab_name
     * @return $DATA 实验室信息
     */
    public static function tsy_selectByName($lab_name){
        try{
            $data = self::where("laboratory_name",$lab_name)
                ->select("laboratory_id")
                ->first();
            return $data;
        }catch(Exception $e){
            logError("查找失败",[$e->getMessage()]);
            return null;
        }
    }
    public static function tsy_selectAll(){
        try{
            $data = self::select("laboratory_id")
                ->get();
            return $data;
        }catch(Exception $e){
            logError("查找失败",[$e->getMessage()]);
            return null;
        }
    }


    /**
     * 使用中的场地展示
     * @author yuanshuxin <github.com/CoderYsx>
     * @return \Illuminate\Http\JsonResponse
     */
     public static function ysx_showusing(){

         try {
             $res = DB::table('usingsite')->get();
             return $res;
         } catch (\Exception $e) {
             logError('失败',[$e->getMessage()]);
             return null;
         }
     }


    /**
     * 场地排名
     * @author yuanshuxin <github.com/CoderYsx>
     * @return \Illuminate\Http\JsonResponse
     */
     public static function ysx_showranking(){
         try {
             $res = DB::table('siteranking')->get();
             return $res;
         } catch (\Exception $e) {
             logError('失败',[$e->getMessage()]);
             return null;
         }
     }
    /**
     * 开放实验室
     * @author yuanshuxin <github.com/CoderYsx>
     * @return \Illuminate\Http\JsonResponse
     */
     public static function ysx_showopenlab(){
         try {
             $res = DB::table('openlab')->get();
             return $res;
         } catch (\Exception $e) {
             logError('失败',[$e->getMessage()]);
             return null;
         }
     }
    /**
     * 场地数量
     * @author yuanshuxin <github.com/CoderYsx>
     * @return \Illuminate\Http\JsonResponse
     */
     public static function ysx_shownumber(){
         try {
             $res = DB::table('sitenumber')->get();
             return $res;
         } catch (\Exception $e) {
             logError('失败',[$e->getMessage()]);
             return null;
         }

     }
}
