<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Course extends Model
{
    /** @use HasFactory<\Database\Factories\CourseFactory> */
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name', 'quantity_places'];

    const COURSES = [
        'Técnico de Comunicação e Serviço Digital - API - 3ºAno' => 16,
        'Técnico/a de Apoio à Gestão Desportiva - 2º Ano Freamunde' => 18,
        'Técnico/a Especialista em Desenvolvimento de Produtos Multimédia' => 15,
        'Software Developer (Braga)' => 25,
        'Network & Cyber Security Administrator (Lisboa)' => 20,
        'Digital Office' => 20,
        'Creative Digital Media' => 20,
        'Digital Marketing & Business Strategy' => 25,
        'Front-end Developer (SJM)' => 20,
        'Visual Design' => 20,
        'Contabilidade e Secretariado Digital' => 20,
        'Web & Mobile Developer' => 20
    ];

    /**  Método para verificar se o nome do curso existe na lista de cursos padrão. */
    public static function isDefault($name)
    {
        return array_key_exists($name, self::COURSES);
    }

    /** Método para adicionar novos cursos ao banco de dados. */
    public static function addNewCourse($name)
    {
        if (!self::isDefault($name) && !self::where('name', $name)->exists()) {
            return self::create(['name' => $name]);
        }
        return null;
    }

    public function user()
    {
        return $this->belongsTo(User::class); // Ensure the relationship is set up correctly
    }
}
