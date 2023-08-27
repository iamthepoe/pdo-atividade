export interface Hero {
    id: string;
    name: string;
    skill: string;
    power_level: number;
}

export interface CreateHeroDTO {
    name: string;
    skill: string;
    powerLevel: string;
}