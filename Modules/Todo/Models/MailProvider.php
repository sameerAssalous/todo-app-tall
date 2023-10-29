<?php

namespace Module\Todo\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MailProvider extends Model
{
    use HasFactory;
    use SoftDeletes;

}
