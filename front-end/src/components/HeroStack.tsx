import { Hero } from "../types/Hero";
import { HeroItem } from "./Hero";

interface HeroList {
    heroes: Hero[];
}

export const HeroStack: React.FC<HeroList> = ({ heroes }) => {
    return (
        <div>
            <h2>Relatório de Heróis</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Skill</th>
                        <th>Power Level</th>
                    </tr>
                </thead>
                <tbody>
                    {heroes.map(hero => (
                        <HeroItem key={hero.id} hero={hero} />
                    ))}
                </tbody>
            </table>
        </div>
    );
};
