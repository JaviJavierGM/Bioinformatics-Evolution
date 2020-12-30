export class EvolutionaryAlgorithm {
    constructor(
        public aminoacid: string,
        public space_type: string,
        public dimension_type: string,
        public optimization: string,
        public selection_op: string,
        public crossover_op: string,
        public mutation_op: string,
        public conformations: number,
        public times_algorithm: number,
        public experiments: number,
        public sampling: number,
        public percent_tournament: number,
        public percent_best: number,
        public crossover_probability: number,
        public min_mutation_probability: number,
        public max_mutation_probability: number,
        public proximity_pairing: number
    ) {}

}