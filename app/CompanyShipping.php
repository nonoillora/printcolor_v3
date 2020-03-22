<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyShipping extends Model
{
    protected $primaryKey = 'idCompany';
    protected $fillable = ['idCompany','name_company', 'address', 'phone', 'url_company','url_follow_package'];
}
