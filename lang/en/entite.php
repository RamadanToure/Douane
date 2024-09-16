<?php

$tableau['situation_matri']  =  [
    ''=>'Sélectionner un élément',
    'c' => 'Célibataire',
    'm' => 'Marié(e)',
    'v' => 'Veuf',
];

$tableau['boolean']  =  [
    ''=>'Sélectionner un élément',
    'oui' => 'Oui',
    'non' => 'Non',
];


$tableau['sexe']  =  [
    ''=>'Sélectionner un élément',
    'm' => 'Masculin',
    'f' => 'Féminin',
];

$tableau['type_expediteur']  =  [
    ''=>'Sélectionner un élément',
    'pm' => 'Personne Morale',
    'pp' => 'Personne Physique',
];

$tableau['type_courrier']  =  [
    'e' => 'Courrier Entrant',
    's' => 'Courrier Sortant',
];

$tableau['listTypeCourrier']  =  [
    'ntr' => 'Courrier à traiter',
    'tr' => 'Courrier traité',
];

$tableau['statut_courrier']  =  [
    'ec' => 'Encours',
    'tf' => 'Transferé',
    'tr' => 'Traité',
    're' => 'Rejeté',
    'ar' => 'Archivé',
    'en' => 'Envoyé',
];

$tableau['priorite_courrier']  =  [
    'h' => 'Haute',
    'm' => 'Moyenne',
    'b' => 'Basse',
];

$tableau['type_destinataire']  =  [
    ''=>'Sélectionner un élément',
    'dr' => 'Direction',
    'se' => 'Service',
    'di' => 'Division',
];


$tableau['mois']  =  [
    ''=>'Choisir',
    '1' => 'Janvier',
    '2' => 'Février',
    '3' => 'Mars',
    '4' => 'Avril',
    '5' => 'Mai',
    '6' => 'Juin',
    '7' => 'Juillet',
    '8' => 'Août',
    '9' => 'Septembre',
    '10' => 'Octobre',
    '11' => 'Novembre',
    '12' => 'Décembre',
];
// Archive 

$tableau['type_doc_Archive']  =  [
    ''=>'Sélectionner un élément',
    'att' => 'Attestation',
    'bcd' => 'Bon de commande',
    'con' => 'Contrat',
    'cor' => 'Correspondance',
    'dev' => 'Devis',
    'fac' => 'Facture',
    'rap' => 'Rapport',
    'prv' => 'Procès-verbal',
    'nds' => 'Note de service',
    'aut' => 'Autres',
];

$tableau['statut_doc_Archive']  =  [
    ''=>'Sélectionner un élément',
    'pri' => 'Privé',
    'pub' => 'Public',
];
return $tableau;