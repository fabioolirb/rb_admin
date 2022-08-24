<?php

namespace App\Repositories;

use App\Models\Attendance;
use App\Models\montagem;
use Carbon\Carbon;
use phpDocumentor\Reflection\Types\Integer;
use PhpParser\Node\Stmt\Foreach_;

/**
 * Class DashboardRepository
 * @package App\Repositories
 * @version July 26, 2021, 12:17 pm UTC
 */

class DashboardRepository
{
    /** @var  UserRepository */
    private $userRepository;
    /** @var  RoleRepository */
    private $roleRepository;
    /** @var  PermissionRepository */
    private $permissionRepository;
    /** @var  AttendanceRepository */
    private $attendanceRepository;
    /** @var  montagemRepository */
    private $montagemRepository;
    /** @var  producaoRepository */
    private $producaoRepository;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(RoleRepository $roleRepo, UserRepository $userRepo, PermissionRepository $permissionRepo, AttendanceRepository $attendanceRepo, montagemRepository $montagemRepo , producaoRepository $producaoRepo)
    {
        $this->permissionRepository = $permissionRepo;
        $this->userRepository = $userRepo;
        $this->roleRepository = $roleRepo;
        $this->attendanceRepository = $attendanceRepo;
        $this->montagemRepository =$montagemRepo;
        $this->producaoRepository =$producaoRepo;
    }

    private function getDashboardInfo()
    {
        $dashboardInfo = [];
        $dashboardInfo['user_count'] =  $this->userRepository->count();
        $dashboardInfo['role_count'] =  $this->roleRepository->count();
        $dashboardInfo['permission_count'] =  $this->permissionRepository->count();
        $dashboardInfo['user_online'] =  $this->attendanceRepository->CountUserOnline();
        return $dashboardInfo;
    }
    private function getChartUserCheckinInfo()
    {
        $labels = [];
        $dataset1 = [];
        $dataset1['label'] = 'Meu Diário';
        $dataset1['data'] = [];
        $dataset1['borderColor'] = 'rgb(75, 192, 192)';

        $data = $this->attendanceRepository->TotalCheckInByDay(auth()->user()->id);
        foreach ($data as $key => $value) {
            $newKey = Carbon::parse($key)->format('d/m/Y');
            $dataset1['data'][$newKey] = $value;
            $labels[$newKey] = $newKey;
        }

        $dataset2 = [];
        $dataset2['label'] = 'Diário do Usuário';
        $dataset2['data'] = [];
        $dataset2['borderColor'] = 'rgb(20, 150, 192)';

        $data = $this->attendanceRepository->TotalCheckInByDay();
        foreach ($data as $key => $value) {
            $newKey = Carbon::parse($key)->format('d/m/Y');
            $dataset2['data'][$newKey] = $value;
            $labels[$newKey] = $newKey;
        }

        $datasets = [];
        $datasets[] = $dataset1;
        $datasets[] = $dataset2;

        $data = [];
        $data['labels'] = array_values($labels);
        $data['datasets'] = $datasets;

        $chart = [];
        $chart['type'] = 'line';
        $chart['data'] = $data;
        //dd($chart);
        return $chart;
    }

   public function getTotalProducao(){

       $labels = [];
       $dataset = [];
       $dataset['label'] = 'Total de Produção Dia';
       $dataset['data'] = [];
       $dataset['borderColor'] = 'rgb(75, 192, 192)';
       $dataset['backgroundColor'] = 'rgba(255,155,0,1)';

       $data = $this->producaoRepository->getTotalProducao();

       foreach ($data as $key => $value) {
           $newKey = Carbon::parse($value->data_producao)->format('d/m/Y');
           $dataset['data'][$newKey] = (integer) $value->qtd_estoque;
           $labels[$newKey] = $newKey;
       }

       $data = [];
       $data['labels'] = array_values($labels);
       sort($data['labels']);
       $data['datasets'][] = $dataset;

       $chart = [];
       $chart['type'] = 'bar';
       $chart['data'] = $data;

       return $chart;

   }
    public function getTotalPecasMontagem(){

        $datasets =[];
        $dataset_aux = [];
        $dataset_aux['data'] = [];
        $labels = [];
        $data = $this->montagemRepository->getTotalMontagem();

        foreach ($data as $key => $value) {
            $newKey = Carbon::parse($value->data_envio)->format('d/m/Y');
            $dataset_aux['data'][$value->status_montagem_id][$newKey] = $value->qtd_itens;
            $dataset_aux['status'][$value->status_montagem_id] =$value->nome;
            $labels[$newKey] = $newKey;
        }

        $data = ['label'=>'','borderColor'=>'','data'=>[]];

        foreach ($dataset_aux['data'] as $key=> $value){

            $data['label'] = $dataset_aux['status'][$key];
            $data['borderColor'] = 'rgb('.(0).','.(80*$key).', '.(60*$key).')';

            Foreach($value as $key2=> $qtd ){
                $data['data'][$key2]=$qtd;
            }

            $datasets[] = $data;
            $data = ['label'=>'','borderColor'=>'','data'=>[]];
        }

        foreach ($datasets as $key=> $value){
            foreach ($labels  as  $value2){
                if(!array_key_exists($value2,$value['data']))
                       $datasets[$key]['data'][$value2]='0';
            }
            ksort($datasets[$key]['data']);
        }
        $data = [];
        $data['labels'] = array_values($labels);
        sort( $data['labels']);
       // dd($datasets, $data['labels']);
        $data['datasets'] = $datasets;

        $chart = [];
        $chart['type'] = 'line';
        $chart['data'] = $data;

        return $chart;

    }

    public function  getTotaProducaoSemana(){

        $semana= [0=>'Segunda',1=>'Terça',2=>'Quarta',3=>'Quinta',4=>'Sexta'];
        $data = $this->producaoRepository->getTotalProducaoSemana();
        $datasets = [];
        $data_aux = [];

        foreach ($data as $key=> $value) {
            $datasets[(integer) $value->nr_semana_producao]['borderColor'] = 'rgb(75,' . (1 * $key) . ', 192)';
            $datasets[(integer) $value->nr_semana_producao]['backgroundColor'] = 'rgba(250,' . (20 * $key) . ',0,5)';
            $datasets[(integer) $value->nr_semana_producao]['label'] = 'Primeira Semana';
            $datasets[(integer) $value->nr_semana_producao]['data'][(int) $value->semana_producao ] = $value->qtd_estoque ;
        }


      $cont =4;
        //ksort($datasets);
       // dd($datasets);
        foreach ($datasets as $key=>$value){
            foreach ($value['data'] as $key2=>$value2){

                foreach ($semana as $key3=>$value3) {
                    if ($key2 == $key3) {
                        $datasets[$key]['data'][$value3] = $value2;
                        unset($datasets[$key]['data'][$key3]);
                    }
                    //dd($key,$key2, $key3,$value2,$value3,$datasets[$key]['data'][$value3],$datasets[$key]);
                }


            }

            $datasets[$key]['label'] = $cont.'º Semana';
            $data_aux[]=$datasets[$key];
            $cont--;
            //
         //   ksort($datasets);

        }
       // dd($datasets,$value);
        $data = [];
        $data['datasets'] = $data_aux;
        $chart = [];
        $chart['type'] = 'bar';
        $chart['data'] = $data;

        return $chart;
    }

    public function getproducaoMaquina(){
        $data = $this->producaoRepository->getProducaoMaquina();
        $datasets = [];
        $dta_ini = false;
        $dta_fin = false;
        foreach ($data as $key=> $value) {
            $datasets['borderColor'] = 'rgb(' . (12 + $key) . ',' . (30 + $key) . ', 192)';
            $datasets['backgroundColor'] = 'rgba( '. (12 + $key) . ',' . (10 + $key) . ', 192,0,5)';
            $dta_ini = empty($dta_ini) ? Carbon::parse($value->dta_producao)->format('d/m/Y') :$dta_ini ;
            $dta_fin = Carbon::parse($value->data_producao)->format('d/m/Y');

            if(empty($datasets['data'][$value->nome_maquina])){Q:
                $datasets['data'][$value->nome_maquina] = (int) $value->qtd_estoque;
            }else {
                $datasets['data'][$value->nome_maquina] += (int) $value->qtd_estoque;
            }
        }
        if(!empty($datasets['data']))
            ksort($datasets['data']);

        $datasets['label'] = 'Produção '.$dta_ini . ' até '.$dta_fin;
      //  dd($datasets,$data);

        $data = [];
        $data['datasets'][] = $datasets;
        $chart = [];
        $chart['type'] = 'line';
        $chart['data'] = $data;

        return $chart;

    }

    public function GetData()
    {
        $dashboard = [];
        $dashboard['dashboardInfo'] = $this->getDashboardInfo();
        $dashboard['chartUserCheckin'] = $this->getChartUserCheckinInfo();
        $dashboard['TotalPecasMontagem'] = $this->getTotalPecasMontagem();
        $dashboard['TotalProducao'] = $this->getTotalProducao();
        $dashboard['TotaProducaoSemana'] =$this->getTotaProducaoSemana();
        $dashboard['producaoMaquina'] = $this->getproducaoMaquina();


        //dd($dashboard);

        return $dashboard;
    }
}
