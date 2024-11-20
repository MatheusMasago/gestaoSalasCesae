<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    /** @use HasFactory<\Database\Factories\LocalFactory> */
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name'];

    const LOCALS = [
        'Porto',
        'São João da Madeira',
        'João de Canaveses',
    ];

    /**  Método para verificar se o nome do local existe na lista de locais padrão. */
    public static function isDefault($name)
    {
        return in_array($name, self::LOCALS);
    }

    /** Método para adicionar novos locais ao banco. */
    public static function addNewLocal($name)
    {
        if (!self::isDefault($name) && !self::where('name', $name)->exists()) {
            return self::create(['name' => $name]);
        }
        return null;
    }

    public function local()
    {
        return $this->belongsTo(Room::class);
    }
}
