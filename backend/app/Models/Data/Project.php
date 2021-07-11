<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $fillable = [
        'title',
        'user_id',
        'aminoacid',
        'space_type',
        'dimension_type',
        'optimization_algorithm',
        'selection_op',
        'crossover_op',
        'mutation_op',
        'elitism',
        'clamp_mutation',
        'caterpillar_mutation',
        'conformations',
        'times_algorithm',
        'experiments',
        'sampling',
        'percent_tournament',
        'percent_best',
        'crossover_probability',
        'min_mutation_probability',
        'max_mutation_probability',
        'proximity_pairing',
        'final_fitness',
        'i_know_fitness',
        'fitness_function',
        'alpha_value',
        'mutation_probability',
        'percent_elitism',
        'upperLeftPoint',
        'upperRightPoint',
        'lowerLeftPoint',
        'lowerRightPoint',
        'fileNameCorrelatedNetwork',
        'image',
    ];

    // Relacion de muchos a uno
    public function user() {
        return $this->belongsTo('App\Models\Personal\User', 'user_id');
    }
}
