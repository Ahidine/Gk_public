<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//page de Bienvenu 
Route::get('/', function () {
  return view('auth.login');
})->name('welcome');

Route::get('/Bloquer', function () {
  return view('errors.Bloque');
});




Route::group(['middleware'=>'auth'],function()
{
    // dispatching 
    
  Route::get('/home',function()
  { 
  //return Auth::user()->getRoleNames()->first();

    if (Auth::user()->IsBlocked==1) {
     return view('errors.Bloque');
    }
    else{
          switch (Auth::user()->getRoleNames()->first()) {
      case 'Super_Admin':
      return redirect('Admin/home');
      break;  
      case 'Responsable':
      return redirect('Responsable/home');
      break;
      case 'Responsable_Commerciale':
      return redirect('Responsable_Commercial/home');
      break;
      case 'Eleve':
      return redirect('Student/home');
      break;
      case 'Professeur':
      return redirect('Professeur/home');
      break; 
      case 'Responsable_Pedagogique':
      return redirect('Responsable_Pedagogique/home');
      break;           
      default:
      return Auth::user()->getRoleNames()->first();
      break;
    }
    }

  });

  ######################## Admin  ###############################
  Route::group(['middleware' => ['role:Super_Admin']], function ()
  {

    Route::get('Admin/home', 'AdminController@index');
    Route::resource('Admin', 'AdminController');


    // Centre Routes
      Route::resource('centre', 'CentreController'); // crud centre
      Route::get('getVilles/{id}','CentreController@getVilles');
      Route::get('getCentresId/{id}','NiveauController@getCentresId');
      Route::get('getAllCentres','CentreController@getAllCentres');
      Route::get('getPays','CentreController@getPays');
      Route::get('getCentresByVille/{id}','CentreController@getCentresByVille');
      Route::get('getCentres/{id}','CentreController@getCentres');



      // Niveau Routes
      Route::resource('Niveau', 'NiveauController'); // crud niveau
      Route::get('putSessionNiveau/{niveau}/{centre}','NiveauController@HelperPutNiveau');
      Route::get('getSessionNiveau','NiveauController@HelperGetNiveau');
      Route::get('getNiveau/{id}','NiveauController@getNiveauByID');


      //Groupe Routes
      Route::resource('Groupe', 'GroupeController'); // crud groupe
      Route::get('Eleve/groupes/{id}','GroupeController@GetGroupe');
      Route::get('getGroupe/{id}','GroupeController@getGroupeByID');
      Route::get('getGroupeByThowID/{id_centre}/{id_niveau}','GroupeController@getGroupeByThowID');
      Route::get('getGroupeByThowIdWithCounting/{centre}/{group}','GroupeController@getGroupeByThowIdWithCounting');
      Route::get('getGroupeByThowID/{id_centre}/{id_niveau}','GroupeController@getGroupeByThowID');
      Route::get('calcateDate/{date}/{days}','GroupeController@calculeDate');
      Route::get('getPlanningByGroupe/{id}','GroupeController@getPlanningByGroupe');

      
      //Module Routes
      Route::resource('Module', 'ModuleController'); // crud module
      Route::get('getModulesByGroupe/{groupe}','ModuleController@getModulesByGroupe');
      Route::get('getAllModules','ModuleController@getAllModules');



      //Eleve Routes
      Route::resource('Eleve','EleveController')->except(['index']);
      Route::get('Eleve_pre-inscrit','EleveController@eleve_preInsc_data')->name('Eleve.PreIns');
      Route::get('ListeInscrits','EleveController@ListeInscrits')->name('Eleve.ListeInsc');
      Route::get('getInfo/{id}','EleveController@getInfo');
      Route::get('getNiveau','EleveController@getNiveau');
      Route::get('getPaiementByYear/{id}/{year}','EleveController@getPaiementByYear');
      Route::get('Add_PreInscit','EleveController@AddPreInsc')->name('Eleve.Preinsciptions');
      Route::post('Add','EleveController@StorePreInsc')->name('PreInsc.store');
      Route::get('Eleves/Liste_Absences','EleveController@ListeAbsences')->name('Eleves.Absences');;
      Route::get('getListeByCentre/{id}','EleveController@getListeByCentre');
      Route::get('getAbsenceStudent/{id}','EleveController@getAbsenceStudent');
      Route::post('AddAbsenceStudent/{id}','EleveController@AddAbsenceStudent');
      Route::get('getAbsenceStudent/{id}/{year}/{month}','EleveController@getAbsenceStudentByYearByMonth');
   // Route::post('AddAbsenceStudent/{id}','EleveController@AddAbsenceStudent');


      //Employer Routes
      Route::resource('Employe','EmployeController');
      Route::get('getAllEmployes','EmployeController@getAllEmployes');
      Route::get('Employe/getSalaire/{id}','EmployeController@getSalaire');
      Route::get('Employe/getSalaireByYear/{id}/{year}','EmployeController@getSalaireByYear');
      Route::get('Employe/getAbsences/{id}','EmployeController@getAbsences');
      Route::get('Employe/getAbsencesByYear/{id}/{year}','EmployeController@getAbsencesByYear');
      Route::post('Employe/makeAbsence/{id}','EmployeController@makeAbsence');
      Route::get('ListePrAbsences','EmployeController@ListePrAbsences')->name('ListePrAbsences');
      Route::get('Employe/getListeByCentre/{id}','EmployeController@getListeByCentre');
      Route::get('Employe/getAbsencesEmploye/{id}','EmployeController@getAbsencesEmploye');
      Route::get('Employe/getAbsencesEmploye/{id}/{year}/{month}','EmployeController@getAbsenceWorkerByYearMonth');
      Route::get('Employe/getFile/{cv}','EmployeController@getFile');



      //Professeur Routes
      Route::resource('Prof','ProfController');
      Route::get('Prof/getSalaire/{id}','ProfController@getSalaire');
      Route::get('Prof/getSalaireByYear/{id}/{year}','ProfController@getSalaireByYear');
      Route::get('getAllProf','ProfController@getAllProf');



      //Trimestre Routes
      Route::resource('Trimestre','TrimestreController');
      Route::get('getAllTrimestre','TrimestreController@getAllTrimestre');
      Route::get('getTrimestreById/{id}','TrimestreController@getTrimestreById');

      


      //Admin Routes
      Route::get('getProfUser','AdminController@getProfUser');
      Route::post('AddUser','AdminController@AddUser');
      Route::get('getRCUser','AdminController@getRCUser');
      Route::get('getRPUser','AdminController@getRPUser');
      Route::get('getEleveUser','AdminController@getEleveUser');
      Route::get('BloqueUser/{id}','AdminController@BloqueUser');
      Route::get('DeBloqueUser/{id}','AdminController@DeBloqueUser');


      
      // Emplois Du temps Routes
      Route::get('getEmploisTempsByGroupe/{id}','EmploisTempsController@getEmploisTempsByGroupe');
      Route::get('Emplois_Temps','EmploisTempsController@getEmploisByGroupe')->name('Emplois_Temps');
      Route::get('getGroupeByCentre/{id}','EmploisTempsController@getGroupeByCentre');
      Route::get('create_Emplois_Temps','EmploisTempsController@createEmplois')->name('Emplois.create');
      Route::post('EmploieStore','EmploisTempsController@EmploieCreate')->name('Emplois.store');
      Route::get('getEmploisByTrimestreByGroupe/{t}/{g}','EmploisTempsController@getEmploisByTrimestreByGroupe');
      Route::get('getEmploisByProf/{p}','EmploisTempsController@getEmploisByProf');
      Route::get('getEmploisByTrimestreByProf/{t}/{p}','EmploisTempsController@getEmploisByTrimestreByProf');
      Route::get('getEmploisByModule/{m}','EmploisTempsController@getEmploisByModule');
      Route::get('getEmploisByTrimestreByModule/{t}/{m}','EmploisTempsController@getEmploisByTrimestreByModule');
      Route::get('getEmploisByCentre/{c}','EmploisTempsController@getEmploisByCentre');
      Route::get('getEmploisByTrimestreByCentre/{t}/{c}','EmploisTempsController@getEmploisByTrimestreByCentre');


      // Pays Routes
       Route::resource('pays', 'PaysController');
      //Villes Routes
      Route::resource('ville', 'VilleController');
      Route::get('getVilleBelgique','VilleController@getBelgiqueVille');



      // Calendrier Routes
      Route::resource('events', 'CalendrieController');
      




    });

  ######################## Responsable Commercial  ###############################
Route::group(['middleware' => ['role:Responsable']], function ()
{

  Route::get('Responsable/home', 'Responsable@index');

});

  ######################## Responsable Technique  ##############################
Route::group(['middleware' => ['role:Responsable_Pedagogique']], function () 
{

  Route::get('Responsable_Pedagogique/home', 'Respo_tech@index');

});
  ############################## Eleve  ########################################
Route::group(['middleware' => ['role:Eleve']], function () 
{
  Route::resource('Eleve','EleveController')->only(['index']);
  Route::get('Student/home', 'EleveController@index');


});
  ######################## Professeur  ##########################################
Route::group(['middleware' => ['role:Professeur']], function () 
{
 Route::get('Professeur/home', 'Professeur@index');
});
  ######################## Responsable Commercial  ###############################
Route::group(['middleware' => ['role:Responsable_Commerciale']], function () 
{
  Route::get('Responsable_Commercial/home', 'Respo_Commercial@index');

});
});


Auth::routes(); 
/// routes les routes de la template
//Route::get('home', 'HomeController@index')->name('home');
//Route::get('dashboard', 'HomeController@index')->name('home');
Route::get('pricing', 'ExamplePagesController@pricing')->name('page.pricing');
Route::get('lock', 'ExamplePagesController@lock')->name('page.lock');
Route::get('error', ['as' => 'page.error', 'uses' => 'ExamplePagesController@error']);

Route::group(['middleware' => 'auth'], function () {
  Route::resource('category', 'CategoryController', ['except' => ['show']]);
  Route::resource('tag', 'TagController', ['except' => ['show']]);
  Route::resource('item', 'ItemController', ['except' => ['show']]);
  Route::resource('role', 'RoleController', ['except' => ['show', 'destroy']]);
  Route::resource('user', 'UserController', ['except' => ['show']]);

  Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
  Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
  Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

  Route::get('rtl-support', ['as' => 'page.rtl-support', 'uses' => 'ExamplePagesController@rtlSupport']);
  Route::get('timeline', ['as' => 'page.timeline', 'uses' => 'ExamplePagesController@timeline']);
  Route::get('widgets', ['as' => 'page.widgets', 'uses' => 'ExamplePagesController@widgets']);
  Route::get('charts', ['as' => 'page.charts', 'uses' => 'ExamplePagesController@charts']);
  Route::get('calendar', ['as' => 'page.calendar', 'uses' => 'ExamplePagesController@calendar']);

  Route::get('buttons', ['as' => 'page.buttons', 'uses' => 'ComponentPagesController@buttons']);
  Route::get('grid-system', ['as' => 'page.grid', 'uses' => 'ComponentPagesController@grid']);
  Route::get('panels', ['as' => 'page.panels', 'uses' => 'ComponentPagesController@panels']);
  Route::get('sweet-alert', ['as' => 'page.sweet-alert', 'uses' => 'ComponentPagesController@sweetAlert']);
  Route::get('notifications', ['as' => 'page.notifications', 'uses' => 'ComponentPagesController@notifications']);
  Route::get('icons', ['as' => 'page.icons', 'uses' => 'ComponentPagesController@icons']);
  Route::get('typography', ['as' => 'page.typography', 'uses' => 'ComponentPagesController@typography']);

  Route::get('regular-tables', ['as' => 'page.regular_tables', 'uses' => 'TablePagesController@regularTables']);
  Route::get('extended-tables', ['as' => 'page.extended_tables', 'uses' => 'TablePagesController@extendedTables']);
  Route::get('datatable-tables', ['as' => 'page.datatable_tables', 'uses' => 'TablePagesController@datatableTables']);

  Route::get('regular-form', ['as' => 'page.regular_forms', 'uses' => 'FormPagesController@regularForms']);
  Route::get('extended-form', ['as' => 'page.extended_forms', 'uses' => 'FormPagesController@extendedForms']);
  Route::get('validation-form', ['as' => 'page.validation_forms', 'uses' => 'FormPagesController@validationForms']);
  Route::get('wizard-form', ['as' => 'page.wizard_forms', 'uses' => 'FormPagesController@wizardForms']);

  Route::get('google-maps', ['as' => 'page.google_maps', 'uses' => 'MapPagesController@googleMaps']);
  Route::get('fullscreen-maps', ['as' => 'page.fullscreen_maps', 'uses' => 'MapPagesController@fullscreenMaps']);
  Route::get('vector-maps', ['as' => 'page.vector_maps', 'uses' => 'MapPagesController@vectorMaps']);
});