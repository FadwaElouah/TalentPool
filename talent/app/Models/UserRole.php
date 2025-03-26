<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Constants for roles
    public const CANDIDATE = 'candidate';
    public const RECRUITER = 'recruiter';
    public const ADMIN = 'admin';

    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}
