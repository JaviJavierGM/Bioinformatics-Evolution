export class EvolutionaryAlgorithm {
    constructor(
        public aminoacid: string,
        public space_type: string,
        public dimension_type: string,
        public optimization_algorithm: string,
        public selection_op: string,
        public crossover_op: string,
        public mutation_op: string,
        public elitism: boolean,
        public clamp_mutation: boolean,
        public caterpillar_mutation: boolean,
        public conformations: number,
        public times_algorithm: number,
        public experiments: number,
        public sampling: number,
        public percent_tournament: number,
        public percent_best: number,
        public crossover_probability: number,
        public min_mutation_probability: number,
        public max_mutation_probability: number,
        public proximity_pairing: number,
        public final_fitness: number,
    ) {}

}