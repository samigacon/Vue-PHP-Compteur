<template>
    <div>
        <h1>Compteur</h1>
        <h3>Vue.js + PHP + Python</h3>
        <button @click="incrementerCompteur">Incrémenter</button>
        <p>{{ compteur }}</p>
        <a href="https://github.com/samigacon/Vue-PHP-Python---Compteur">Lien vers le GitHub du projet</a>
    </div>
</template>

<script setup>
    import { ref } from 'vue';

    const compteur = ref(parseInt(sessionStorage.getItem('compteur')) || 0);

    const incrementerCompteur = async () => {
        try {
            console.log('Envoi de la requête au serveur...');
            const response = await fetch('https://vue-php-compteur-server.vercel.app/index.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ compteur: compteur.value })
            });

            console.log('Réponse reçue du serveur.');

            if (!response.ok) {
                throw new Error('Erreur lors de la requête au serveur');
            }

            const data = await response.json();
            console.log('Données JSON récupérées:', data);

            if (!data || typeof data.compteur === 'undefined') {
                throw new Error('Réponse du serveur invalide');
            }

            compteur.value = data.compteur;
            sessionStorage.setItem('compteur', compteur.value);

            console.log('Compteur mis à jour:', compteur.value);
            console.log('Échos du serveur:', data.echo.join('\n'));
            
        } catch (error) {
            console.error('Erreur:', error.message);
        }
    }
</script>
