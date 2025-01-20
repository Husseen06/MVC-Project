<?php

class FormationController {

    // Methode om de formatiepagina te tonen
    public function showFormation() {
        // Als het formulier is verzonden, verwerk de gegevens
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addFormation'])) {
            $this->processFormation();
        }
        
        // Toon de formatiepagina
        include './views/formation.html';
    }

    // Methode om de formatiegegevens te verwerken
    private function processFormation() {
        // Haal de formuliergegevens op
        $formationName = $_POST['formation_name'];

        // Hier kun je de logica toevoegen om de formatie in een database op te slaan
        // Voor nu simuleren we dat de formatie succesvol is toegevoegd
        echo "<p>Formatie '{$formationName}' is succesvol toegevoegd!</p>";
    }
}
?>
