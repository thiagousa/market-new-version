<?php
namespace App\Helpers;

class DataTables {
    /**
     * DataTables Helper getDataTableData
     * Function to create dataTables data
     *
     * @param array $model
     * @param array $columns
     * @param array $orderBy
     * @param string $search
     * @param int $limit
     * @param int $offset
     * @param array $noSearch
     * @param array $with
     * @param $request
     *
     * @return array
     */
    public static function getDataTableData(
        $model        = [],
        $columns      = [],
        $orderBy      = [1, 'asc'],
        $search       = '',
        $limit        = 50,
        $offset       = 0,
        $noSearch     = [],
        $with         = [],
        $request
    ){
        $data = [];

        if(!$model){
            return array(
                "draw"              => null,
                "recordsTotal"      => null,
                "recordsFiltered"   => null,
                "data"              => null
            );
        }

        $sql = $model; //$this->products;

        $numRows = $sql->count();

        if($with){
            foreach ($with as $w){
                if($w['methodName']){
                    $sql = $sql->with($w['methodName']);
                }
                if($w['columns']){
                    foreach ($w['columns'] as $kw => $columnWith) {
                        if (!empty($columnWith) and !empty($search)) {
                            if(in_array($columnWith, $w['noSearch']))
                                continue;
                            $sql = $sql->whereHas($w['methodName'], function($q) use($search, $columnWith, $kw){
                                if($kw == 0) {
                                    $q->where($columnWith, "like", '%' . $search . '%');
                                }else{
                                    $q->orWhere($columnWith, "like", '%' . $search . '%');
                                }
                            });
                        }
                    }
                }
            }
        }

        $query = $sql;

        foreach ($columns as $k => $column) {
            if (!empty($column) and !empty($search)) {
                if(in_array($column, $noSearch))
                    continue;
                if($k == 0) {
                    $query = $query->where($column, 'like', '%' . $search . '%');
                }else{
                    $query = $query->orWhere($column, 'like', '%' . $search . '%');
                }
            }
        }

        $q = $query->orderBy($columns[$orderBy[0]], $orderBy[1])->skip($offset)->take($limit);
        $numFiltereds = $q->count();
        $q = $q->get();

        foreach ($q as $item){
            $line = [];
            foreach ($columns as $k => $column) {
                if(!empty($column)) {
                    $line[] = $item->$column;
                } else {
                    $line[] = "";
                }
                unset($k);
            }
            $data[] = $line;
        }

        return array(
            "draw"              => $request->draw,
            "recordsTotal"      => $numRows,
            "recordsFiltered"   => $numFiltereds,
            "data"              => $data
        );
    }
}