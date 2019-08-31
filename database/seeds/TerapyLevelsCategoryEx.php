<?php

use Illuminate\Database\Seeder;

class TerapyLevelsCategoryEx extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $now = \Carbon\Carbon::now();
        $terapias = [
            
            	[1,'Psicodinámica'],
      				[2,'Cognitivo'],
      				[3,'Conductual'],
      				[4,'Cognitivo-Conductual'],
      				[5,'Humanista'],
      				[6,'Gestalt'],
      				[7,'Sitématica'],
      				[8,'Mindfulness'],

        ];
        $terapias = array_map(function($terapia) use ($now) {
           return [
               'id' => $terapia[0],
               'name' => $terapia[1],
               'updated_at' => $now,
               'created_at' => $now,
           ];
        }, $terapias);
        DB::table('terapies')->insert($terapias);


        $now = \Carbon\Carbon::now();
        $levels = [
            
            	[1,'Pesimo'],
      				[2,'Malo'],
      				[3,'Neutral'],
      				[4,'Bueno'],
      				[5,'Excelente'],

        ];
        $levels = array_map(function($level) use ($now) {
           return [
               'id' => $level[0],
               'name' => $level[1],
               'updated_at' => $now,
               'created_at' => $now,
           ];
        }, $levels);
        DB::table('levels')->insert($levels);


      
        $now = \Carbon\Carbon::now();
        $derivadodes = [
            
              [1,'CESFAM'],
              [2,'CECOSF'],
              [3,'COSAM'],
              [4,'CSU'],
              [5,'CSR'],
              [6,'CGU'],
              [7,'CGR'],
              [8,'CCR'],
              [9,'CAE'],

        ];
        $derivadodes = array_map(function($derivadode) use ($now) {
           return [
               'id' => $derivadode[0],
               'name' => $derivadode[1],
               'updated_at' => $now,
               'created_at' => $now,
           ];
        }, $derivadodes);
        DB::table('derivados')->insert($derivadodes);


        $now = \Carbon\Carbon::now();
        $sexualorientations = [
            
              [1,'Heterosexual'],
              [2,'Lesbiana'],
              [3,'Gay'],
              [4,'Bisexual'],
              [5,'Transexual'],
              [6,'Intersexual'],
        ];
        $sexualorientations = array_map(function($sexualorientation) use ($now) {
           return [
               'id' => $sexualorientation[0],
               'name' => $sexualorientation[1],
               'updated_at' => $now,
               'created_at' => $now,
           ];
        }, $sexualorientations);
        DB::table('sexual_orientations')->insert($sexualorientations);



        $now = \Carbon\Carbon::now();
        $civilstates = [
            
              [1,'Casado'],
              [2,'Soltero'],
              [3,'Divorciado'],
              [4,'Viudo'],

        ];
        $civilstates = array_map(function($civilstate) use ($now) {
           return [
               'id' => $civilstate[0],
               'name' => $civilstate[1],
               'updated_at' => $now,
               'created_at' => $now,
           ];
        }, $civilstates);
        DB::table('civil_states')->insert($civilstates);


        $now = \Carbon\Carbon::now();
        $asistencias = [
            
              [1,'Ausente'],
              [2,'Presente'],
              [3,'Proxima'],
              [4,'Cancelada'],

        ];
        $asistencias = array_map(function($asistencia) use ($now) {
           return [
               'id' => $asistencia[0],
               'name' => $asistencia[1],
               'updated_at' => $now,
               'created_at' => $now,
           ];
        }, $asistencias);
        DB::table('asistences')->insert($asistencias);

        factory(App\Session::class,20)->create();
        factory(App\Observation::class,300)->create();
    }
}
