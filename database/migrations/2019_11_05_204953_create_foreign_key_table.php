<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //responsable
            Schema::table('responsable', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('restrict')
            ->onUpdate('restrict');
            $table->foreign('employe_id')->references('id')->on('employe')
            ->onDelete('restrict')
            ->onUpdate('restrict');
        });
        //employe_centre 
        Schema::table('employe_centre', function (Blueprint $table) {
            $table->foreign('centre_id')->references('id')->on('centre')
            ->onDelete('restrict')
            ->onUpdate('restrict');
            $table->foreign('employe_id')->references('id')->on('employe')
            ->onDelete('restrict')
            ->onUpdate('restrict');
        });
        //salaire
        Schema::table('salaire', function (Blueprint $table) {
            $table->foreign('employe_id')->references('id')->on('employe')
            ->onDelete('restrict')
            ->onUpdate('restrict');
        });
        //charges
        Schema::table('charges', function (Blueprint $table) {
            $table->foreign('centre_id')->references('id')->on('centre')
            ->onDelete('restrict')
            ->onUpdate('restrict');
        });

        //centre
        Schema::table('centre', function (Blueprint $table) {
        $table->foreign('responsable_id')->references('id')->on('responsable')
            ->onDelete('restrict')
            ->onUpdate('restrict');
        $table->foreign('ville_id')->references('id')->on('ville')
            ->onDelete('restrict')
            ->onUpdate('restrict');
        });

        //ville
        Schema::table('ville', function (Blueprint $table) {
            $table->foreign('pays_id')->references('id')->on('pays')
            ->onDelete('restrict')
            ->onUpdate('restrict');
            $table->timestamps();
        });
        //produits annexes
        Schema::table('produits_annexe', function (Blueprint $table) {
            $table->foreign('centre_id')->references('id')->on('centre')
            ->onDelete('restrict')
            ->onUpdate('restrict');
            
        });
        //activites
        Schema::table('activites', function (Blueprint $table) {
            $table->foreign('centre_id')->references('id')->on('centre')
            ->onDelete('restrict')
            ->onUpdate('restrict');
            $table->foreign('calendrie_id')->references('id')->on('calendrie')
            ->onDelete('restrict')
            ->onUpdate('restrict');
        });

        //prof
        Schema::table('professeur', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('restrict')
            ->onUpdate('restrict');   
            $table->foreign('employe_id')->references('id')->on('employe')
            ->onDelete('restrict')
            ->onUpdate('restrict');                       
        });
       //diplome
        Schema::table('diplome', function (Blueprint $table) {
            $table->foreign('prof_id')->references('id')->on('professeur')
            ->onDelete('restrict')
            ->onUpdate('restrict');
        });
        //emplois du temps
        Schema::table('emplois_temps', function (Blueprint $table) {
            $table->foreign('prof_id')->references('id')->on('professeur')
            ->onDelete('restrict')
            ->onUpdate('restrict');
            $table->foreign('jour_id')->references('id')->on('jours')
            ->onDelete('restrict')
            ->onUpdate('restrict');   
            $table->foreign('trimestre_id')->references('id')->on('trimestre')
            ->onDelete('restrict')
            ->onUpdate('restrict');   
            $table->foreign('salle_id')->references('id')->on('salle')
            ->onDelete('restrict')
            ->onUpdate('restrict');  
            $table->foreign('groupe_id')->references('id')->on('groupe')
            ->onDelete('restrict')
            ->onUpdate('restrict');  
            $table->foreign('module_id')->references('id')->on('module')
            ->onDelete('restrict')
            ->onUpdate('restrict');  
            $table->foreign('centre_id')->references('id')->on('centre')
            ->onDelete('restrict')
            ->onUpdate('restrict');                      
        });
        // absences 
         Schema::table('absences', function (Blueprint $table) {
            $table->foreign('employe_id')->references('id')->on('employe')
            ->onDelete('restrict')
            ->onUpdate('restrict');
            $table->foreign('eleve_id')->references('id')->on('eleve')
            ->onDelete('restrict')
            ->onUpdate('restrict');
        });

        // remplaçants 
         Schema::table('remplacants_prof', function (Blueprint $table) {
            $table->foreign('prof_id')->references('id')->on('professeur')
            ->onDelete('restrict')
            ->onUpdate('restrict');
            $table->foreign('remplacant_id')->references('id')->on('professeur')
            ->onDelete('restrict')
            ->onUpdate('restrict');
        });
        // groupe 
         Schema::table('groupe', function (Blueprint $table) {
            $table->foreign('niveau_id')->references('id')->on('niveau')
            ->onDelete('restrict')
            ->onUpdate('restrict');
            $table->foreign('centre_id')->references('id')->on('centre')
            ->onDelete('restrict')
            ->onUpdate('restrict');
        });
        // trimestre 
        // examens
         Schema::table('examen', function (Blueprint $table) {
            $table->foreign('eleve_id')->references('id')->on('eleve')
            ->onDelete('restrict')
            ->onUpdate('restrict');
            $table->foreign('module_id')->references('id')->on('module')
            ->onDelete('restrict')
            ->onUpdate('restrict');
        });


        // paiement
         Schema::table('paiement', function (Blueprint $table) {
            $table->foreign('eleve_id')->references('id')->on('eleve')
            ->onDelete('restrict')
            ->onUpdate('restrict');
            $table->foreign('niveau_id')->references('id')->on('niveau')
            ->onDelete('restrict')
            ->onUpdate('restrict');
        });

        // niveau

        // fourniture
         Schema::table('fourniture', function (Blueprint $table) {
            $table->foreign('eleve_id')->references('id')->on('eleve')
            ->onDelete('restrict')
            ->onUpdate('restrict');
            $table->foreign('module_id')->references('id')->on('module')
            ->onDelete('restrict')
            ->onUpdate('restrict');
        });
        // responsable_commerciale
         Schema::table('responsable_commerciale_interne', function (Blueprint $table) {
            $table->foreign('employe_id')->references('id')->on('employe')
            ->onDelete('restrict')
            ->onUpdate('restrict');
            $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('restrict')
            ->onUpdate('restrict');

        });
        // responsable_technique
         Schema::table('responsable_technique', function (Blueprint $table) {
            $table->foreign('employe_id')->references('id')->on('employe')
            ->onDelete('restrict')
            ->onUpdate('restrict');
            $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('restrict')
            ->onUpdate('restrict');

        });
        // salaire_responsable_commerciale_interne
         Schema::table('salaire_commerciale', function (Blueprint $table) {
            $table->foreign('responsable_interne_id')->references('id')->on('responsable_commerciale_interne')
            ->onDelete('restrict')
            ->onUpdate('restrict');
        });
        // salaire_responsable_commerciale_externe
         Schema::table('salaire_commerciale_externe', function (Blueprint $table) {
            $table->foreign('responsable_externe_id')->references('id')->on('responsable_commerciale_externe')
            ->onDelete('restrict')
            ->onUpdate('restrict');
        });
        // salaire_prof
         Schema::table('salaire_prof', function (Blueprint $table) {
            $table->foreign('prof_id')->references('id')->on('professeur')
            ->onDelete('restrict')
            ->onUpdate('restrict');
        });
         //salle
        Schema::table('salle', function (Blueprint $table) {
            $table->foreign('centre_id')->references('id')->on('centre')
            ->onDelete('restrict')
            ->onUpdate('restrict');
        });
        // eleve_parents
         Schema::table('eleve_parents', function (Blueprint $table) {
            $table->foreign('eleve_id')->references('id')->on('eleve')
            ->onDelete('restrict')
            ->onUpdate('restrict');
            $table->foreign('parents_id')->references('id')->on('parents')
            ->onDelete('restrict')
            ->onUpdate('restrict');

        });
        // eleve
         Schema::table('eleve', function (Blueprint $table) {
            $table->foreign('centre_id')->references('id')->on('centre')
            ->onDelete('restrict')
            ->onUpdate('restrict');
            $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('restrict')
            ->onUpdate('restrict');
            $table->foreign('responsable_commerciale_interne_id')->references('id')->on('responsable_commerciale_interne')
            ->onDelete('restrict')
            ->onUpdate('restrict');
            $table->foreign('responsable_commerciale_externe_id')->references('id')->on('responsable_commerciale_interne')
            ->onDelete('restrict')
            ->onUpdate('restrict');
            $table->foreign('groupe_id')->references('id')->on('groupe')
            ->onDelete('restrict')
            ->onUpdate('restrict');

        });
        // message
         Schema::table('message', function (Blueprint $table) {
            $table->foreign('from_user')->references('id')->on('users')
            ->onDelete('restrict')
            ->onUpdate('restrict');
            $table->foreign('to_user')->references('id')->on('users')
            ->onDelete('restrict')
            ->onUpdate('restrict');

        });
        // contenu
         Schema::table('contenu', function (Blueprint $table) {
            $table->foreign('from_user')->references('id')->on('users')
            ->onDelete('restrict')
            ->onUpdate('restrict');
            $table->foreign('message_id')->references('id')->on('message')
            ->onDelete('restrict')
            ->onUpdate('restrict');

        });

        //transfert
         Schema::table('transfert', function (Blueprint $table) {
            $table->foreign('eleve_id')->references('id')->on('groupe')
            ->onDelete('restrict')
            ->onUpdate('restrict');
            $table->foreign('centre_id')->references('id')->on('centre')
            ->onDelete('restrict')
            ->onUpdate('restrict');

        }); 
        //centre niveau
      Schema::table('centre_niveau', function (Blueprint $table) {
            $table->foreign('centre_id')->references('id')->on('centre')
            ->onDelete('restrict')
            ->onUpdate('restrict');
            $table->foreign('niveau_id')->references('id')->on('niveau')
            ->onDelete('restrict')
            ->onUpdate('restrict');
        }); 
        // Niveau module
         Schema::table('niveau_module', function (Blueprint $table) {
            $table->foreign('module_id')->references('id')->on('module')
            ->onDelete('restrict')
            ->onUpdate('restrict');
            $table->foreign('niveau_id')->references('id')->on('niveau')
            ->onDelete('restrict')
            ->onUpdate('restrict');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //centre
        Schema::table('centre', function(Blueprint $table) {
            $table->dropForeign('centre_user_id_foreign');
            $table->dropForeign('centre_ville_id_foreign');
        });
        //ville
        Schema::table('ville', function(Blueprint $table) {
             $table->dropForeign('ville_pays_id_foreign');
        });
        //produits_annexe
        Schema::table('produits_annexe', function(Blueprint $table) {
             $table->dropForeign('produits_annexe_centre_id_foreign');
        });
        //activites
        Schema::table('activites', function(Blueprint $table) {
             $table->dropForeign('activites_centre_id_foreign');
             $table->dropForeign('activites_calendrie_id_foreign');
        });
        //responsable
        Schema::table('responsable', function(Blueprint $table) {
             $table->dropForeign('responsable_user_id_foreign');
             $table->dropForeign('responsable_employe_id_foreign');
        });
        //employe
        Schema::table('employe_centre', function(Blueprint $table) {
             $table->dropForeign('employe_centre_employe_id_foreign');
        });
        Schema::table('employe_centre', function(Blueprint $table) {
             $table->dropForeign('employe_centre_centre_id_foreign');
        });
        //salaire
        Schema::table('salaire', function(Blueprint $table) {
             $table->dropForeign('salaire_employe_id_foreign');
        });
        //charges
        Schema::table('charges', function(Blueprint $table) {
             $table->dropForeign('charges_centre_id_foreign');
        });
        //prof
        Schema::table('centre', function(Blueprint $table) {
            $table->dropForeign('centre_user_id_foreign');
            $table->dropForeign('user_id_foreign');
            $table->dropForeign('employe_id_foreign');
            $table->dropForeign('salaire_prof_id_foreign');
        });
        //diplome
        Schema::table('diplome', function(Blueprint $table) {
             $table->dropForeign('diplome_prof_id_foreign');
        });


        // absences 
        Schema::table('absences', function(Blueprint $table) {
            $table->dropForeign('absences_employe_id_foreign');
            $table->dropForeign('absences_eleve_id_foreign');
        });
        // remplaçants 
        Schema::table('remplacants_prof', function(Blueprint $table) {
            $table->dropForeign('remplaçants_prof_id_foreign');
            $table->dropForeign('remplaçants_remplacant_id_foreign');
        
        });
        // groupes 
        Schema::table('groupe', function(Blueprint $table) {
            $table->dropForeign('groupe_niveau_id_foreign');
            $table->dropForeign('groupe_centre_id_foreign');
        
        });        

        // trimestre 

        // examens
        Schema::table('examen', function(Blueprint $table) {
            $table->dropForeign('examen_eleve_id_foreign');
            $table->dropForeign('examen_module_id_foreign');
        
        });
        // modules

        // paiement
        Schema::table('paiement', function(Blueprint $table) {
            $table->dropForeign('paiement_eleve_id_foreign');
            $table->dropForeign('paiement_niveau_id_foreign');
        });
        // frais_inscriptions

        // niveau
        Schema::table('niveau', function(Blueprint $table) {
            $table->dropForeign('niveau_centre_id_foreign');
        });
        // fourniture
        Schema::table('fourniture', function(Blueprint $table) {
            $table->dropForeign('fourniture_eleve_id_foreign');
            $table->dropForeign('fourniture_module_id_foreign');
        });
        // reponsable_commerciale 
        Schema::table('responsable_commerciale_interne', function(Blueprint $table) {
            $table->dropForeign('responsable_commerciale_interne_employe_id_foreign');
            $table->dropForeign('responsable_commerciale_interne_user_id_foreign');
        });
        // salaire_prof 
        Schema::table('salaire_prof', function(Blueprint $table) {
            $table->dropForeign('salaire_prof_prof_id_foreign');
        });
        // salaire_reponsable_commerciale 
        Schema::table('salaire_commerciale', function(Blueprint $table) {
            $table->dropForeign('salaire_commerciale_interne_responsable_interne_id_foreign');
        });
        // salaire_reponsable_commerciale_externe
        Schema::table('salaire_commerciale_externe', function(Blueprint $table) {
            $table->dropForeign('salaire_commerciale_externe_responsable_externe_id_foreign');
        });
        // reponsable_technique
        Schema::table('responsable_technique', function(Blueprint $table) {
            $table->dropForeign('responsable_technique_employe_id_foreign');
            $table->dropForeign('responsable_technique_user_id_foreign');
        });
        //eleve
        Schema::table('eleve', function(Blueprint $table) {
            $table->dropForeign('eleve_centre_id_foreign');
            $table->dropForeign('eleve_user_id_foreign');
            $table->dropForeign('eleve_commerciale_interne_id_foreign');
            $table->dropForeign('eleve_commerciale_externe_id_foreign');
            $table->dropForeign('eleve_groupe_id_foreign');
        });        
        // eleve_parents
        Schema::table('eleve_parents', function(Blueprint $table) {
            $table->dropForeign('eleve_parents_eleve_id_foreign');
            $table->dropForeign('eleve_parents_parents_id_foreign');
        });
        // message
        Schema::table('message', function(Blueprint $table) {
            $table->dropForeign('message_from_user_foreign');
            $table->dropForeign('message_to_user_foreign');
        });
        // contenu
        Schema::table('contenu', function(Blueprint $table) {
            $table->dropForeign('contenu_from_user_foreign');
            $table->dropForeign('contenu_message_id_foreign');
        });
        // emplois du temps
        Schema::table('emplois_temps', function(Blueprint $table) {
            $table->dropForeign('emplois_temps_trimestre_id_foreign');
            $table->dropForeign('emplois_temps_prof_id_foreign');
            $table->dropForeign('emplois_temps_salle_id_foreign');
            $table->dropForeign('emplois_temps_jour_id_foreign');
            $table->dropForeign('emplois_temps_centre_id_foreign');
            $table->dropForeign('emplois_temps_module_id_foreign');
            $table->dropForeign('emplois_temps_groupe_id_foreign');
        });
        //groupe_trimestre

        //transfert
        Schema::table('transfert', function(Blueprint $table) {
            $table->dropForeign('transfert_eleve_id_foreign');
            $table->dropForeign('transfert_centre_id_foreign');
        });
        // niveau module
        Schema::table('niveau_module', function(Blueprint $table) {
            $table->dropForeign('niveau_module_module_id_foreign');
            $table->dropForeign('niveau_module_niveau_id_foreign');
        });
        // salle
        Schema::table('salle', function(Blueprint $table) {
            $table->dropForeign('salle_centre_id_foreign');
        });

        }
}
