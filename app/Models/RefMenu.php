<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefMenu extends Model
{
    protected $table = 'ref_menu';
    protected $guarded = [];

    public function scopeOperator()
    {
        return $this->where([
            'role_name' => 'operator'
        ]);
    }

    public function scopeSupervisor()
    {
        return $this->where([
            'role_name' => 'supervisor'
        ]);
    }

    public function scopeManager()
    {
        return $this->where([
            'role_name' => 'manager'
        ]);
    }
}
