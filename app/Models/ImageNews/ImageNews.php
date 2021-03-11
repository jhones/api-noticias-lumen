<?php

declare(strict_types=1);

namespace App\Models\ImageNews;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ImageNews
 * @package App\Models\ImageNews
 */
class ImageNews extends Model
{
    /**
     * @var string
     */
    protected $table = 'imagens_noticias';

    /**
     * @var string[]
     */
    protected $fillable = [
        'noticia_id',
        'imagem',
        'descricao',
        'ativo',
        'criado_em'
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    public array $rules = [
        'noticia_id' => 'required|numeric',
        'imagem' => 'required',
        'descricao' => 'required|min:10|max:255'
    ];
}
