<?php


namespace Wtolk\Eloquent;


class Support
{
    public static function checkOperator($builder, $operator)
    {
        if (in_array($operator, $builder->getQuery()->operators)) {
            return $operator;
        } else {
            throw new \Exception('Undefined operator ' . $operator);
        }
    }

    public static function checkValue($builder, $column, $operator, $value)
    {
        $model = $builder->getModel();
        if (method_exists($model, 'set' . $column . 'attribute')) {
            $model->{'set' . $column . 'attribute'}($value);
            $value = $model->getAttributes()[$column];
        }

        if ($operator == 'like' || $operator == 'ilike') {
            $value = '%' . $value . '%';
        }
        return $value;
    }
}
