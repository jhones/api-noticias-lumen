<?php

declare(strict_types=1);

namespace App\Models\News;

use App\Models\ImageNews\ImageNews;
use Illuminate\Database\Eloquent\Model;

/**
 * Class News
 * @package App\Models\News
 */
class News extends Model
{
    /**
     * @var string
     */
    protected $table = 'noticias';

    /**
     * @var string[]
     */
    protected $fillable = [
        'autor_id',
        'titulo',
        'subtitulo',
        'descricao',
        'publicada_em',
        'slug',
        'ativo',
        'criado_em'
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array|string[]
     */
    public array $rules = [
        'autor_id' => 'required|numeric',
        'titulo' => 'required|min:20|max:100',
        'subtitulo' => 'required|min:20|max:155',
        'descricao' => 'required|min:100',
        'slug' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(ImageNews::class, 'noticia_id', 'id');
    }
}
