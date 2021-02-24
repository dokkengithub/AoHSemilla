<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

/**
 *
 */
trait ColumnTables {

    public function getDateFormat() {
        return "d-m-Y H:i:s.v";
    }

    public function getColumnsTable(){
        $columnsTable = DB::table('sysobjects')
            ->select(
                [
                    'syscolumns.colid',
                    //'sysobjects.name AS tablename',
                    'syscolumns.name AS columnname',
                    'systypes.name AS datatype',
                    //'syscolumns.length AS size'
                ]
            )
            ->join('syscolumns', function ($q) {
                $q->on('sysobjects.id', '=', 'syscolumns.id');
            })->join('systypes', function ($q) {
                $q->on('syscolumns.xtype', '=', 'systypes.xtype');
            })
            ->whereRaw("(sysobjects.xtype='U') AND (sysobjects.name='".$this->getTable()."') AND (UPPER(syscolumns.name) NOT IN (UPPER('created_at'), UPPER('updated_at')))")
            ->orderBy('sysobjects.name')
            ->orderBy('syscolumns.colid')
            ->get();

        return $columnsTable;
    }
}
