import './App.css'
import { useState, useEffect } from 'react';
import { HeroStack } from './components/HeroStack';
import { HeroesForm } from './components/HeroesForm'
import { API_URL } from './constants/URL'
import { Hero } from './types/Hero';

function App() {
  const [heroes, setHeroes] = useState<Hero[]>([]);

  async function getHeroes() {
    try {
      const result = await fetch(`${API_URL}/App/actions/read.php`);
      const json = await result.json();
      return JSON.parse(json.data).data as Hero[];
    } catch (error) {
      console.error("Error fetching heroes:", error);
      return [];
    }
  }

  useEffect(() => {
    getHeroes().then(data => { setHeroes(data); });
  }, []);

  const handleHeroCreated = async () => {
    const newHeroes = await getHeroes();
    setHeroes(newHeroes);
  };

  return (
    <div id='app'>
      <HeroesForm onHeroCreated={handleHeroCreated} />
      <HeroStack heroes={heroes} />
    </div>
  );
}

export default App;
