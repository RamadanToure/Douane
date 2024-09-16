<?php
////RICHARD---YES I CAN
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\GiwuRoleAcces;
use App\Models\GiwuActionacces;
use App\Models\GiwuRole;
use App\Models\User;
use App\Models\GiwuActionmenuacces;
use Auth;

class GiwuMenu extends Model {

	protected $table = 'csm_menu';
	protected $primaryKey = 'id_menu';
	protected $guarded=[];
	public $timestamps = true;

    
    ///Liste des menus dont topmenu_id = 0... Jointure avec la table role Access
	public static function getListMenuTopIdEgaVari($idTopMenu){
       
        return GiwuRoleAcces::join('csm_menu','csm_menu.id_menu','csm_role_acces.id_menu')
                            ->where('csm_role_acces.role_id',Auth::user()->id_role)
                            ->where('csm_role_acces.statut_role',1)
                            ->where('csm_menu.topmenu_id',$idTopMenu)
                            ->where('csm_menu.elmt_menu',"oui")
                            ->whereNotIn('csm_menu.id_menu',[1])
                            ->orderby('csm_menu.num_ordre','asc')
                            ->get();
    }
    
	public static function getSltEmpMenu(){
        return GiwuMenu::all()->whereNotIn('id_menu',[1])->pluck('libelle_menu','id_menu');
	}

	public static function AjouterMenuParDefaut(){
        
        if(self::count() == 0){
			
			$VariUser = "1";
            ///Ajouter l'accueil
            $addHome = new GiwuMenu();
            $addHome->controler = "";
            $addHome->libelle_menu = "Accueil";
            $addHome->architecture = "/";
            $addHome->menu_icon = "kt-menu__link-icon flaticon-home";
            $addHome->num_ordre = "1";
            $addHome->order_ss = "0";
            $addHome->route = "home";
            $addHome->titre_page = "Bienvenu à la page d'accueil";
            $addHome->topmenu_id = "0";
            $addHome->elmt_menu = "oui";
            $addHome->user_id = $VariUser;
            $addHome->save();
            
            ///Ajouter l'administrateur
            $addAdm = new GiwuMenu();
            $addAdm->controler = "";
            $addAdm->libelle_menu = "Administrations";
            $addAdm->architecture = "/admin";
            $addAdm->menu_icon = "kt-menu__link-icon flaticon-settings";
            $addAdm->num_ordre = "2";
            $addAdm->order_ss = "0";
            $addAdm->route = "";
            $addAdm->titre_page = "Bienvenu à la page d'administrateur";
            $addAdm->topmenu_id = "0";
            $addAdm->elmt_menu = "oui";
            $addAdm->user_id = $VariUser;
            $addAdm->save();
			
			///Ajouter le menu
			$addMenu = new GiwuMenu();
			$addMenu->controler = "GiwuMenuController";
			$addMenu->libelle_menu = "Menu";
			$addMenu->architecture = "/admin/menu";
			$addMenu->menu_icon = "kt-menu__link-icon flaticon-list-2";
			$addMenu->num_ordre = "1";
			$addMenu->order_ss = "2";
			$addMenu->route = "GiwuMenu";
			$addMenu->titre_page = "Liste des menus";
            $addMenu->topmenu_id = $addAdm->id_menu;
            $addMenu->elmt_menu = "oui";
			$addMenu->user_id = $VariUser;
			$addMenu->save();

            ///Ajouter le role
            $addAcces = new GiwuMenu();
            $addAcces->controler = "RoleController";
            $addAcces->libelle_menu = "Définir les rôles";
            $addAcces->architecture = "/admin/role";
            $addAcces->menu_icon = "kt-menu__link-icon flaticon-user";
            $addAcces->num_ordre = "2";
            $addAcces->order_ss = "0";
            $addAcces->route = "GiwuRole";
            $addAcces->titre_page = "Liste des rôles";
            $addAcces->topmenu_id = $addAdm->id_menu;
            $addAcces->elmt_menu = "oui";
            $addAcces->user_id = $VariUser;
            $addAcces->save();

            ///Ajouter l'utilisateur
            $addUse = new GiwuMenu();
            $addUse->controler = "PlaUserappController";
            $addUse->libelle_menu = "Utilisateurs";
            $addUse->architecture = "/admin/user";
            $addUse->menu_icon = "kt-menu__link-icon flaticon-users";
            $addUse->num_ordre = "3";
            $addUse->order_ss = "0";
            $addUse->route = "PlaUserapp";
            $addUse->titre_page = "Gestion des utilisateurs";
            $addUse->topmenu_id = $addAdm->id_menu;
            $addUse->elmt_menu = "oui";
            $addUse->user_id = $VariUser;
            $addUse->save();

            ///Ajouter la tracabilité
            $addTrace = new GiwuMenu();
            $addTrace->controler = "IndexController";
            $addTrace->libelle_menu = "Suivi des mouvements";
            $addTrace->architecture = "/admin/trace";
            $addTrace->menu_icon = "kt-menu__link-icon flaticon-contract";
            $addTrace->num_ordre = "4";
            $addTrace->order_ss = "0";
            $addTrace->route = "emptrace";
            $addTrace->titre_page = "Suivi des mouvements";
            $addTrace->topmenu_id = $addAdm->id_menu;
            $addTrace->elmt_menu = "oui";
            $addTrace->user_id = $VariUser;
            $addTrace->save();
            
            ///Ajouter de l'aide
            $addAide = new GiwuMenu();
            $addAide->controler = "";
            $addAide->libelle_menu = "Aide";
            $addAide->architecture = "/aide";
            $addAide->menu_icon = "kt-menu__link-icon flaticon2-information";
            $addAide->num_ordre = "3";
            $addAide->order_ss = "0";
            $addAide->route = "";
            $addAide->titre_page = "Aide sur l'application";
            $addAide->topmenu_id = "0";
            $addAide->elmt_menu = "oui";
            $addAide->user_id = $VariUser;
            $addAide->save();
            
            ///Ajouter une manuelle d'utilisation
            $addManu = new GiwuMenu();
            $addManu->controler = "";
            $addManu->libelle_menu = "Manuel d'utilisation";
            $addManu->architecture = "/aide/manuel";
            $addManu->menu_icon = "kt-menu__link-icon flaticon-book";
            $addManu->num_ordre = "1";
            $addManu->order_ss = "0";
            $addManu->route = "manuel";
            $addManu->titre_page = "Manuel d'utilisation";
            $addManu->topmenu_id = $addAide->id_menu;
            $addManu->elmt_menu = "oui";
            $addManu->user_id = $VariUser;
            $addManu->save();
            
            ///Les profiles users
            $addProfi = new GiwuMenu();
            $addProfi->controler = "";
            $addProfi->libelle_menu = "Détails profil";
            $addProfi->architecture = "/profil";
            $addProfi->menu_icon = "kt-menu__link-icon flaticon-user";
            $addProfi->num_ordre = "1";
            $addProfi->order_ss = "0";
            $addProfi->route = "myprofile";
            $addProfi->titre_page = "Mon profil";
            $addProfi->topmenu_id = 0;
            $addProfi->elmt_menu = "non";
            $addProfi->user_id = $VariUser;
            $addProfi->save();

            ///Ajouter un role par defaut 
            $addRole = new GiwuRole();
            $addRole->libelle_role = "Administrateur inputer";
            $addRole->user_save_id = $VariUser;
            $addRole->save();

            ///Ajouter les acces au role par defaut
            ///Accueil
            $add = new GiwuRoleAcces();
            $add->role_id = $addRole->id_role;
            $add->id_menu = $addHome->id_menu;
            $add->statut_role = 1;
            $add->save();
           
            //Administrateur
            $add = new GiwuRoleAcces();
            $add->role_id = $addRole->id_role;
            $add->id_menu = $addAdm->id_menu;
            $add->statut_role = 1;
            $add->save();
            //Utilisateur
            $add = new GiwuRoleAcces();
            $add->role_id = $addRole->id_role;
            $add->id_menu = $addUse->id_menu;
            $add->statut_role = 1;
            $add->save();
            //Tracabilite
            $add = new GiwuRoleAcces();
            $add->role_id = $addRole->id_role;
            $add->id_menu = $addTrace->id_menu;
            $add->statut_role = 1;
            $add->save();
            //Menu
            $add = new GiwuRoleAcces();
            $add->role_id = $addRole->id_role;
            $add->id_menu = $addMenu->id_menu;
            $add->statut_role = 1;
            $add->save();
            //Acces
            $add = new GiwuRoleAcces();
            $add->role_id = $addRole->id_role;
            $add->id_menu = $addAcces->id_menu;
            $add->statut_role = 1;
            $add->save();
            //Aide
            $add = new GiwuRoleAcces();
            $add->role_id = $addRole->id_role;
            $add->id_menu = $addAide->id_menu;
            $add->statut_role = 1;
            $add->save();
            //Manuel
            $add = new GiwuRoleAcces();
            $add->role_id = $addRole->id_role;
            $add->id_menu = $addManu->id_menu;
            $add->statut_role = 1;
            $add->save();
            
            //Action Ajouter Menu
            $addAct = new GiwuActionacces();
            $addAct->libelle_action = "Ajouter un menu";
            $addAct->dev_action = "add_menu";
            $addAct->id_menu = $addMenu->id_menu;
            $addAct->save();
            $addActMenu = new GiwuActionmenuacces();
            $addActMenu->statut_action = 1;
            $addActMenu->action_id = $addAct->id_action;
            $addActMenu->id_menu = $addMenu->id_menu;
            $addActMenu->role_id = $addRole->id_role;
            $addActMenu->save();
            //Action Modifier Menu
            $addAct = new GiwuActionacces();
            $addAct->libelle_action = "Modifier un menu";
            $addAct->dev_action = "update_menu";
            $addAct->id_menu = $addMenu->id_menu;
            $addAct->save();
            $addActMenu = new GiwuActionmenuacces();
            $addActMenu->statut_action = 1;
            $addActMenu->action_id = $addAct->id_action;
            $addActMenu->id_menu = $addMenu->id_menu;
            $addActMenu->role_id = $addRole->id_role;
            $addActMenu->save();
            //Action Supprimer Menu
            $addAct = new GiwuActionacces();
            $addAct->libelle_action = "Supprimer un menu";
            $addAct->dev_action = "delete_menu";
            $addAct->id_menu = $addMenu->id_menu;
            $addAct->save();
            $addActMenu = new GiwuActionmenuacces();
            $addActMenu->statut_action = 1;
            $addActMenu->action_id = $addAct->id_action;
            $addActMenu->id_menu = $addMenu->id_menu;
            $addActMenu->role_id = $addRole->id_role;
            $addActMenu->save();
            //Action Ajouter une action
            $addAct = new GiwuActionacces();
            $addAct->libelle_action = "Ajouter une action";
            $addAct->dev_action = "add_action";
            $addAct->id_menu = $addMenu->id_menu;
            $addAct->save();
            $addActMenu = new GiwuActionmenuacces();
            $addActMenu->statut_action = 1;
            $addActMenu->action_id = $addAct->id_action;
            $addActMenu->id_menu = $addMenu->id_menu;
            $addActMenu->role_id = $addRole->id_role;
            $addActMenu->save();
            //Action Supprimer action
            $addAct = new GiwuActionacces();
            $addAct->libelle_action = "Supprimer une action";
            $addAct->dev_action = "delete_action";
            $addAct->id_menu = $addMenu->id_menu;
            $addAct->save();
            $addActMenu = new GiwuActionmenuacces();
            $addActMenu->statut_action = 1;
            $addActMenu->action_id = $addAct->id_action;
            $addActMenu->id_menu = $addMenu->id_menu;
            $addActMenu->role_id = $addRole->id_role;
            $addActMenu->save();
            //Action Ajouter role
            $addAct = new GiwuActionacces();
            $addAct->libelle_action = "Ajouter un rôle";
            $addAct->dev_action = "add_role";
            $addAct->id_menu = $addAcces->id_menu;
            $addAct->save();
            $addActMenu = new GiwuActionmenuacces();
            $addActMenu->statut_action = 1;
            $addActMenu->action_id = $addAct->id_action;
            $addActMenu->id_menu = $addAcces->id_menu;
            $addActMenu->role_id = $addRole->id_role;
            $addActMenu->save();
            //Action Modifier role
            $addAct = new GiwuActionacces();
            $addAct->libelle_action = "Modifier un rôle";
            $addAct->dev_action = "update_role";
            $addAct->id_menu = $addAcces->id_menu;
            $addAct->save();
            $addActMenu = new GiwuActionmenuacces();
            $addActMenu->statut_action = 1;
            $addActMenu->action_id = $addAct->id_action;
            $addActMenu->id_menu = $addAcces->id_menu;
            $addActMenu->role_id = $addRole->id_role;
            $addActMenu->save();
            //Action Supprimer role
            $addAct = new GiwuActionacces();
            $addAct->libelle_action = "Supprimer un rôle";
            $addAct->dev_action = "delete_role";
            $addAct->id_menu = $addAcces->id_menu;
            $addAct->save();
            $addActMenu = new GiwuActionmenuacces();
            $addActMenu->statut_action = 1;
            $addActMenu->action_id = $addAct->id_action;
            $addActMenu->id_menu = $addAcces->id_menu;
            $addActMenu->role_id = $addRole->id_role;
            $addActMenu->save();
            //Action Ajouter utilisateur
            $addAct = new GiwuActionacces();
            $addAct->libelle_action = "Ajouter un utilisateur";
            $addAct->dev_action = "add_user";
            $addAct->id_menu = $addUse->id_menu;
            $addAct->save();
            $addActMenu = new GiwuActionmenuacces();
            $addActMenu->statut_action = 1;
            $addActMenu->action_id = $addAct->id_action;
            $addActMenu->id_menu = $addUse->id_menu;
            $addActMenu->role_id = $addRole->id_role;
            $addActMenu->save();
            //Action Modifier role
            $addAct = new GiwuActionacces();
            $addAct->libelle_action = "Modifier un utilisateur";
            $addAct->dev_action = "update_user";
            $addAct->id_menu = $addUse->id_menu;
            $addAct->save();
            $addActMenu = new GiwuActionmenuacces();
            $addActMenu->statut_action = 1;
            $addActMenu->action_id = $addAct->id_action;
            $addActMenu->id_menu = $addUse->id_menu;
            $addActMenu->role_id = $addRole->id_role;
            $addActMenu->save();
            //Action Supprimer role
            $addAct = new GiwuActionacces();
            $addAct->libelle_action = "Supprimer un utilisateur";
            $addAct->dev_action = "delete_user";
            $addAct->id_menu = $addUse->id_menu;
            $addAct->save();
            $addActMenu = new GiwuActionmenuacces();
            $addActMenu->statut_action = 1;
            $addActMenu->action_id = $addAct->id_action;
            $addActMenu->id_menu = $addUse->id_menu;
            $addActMenu->role_id = $addRole->id_role;
            $addActMenu->save();
            //Action reinitialiser role
            $addAct = new GiwuActionacces();
            $addAct->libelle_action = "Réinitialiser un mot de passe";
            $addAct->dev_action = "reinitialiser_mdp";
            $addAct->id_menu = $addUse->id_menu;
            $addAct->save();
            $addActMenu = new GiwuActionmenuacces();
            $addActMenu->statut_action = 1;
            $addActMenu->action_id = $addAct->id_action;
            $addActMenu->id_menu = $addUse->id_menu;
            $addActMenu->role_id = $addRole->id_role;
            $addActMenu->save();

            //Action Menu Ajouter
            
        }
	}
	
	public static function getListMenuSearch(Request $req){

		$query = self::orderBy('created_at','desc')->whereNotIn('id_menu',[1]);
		$recherche = $req->get('query');
		if(isset($recherche)){
			$query->where('libelle_menu','like','%'.strtoupper(trim($recherche).'%'));
			$query->orwhere('route','like','%'.strtoupper(trim($recherche).'%'));
			$query->orwhere('titre_page','like','%'.strtoupper(trim($recherche).'%'));
			$query->orwhere('controler','like','%'.strtoupper(trim($recherche).'%'));
		}
		return $query;
	}

	public static function getSltGiwuMenu(){
        return self::all()->whereNotIn('id_menu',[1])->pluck('libelle_menu','id_menu');
	}

	public static function getSltGiwuMenuSaufEncours($MenuEncours){
        //1 : Accueil
        return self::all()
                        ->whereNotIn('id_menu',[$MenuEncours])
                        ->whereNotIn('id_menu',[1])
                        ->pluck('libelle_menu','id_menu');
	}

}
