<?php

namespace App\Helpers;
use Validator;

trait DataTable
{
    public function scopeSearchPaginate($query, $column)
    {
        $request = app()->make('request');
        $v = Validator::make($request->only([
            'column', 'direction', 'per_page', 'search_input'
        ]),[
            'column'                => 'required|alpha_dash|in:'.implode(',',self::$columns),
            'direction'             => 'required|in:asc,desc',
            'per_page'              => 'integer|min:1',
            'search_input'          => 'max:255'
        ]);

        if($v->fails())
        {
            return ($v->messages());
        }


        return $query
                ->whereInput( $request->search_input )
                ->orderBy( $column, $request->direction )
                ->paginate( $request->per_page );
    }
}
