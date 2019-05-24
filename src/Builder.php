<?php

namespace Wtolk\Eloquent;

class Builder extends \Illuminate\Database\Eloquent\Builder
{
    public function filter($filter)
    {

        foreach ($filter as $input_name => $value) {
            if ($value == '') continue; // If value is empty, going to next iteration

            //Get the column_name and operator
            $col_name_operator = explode(':', $input_name);
            if (count($col_name_operator) > 1) {
                if ($col_name_operator[0] == '') {
                    //method
                    $this->model->{$col_name_operator[1]}($value, $this);
                } else {
                    if (!strripos($col_name_operator[0], '.')) {
                        //default
                        $column = $col_name_operator[0];
                        $operator = Support::checkOperator($this, $col_name_operator[1]);
                        $value = Support::checkValue($this, $column, $operator, $value);
                        $this->where($column, $operator, $value);
                    } else {
                        //relation
                        $relation_column = explode('.', $col_name_operator[0]);
                        $relation = $relation_column[0];
                        $column = $relation_column[1];
                        $operator = $col_name_operator[1];

                        $this->whereHas($relation, function ($query) use ($column, $operator, $value) {
                            $value = Support::checkValue($query, $column, $operator, $value);
                            $query->where($column, $operator, $value);
                        });
                    }
                }
            } else {
                $column = $input_name;
                $operator = '=';
                $this->where($column, $operator, $value);
            }
        }
        return $this;
    }

}
