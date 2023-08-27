import { Hero } from "../types/Hero";

interface HeroProps {
    hero: Hero;
}

export const HeroItem: React.FC<HeroProps> = ({ hero }) => {
    return (
        <tr className="hero-item">
            <td className="hero-item-field">{hero.id}</td>
            <td className="hero-item-field">{hero.name}</td>
            <td className="hero-item-field">{hero.skill}</td>
            <td className="hero-item-field">{hero.power_level}</td>
        </tr>
    );
};
