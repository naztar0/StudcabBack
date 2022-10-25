<?php

namespace App\Filters;

class UserFilters extends QueryFilter
{
    // sorting
    public function ordFirstName($order='asc')
    {
        return $this->builder->orderBy('first_name', $order);
    }

    public function ordLastName($order='asc')
    {
        return $this->builder->orderBy('last_name', $order);
    }

    // filtering
    public function search($text)
    {
        return $this->builder->where('first_name', 'like', "%$text%")
                             ->orWhere('last_name', 'like', "%$text%");
    }

    // paginate
    public function page($num)
    {
        $this->pageNum = $num;
    }
    public function perPage($num)
    {
        $this->itemsNum = $num;
    }
}
