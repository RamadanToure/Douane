<?php

return [
    /*
    |--------------------------------------------------------------------------
    |   UTILISATEUR
    |--------------------------------------------------------------------------
    */
    'id_user'=>'Utilisateur',
    'name'=>'Nom',
    'prenom'=>'Prénom(s)',
    'email'=>'E-mail',
    'tel_user'=>'Téléphone',
    'other_infos_user'=>'Autres infos.',
    'lib_role'=>'Rôle',
    'grade'=>'Grade',
    'matricule'=>'Matricule',
    'date_nais'=>'Date Naissance',
    'date_embauche'=>'Date d\'embauche',
    'telephone'=>'Téléphone',
    'echellon'=>'Echellon',
    'id_ini'=>'Initiateur',
    'is_active'=>'Etat du compte',
    
    /*
    |--------------------------------------------------------------------------
    |   MENU
    |--------------------------------------------------------------------------
    */
    'id_menu'=>'Identifiant',
    'libelle_menu'=>'Menu',
    'menu_icon'=>'Icône',
    'num_ordre'=>'N° Ordre',
    'order_ss'=>'order_ss',
    'route'=>'Route',
    'titre_page'=>'Titre page',
    'topmenu_id'=>'Menu parent',
    'user_id'=>'Initiateur',
    'architecture'=>'Architecture',
    'controler'=>'Contrôler',
    'elmt_menu'=>'Appartient au menu',
    'role' => 'Rôle',
    'libelle_action'=>'Action',
    'dev_action'=>'Dev Action',
    /*
    |--------------------------------------------------------------------------
    |   ROLE
    |--------------------------------------------------------------------------
    */
    'id_role'=>'Identifiant',
    'libelle_role'=>'Rôle',
    'sous_role'=>'Sous Rôle',
    'user_save_id'=>'Initiateur',
    'libelle_trace'=>'Trace',
    'created_at'=>'Date opération',

	
	/*
	|--------------------------------------------------------------------------
	|   DIRECTION
	|--------------------------------------------------------------------------
	*/
	'id_direc'=>'Identifiant',
	'code_direc'=>'Sigle',
	'lib_direc'=>'Direction',
	'respo_id'=>'Responsable',
	'init_id'=>'Initiateur',

	/*
	|--------------------------------------------------------------------------
	|   SERVICE
	|--------------------------------------------------------------------------
	*/
	'id_serv'=>'Identifiant',
	'code_serv'=>'Sigle',
	'lib_serv'=>'Service',
	'id_direc'=>'Direction',
	'respo_id'=>'Responsable',
	'init_id'=>'Initiateur',

	/*
	|--------------------------------------------------------------------------
	|   DIVISION
	|--------------------------------------------------------------------------
	*/
	'id_divi'=>'Identifiant',
	'code_divi'=>'Sigle',
	'lib_divi'=>'Division',
	'id_serv'=>'Service',
	'respo_id'=>'Responsable',
	'init_id'=>'Initiateur',

	/*
	|--------------------------------------------------------------------------
	|   EXPEDITEUR
	|--------------------------------------------------------------------------
	*/
	'id_expe'=>'Identifiant',
	'nom_expe'=>'Nom',
	'type_expe'=>'Type',
	'adres_expe'=>'Adresse',
	'email_expe'=>'E-mail',
	'init_id'=>'Initiateur',

	/*
	|--------------------------------------------------------------------------
	|   COURRIER
	|--------------------------------------------------------------------------
	*/
	'id_cour'=>'identifiant',
	'ref_cour'=>'Référence',
	'code_cour'=>'Code',
	'date_rece'=>'Date Récéption',
	'date_limite'=>'Date limite',
	'expe_id'=>'Expéditeur',
	'sujet_cour'=>'Sujet',
	'type_cour'=>'Type Courrier',
	'statut_cour'=>'Statut',
	'priorite_cour'=>'Priorité',
	'direc_id'=>'Destinataire Principale',
	'commentaire_cour'=>'Commentaires',
	'piece_jointe_cour'=>'Pièce jointe (PDF)',
	'init_id'=>'Initiateur',
	'code_check'=>'Code de suivi',
    
	'note_trce'=>'Note',
	'type_fonct'=>'Type fonction',
	'id_fonct'=>'Fonction',
	'type_destina'=>'Type Destinataire',
	'id_desti'=>'Destinataire',
	'fichier_reponse'=>'Fichier réponse (PDF)',

	/*
	|--------------------------------------------------------------------------
	|   COURRIERSORTANT
	|--------------------------------------------------------------------------
	*/
	'id_cours'=>'identifiant',
	'ref_cour'=>'Référence',
	'code_cour'=>'Code',
	'date_envoi'=>'Date envoi',
	'sujet_cour'=>'Sujet',
	'note_cour'=>'Note',
	'piece_jointe'=>'Pièce jointe',
	'dest_id'=>'Destinataire',
	'direc_id'=>'Direction',

	/*
	|--------------------------------------------------------------------------
	|   ARCHIVE
	|--------------------------------------------------------------------------
	*/
	'id_archive'=>'Identifiant',
	'ref_doc'=>'Reference',
	'code_doc'=>'Code',
	'sujet_doc'=>'Sujet',
	'type_doc'=>'Type',
	'direc_id'=>'Direction',
	'fichier_doc'=>'Fichier',
	'statut_doc'=>'Statut',
	'init_id'=>'Initiateur',

	/*
	|--------------------------------------------------------------------------
	|   CARRIERE
	|--------------------------------------------------------------------------
	*/
	'id_carr'=>'Identifiant',
	'type_fonct'=>'Type',
	'id_fonct'=>'Fonction',
	'date_debut_carr'=>'Date debut',
	'date_fin_carr'=>'Date fin',
	'salaire_carr'=>'Salaire',
	'id_occupant'=>'Occupant',
	'init_id'=>'Initiateur',

	//data-giwu-cms
    'not_found_direc' => '--',
    'not_found' => 'Non trouvé',
    'img_defaut' => 'defaut.jpg',

    // Message 
    'MsgCheckPage' => 'Vous n\'êtes pas autorisé <br/>à accéder à cette page.',
    'AucunInfosTrouve' => '&nbsp;Aucun enregistrement trouvé.',
    'titre_delete' => 'Suppression',
    'titre_transmettre' => 'Transmettre cette information',
    'titre_publier' => 'Publier cette information',
    'titre_Arreterdepublier' => 'Arrêter la publication de cette information',
    'infos_error' => 'Une erreur est survenue lors d\'exécution de cette tâche. Veuillez contactez l\'administrateur',
    'infos_add' => 'Enregistrement effectué avec succès.',
    'infos_update' => 'Modification effectuée avec succès.',
    'infos_delete' => 'Un élément supprimé avec succès',
    'infos_transmise' => 'Un élément transmis avec succès',
    'infos_trans' => 'Un élément transmis avec succès',
    'infos_go' => 'Publication effetuée avec succès',
    'infos_stop' => 'Publication arrêtée avec succès',
    'MsgCheckPage' => 'Vous n\'êtes pas autorisé <br/>à accéder à cette page.',
    'MsgCheckApp' => 'Votre compte est désactivité. Veuillez contactez l\'administrateur.',

    //CSS
    //#212529 : Noire 
    'colorTemplate' => '',
    'bar_page_stylePdf' => ' <style>
        .footer {width: 100%; font-size:10px; text-align: center;position: fixed;}
        .footer {bottom: 0px;}
        .pagenum:before {content: counter(page);}
    </style> ',

    'stylePdf' => ' <style>
        .footer {width: 100%;text-align: right;position: fixed;}
        .footer {bottom: 0px;}
        .pagenum:before {content: counter(page);}

        .td{padding: 3px 3px 3px 3px; }
        .table {border-collapse:collapse;}
        .th,.td {border:1px solid black;}
    </style> ',
    'signaturePdf' => 'Imprimé par '.Config('app.name').' Page ',
    'styleLignePdf' => '#b4b4a4',
];
