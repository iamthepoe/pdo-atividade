import { CreateHeroDTO } from "../types/Hero";
import { API_URL } from "../constants/URL";

interface HeroesFormProps {
    onHeroCreated: () => void;
}

export const HeroesForm: React.FC<HeroesFormProps> = ({ onHeroCreated }) => {

    function verifyForm(elements: HTMLInputElement[]) {
        const emptyFields: string[] = [];

        elements.forEach(element => {
            if (!element?.value.trim()) {
                emptyFields.push(element?.placeholder);
            }
        });

        return emptyFields;
    }

    function showEmptyFields(element: HTMLElement, emptyFields: string[]) {
        const message = `Os seguintes campso não foram preenchidos: `;
        element.innerText = '';
        element.hidden = false;
        element.innerText = `${message} ${emptyFields.join(', ')}`;
    }

    async function createHero(hero: CreateHeroDTO) {
        const result = await fetch(`${API_URL}/App/actions/create.php`, {
            method: 'POST',
            body: JSON.stringify({
                ...hero,
                powerLevel: undefined,
                power_level: hero.powerLevel
            }),
        });

        return result.json();
    }

    async function handleClick() {
        const elements = {
            name: document.getElementById('name') as HTMLInputElement,
            skill: document.getElementById('skill') as HTMLInputElement,
            powerLevel: document.getElementById('powerLevel') as HTMLInputElement,
            errorMsg: document.getElementById('errorMsg') as HTMLElement
        };
        const emptyFields = verifyForm([elements.name, elements.powerLevel, elements.skill]);
        if (emptyFields.length > 0) return showEmptyFields(elements.errorMsg, emptyFields);
        else elements.errorMsg.hidden = true;

        try {
            const response = await createHero({
                name: elements.name.value,
                skill: elements.skill.value,
                powerLevel: elements.powerLevel.value
            });

            if (JSON.parse(response.data).created) {
                alert('Herói criado com sucesso!');
                onHeroCreated();
            }
        } catch {
            alert('Erro no servidor!');
        }

    }

    return (
        <>
            <div className="heroes-form">
                <h2>Cadastrar <span style={{ color: 'cyan' }}>Herói</span></h2>
                <label >
                    Name: <input type="text" id="name" name="name" placeholder="Name"></input>
                </label>
                <label >
                    Skill: <input type="text" id="skill" name="skill" placeholder="Skill"></input>
                </label>
                <label >
                    Power Level: <input type="number" id="powerLevel" name="powerLevel" placeholder="Power Level"></input>
                </label>
                <small color="red" hidden={true} id="errorMsg" className="warning">
                    Os seguintes campos não estão preenchidos:
                </small>
                <button onClick={handleClick}>Cadastrar</button>
            </div>
        </>
    )
}