export class Project {
    constructor(
        public user_id: number,
        public title: string,
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
        public i_know_fitness: boolean,
        public fitness_function: string,
        public alpha_value: number,
        public mutation_probability: number,
        public percent_elitism: number,
        public upperLeftPoint: number[],
        public upperRightPoint: number[],
        public lowerLeftPoint: number[],
        public lowerRightPoint: number[],
        public fileNameCorrelatedNetwork: string,
        public results: any,
        public image: string,
    ) {}
}