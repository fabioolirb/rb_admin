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
    private $colorchar;


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
        $this->colorchar = ['106,90,205','(135,206,235)','(0,255,255)','(127,255,212)','(173,255,47)',
        '(189,83,107)','(188,143,143)','(238,130,238)','(220,20,60)','(255,255,0)','(255,228,196)',
        '(75,0,130)','(139,0,139)','(210,180,140)','(47,79,79)','(0,100,0)','(0,128,128)','(0,191,255)',
        '(0,100,0)','(85,107,47)','(188,143,143)','(255,140,0)','(255,215,0)','(240,230,140)','(0,255,0)','(0,255,255)',
        '(30,144,255)','(0,0,139)','(148,0,211)','255,0,255)','(255,182,193)','(245,222,179)','106,90,205','(135,206,235)','(0,255,255)','(127,255,212)','(173,255,47)',
            '(189,83,107)','(188,143,143)','(238,130,238)','(220,20,60)','(255,255,0)','(255,228,196)',
            '(75,0,130)','(139,0,139)','(210,180,140)','(47,79,79)','(0,100,0)','(0,128,128)','(0,191,255)',
            '(0,100,0)','(85,107,47)','(188,143,143)','(255,140,0)','(255,215,0)','(240,230,140)','(0,255,0)','(0,255,255)',
            '(30,144,255)','(0,0,139)','(148,0,211)','255,0,255)','(255,182,193)','(245,222,179)'];
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

       $rs_data = $this->producaoRepository->getTotalProducao();
       $rs_data = $this->getMes($rs_data);
       $meskey = '';

       foreach ($rs_data as $meskey=>$data) {

           $labels = [];
           $dataset = [];
           $dataset['label'] = 'Total de Produção Dia ';
           $dataset['data'] = [];
           $dataset['borderColor'] = 'rgb(75, 192, 192)';
           $dataset['backgroundColor'] = 'rgba(255,155,0,1)';
           $qtd = 0;
           $index = '';

           foreach ($data as $key => $value) {
               $newKey = Carbon::parse($value->data_producao)->format('d/m/Y');
               $index = (string)str_replace('/', '', $newKey);
               $dataset['data'][$newKey] = (integer)$value->qtd_estoque;
               $labels[$index] = $newKey;
               $qtd += (integer)$value->qtd_estoque;
           }

           $dataset['label'] = 'Total de Produção Dia '.number_format($qtd ,0,'.','.');

           //$data = [];
           $data['labels'] = array_values($labels);
           sort($data['labels']);
           $data['datasets'][] = $dataset;
           //dd($dataset,$labels);
           // $dataset['label'] .=' - ' . number_format($qtd ,0,'.','.');

           $chart = [];
           $chart['type'] = 'bar';
           $chart['data'] = $data;
           $chart['qtd'] = number_format($qtd, 0, '.', '.');
           $rs_chart[$meskey] = $chart;

       }
           //dd($rs_chart);
       krsort($rs_chart);
      return $rs_chart;

   }

    public function getproducaoOperador(){

        $rs_data = $this->producaoRepository->getProducao();
        $rs_data = $this->getMes($rs_data);
        $rs_chart = [];

        foreach ($rs_data as $meskey=>$data) {

            $datasets = [];
            $cont = 0;
            $dta_ini = false;
            $dta_fin = false;
            $labels = [];
            $dataset_aux = [];
            $newKey ='';
            foreach ($data as $key => $value) {

                $newKey = Carbon::parse($value->data_producao)->format('d/m/Y');
                @$dataset_aux['data'][$value->operadors_nome][$newKey] += $value->qtd_estoque;
                @$dataset_aux['turno'][$value->operadors_nome]['label'] = $value->operadors_nome;
                @$dataset_aux['turno'][$value->operadors_nome]['qtd'] += $value->qtd_estoque;
                @$dataset_aux['tdo'] += $value->qtd_estoque;

                $labels[$newKey] = $newKey;
            }

            $data = ['label' => '', 'borderColor' => '', 'data' => []];

            foreach ($dataset_aux['data'] as $key => $value) {
                $cont++;
                $color = empty($this->colorchar[$cont]) ? $this->colorchar[$cont = 0] : $this->colorchar[$cont];
                $data['borderColor'] = 'rgb' . $color;
                $data['backgroundColor'] = 'rgb' . $color;
                $data['label'] = $dataset_aux['turno'][$key]['label'] . ' (' . number_format($dataset_aux['turno'][$key]['qtd'], 0, '.', '.') . ')';

                foreach ($value as $key2 => $qtd) {
                    $data['data'][$key2] = $qtd;
                }

                $datasets[] = $data;
                $data = ['label' => '', 'borderColor' => '', 'data' => []];
            }

            foreach ($datasets as $key => $value) {
                foreach ($labels as $value2) {
                    @$data['labels'][$value2] = $value2;
                    if (!array_key_exists($value2, $value['data'])) {
                        $datasets[$key]['data'][$value2] = '0';
                        ksort($datasets[$key]['data']);
                    }
                }
                ksort($datasets[$key]['data']);
            }

            $data = [];
            $data['datasets'] = $datasets;

            $chart = [];
            $chart['type'] = 'bar';
            $chart['data'] = $data;
            $chart['qtd'] = number_format($dataset_aux['tdo'], 0, '.', '.');
            $rs_chart[$meskey] = $chart;
            $data = [];
        }
        krsort($rs_chart);
        return $rs_chart;
    }

    public function getproducaoProdutos(){

        $rs_data = $this->producaoRepository->getProducao();
        $rs_data = $this->getMes($rs_data);
        $rs_chart = [];

        foreach ($rs_data as $meskey=>$data) {


            $labels = [];
            $dataset = [];
            //$dataset['label'] = 'Total de Produção Dias';
            $dataset['data'] = [];
            $dataset_aux['qtd'] = [];
            $dataset['borderColor'] = 'rgb(0, 0, 0)';
            $dataset['backgroundColor'] = 'rgba(255,0,0,1)';
            $qtd = 0;

            foreach ($data as $key => $value) {
                // $newKey = Carbon::parse($value->data_producao)->format('d/m/Y');
                $newKey = $value->imagem_produtos_nome;
                @$dataset['data'][$newKey] += (integer)$value->qtd_estoque;
                @$dataset_aux['qtd'][$newKey] += (integer)1;
                $labels[$newKey] = $newKey;
                $qtd += (integer) $value->qtd_estoque ;
            }

            $dataset['label'] = 'Total de Produção  '. number_format($qtd ,0,'.','.');

            foreach ($labels as $key => $vlr) {
                $labels[$vlr . ' - ' . $dataset_aux['qtd'][$key]] = $vlr . ' - ' . $dataset_aux['qtd'][$key];
                $dataset['data'][$vlr . ' - ' . $dataset_aux['qtd'][$key]] = @$dataset['data'][$key];
                unset($labels[$key]);
                unset($dataset['data'][$key]);
            }
            ksort($dataset['data']);
            //dd($labels) ;

            $data = [];
            $data['labels'] = array_values($labels);
            sort($data['labels']);

            $data['datasets'][] = $dataset;

            $chart = [];
            $chart['type'] = 'bar';
            $chart['data'] = $data;
            $rs_chart[$meskey] = $chart;
        }
        //dd($rs_chart);
        krsort($rs_chart);
        return $rs_chart;

    }

    public function getproducaoTurno(){

        $rs_data = $this->producaoRepository->getProducao();
        $rs_data = $this->getMes($rs_data);

        foreach ($rs_data as $meskey=>$data) {
            $datasets = [];
            $dataset_aux = [];
            $dataset_aux['data'] = [];
            $labels = [];
            $cont = 11;

            foreach ($data as $key => $value) {
                $newKey = Carbon::parse($value->data_producao)->format('d/m/Y');
                @$dataset_aux['data'][$value->turnos_nome][$newKey] += $value->qtd_estoque;
                $dataset_aux['turno'][$value->turnos_nome]['label'] = $value->turnos_nome;
                @$dataset_aux['turno'][$value->turnos_nome]['qtd'] += $value->qtd_estoque;
                $labels[$newKey] = $newKey;
            }

            $data = ['label' => '', 'borderColor' => '', 'data' => []];

            foreach ($dataset_aux['data'] as $key => $value) {
                $cont++;
                $color = empty($this->colorchar[$cont]) ? $this->colorchar[$cont = 0] : $this->colorchar[$cont];
                $data['borderColor'] = 'rgb' . $color;
                $data['backgroundColor'] = 'rgb' . $color;

                $data['label'] = $dataset_aux['turno'][$key]['label'] . '(' . number_format($dataset_aux['turno'][$key]['qtd'], 0, '', '.') . ')';

                foreach ($value as $key2 => $qtd) {
                    $data['data'][$key2] = $qtd;
                }

                $datasets[] = $data;
                $data = ['label' => '', 'borderColor' => '', 'data' => []];
            }

            foreach ($datasets as $key => $value) {
                foreach ($labels as $value2) {
                    if (!array_key_exists($value2, $value['data']))
                        $datasets[$key]['data'][$value2] = '0';
                }
                ksort($datasets[$key]['data']);
            }
            $data = [];
            $data['labels'] = array_values($labels);
            sort($data['labels']);
            // dd($datasets, $data['labels']);
            $data['datasets'] = $datasets;

            $chart = [];
            $chart['type'] = 'line';
            $chart['data'] = $data;

            $rs_chart[$meskey] = $chart;
            //dd($chart);
        }
        //dd($rs_chart);
        krsort($rs_chart);
        return $rs_chart;
    }

    public function getTotalPecasMontagem(){


        $rs_data = $this->montagemRepository->getTotalMontagem();
        //dd($rs_data);
        $rs_data = $this->getMes($rs_data);

        foreach ($rs_data as $meskey=>$rs_data) {


            $datasets = [];
            $dataset_aux = [];
            $dataset_aux['data'] = [];
            $labels = [];
            $cont = 0;


            foreach ($rs_data as $key => $value) {
                $newKey = Carbon::parse($value->data_envio)->format('d/m/Y');
                $dataset_aux['data'][$value->status_montagem_id][$newKey] = $value->qtd_itens;
                $dataset_aux['status'][$value->status_montagem_id] = $value->nome;
                $labels[$newKey] = $newKey;
            }

            $data = ['label' => '', 'borderColor' => '', 'data' => []];

            foreach ($dataset_aux['data'] as $key => $value) {
                $cont++;
                $color = empty($this->colorchar[$cont]) ? $this->colorchar[$cont = 0] : $this->colorchar[$cont];
                $data['borderColor'] = 'rgb' . $color;
                $data['backgroundColor'] = 'rgb' . $color;

                $data['label'] = $dataset_aux['status'][$key];

                foreach ($value as $key2 => $qtd) {
                    $data['data'][$key2] = $qtd;
                }

                $datasets[] = $data;
                $data = ['label' => '', 'borderColor' => ''];
            }

            foreach ($datasets as $key => $value) {
                foreach ($labels as $value2) {
                    if (!array_key_exists($value2, $value['data']))
                        $datasets[$key]['data'][$value2] = '0';
                }
                ksort($datasets[$key]['data']);
            }

            //$data = [];
            $data['labels'] = array_values($labels);
            sort($data['labels']);
            // dd($datasets, $data['labels']);
            $data['datasets'] = $datasets;

            $chart = [];
            $chart['type'] = 'bar';
            $chart['data'] = $data;
            $rs_chart[$meskey] = $chart;
        }
        //dd($rs_chart);
        krsort($rs_chart);
        return $rs_chart;

    }

    public function getTotalMontadores(){

        $rs_data = $this->montagemRepository->getTotalMontadores('data_envio');
        $rs_data = $this->getMes($rs_data);

        foreach ($rs_data as $meskey=>$data) {

            $datasets = [];
            $dataset_aux = [];
            $dataset_aux['data'] = [];
            $cont = 5;
            $qtd = 0;
            $labels =[];

            foreach ($data as $key => $value) {
                $newKey = Carbon::parse($value->data_envio)->format('d/m/Y');
                $dataset_aux['data'][$value->montadora_id][$newKey] = $value->qtd_itens;
                $dataset_aux['montador'][$value->montadora_id] = explode(' ', $value->montadora)[0];
                $labels[$newKey] = $newKey;
                $qtd += $value->qtd_itens;

            }

            $data = ['label' => '', 'borderColor' => '', 'data' => []];

            foreach ($dataset_aux['data'] as $key => $value) {
                $cont++;
                $color = empty($this->colorchar[$cont]) ? $this->colorchar[$cont = 0] : $this->colorchar[$cont];
                $data['borderColor'] = 'rgb' . $color;
                $data['backgroundColor'] = 'rgb' . $color;

                $data['label'] = $dataset_aux['montador'][$key];

                foreach ($value as $key2 => $vlr) {
                    $data['data'][$key2] = $vlr;
                }

                $datasets[] = $data;
                $data = ['label' => '', 'borderColor' => '', 'data' => []];
            }

            foreach ($datasets as $key => $value) {
                foreach ($labels as $value2) {
                    if (!array_key_exists($value2, $value['data']))
                        $datasets[$key]['data'][$value2] = '0';
                }
                ksort($datasets[$key]['data']);
            }

            //$data = [];
            $data['labels'] = array_values($labels);
            sort($data['labels']);
            $data['datasets'] = $datasets;

            $chart = [];
            $chart['type'] = 'line';
            $chart['data'] = $data;
            $chart['qtd'] = number_format($qtd, 0, '.', '.');

            $rs_chart[$meskey] =$chart;
            //$chart = '';
        }
     // dd($rs_chart,$chart);
        krsort($rs_chart);
        return $rs_chart;

    }

    public function getTotalPecasRetorno(){

        $rs_data = $this->montagemRepository->getTotalMontadores('data_retorno');
        $rs_data = $this->getMes($rs_data,'data_retorno');

        foreach ($rs_data as $meskey=>$rs_value) {

            $datasets =[];
            $dataset_aux = [];
            $data_index =[];

            $labels = [];
            $cont= 10;

            foreach ($rs_value as $key => $value) {
                $newKey = Carbon::parse($value->data_retorno)->format('d/m/Y');
                $dataset_aux['data'][$value->montadora_id][$newKey] = $value->qtd_itens;
                $dataset_aux['montador'][$value->montadora_id] = explode(' ',$value->montadora)[0];
                $labels[$newKey] = $newKey;
                $data_index[$newKey]=0;
                ksort($dataset_aux['data'][$value->montadora_id]);
            }

            $data = ['label'=>'','borderColor'=>'','data'=>[]];

            foreach ($dataset_aux['data'] as $key=> $value){
                $cont++;
                $color = empty($this->colorchar[$cont])?$this->colorchar[$cont=0]:$this->colorchar[$cont];
                $data['borderColor'] = 'rgb'.$color;
                $data['backgroundColor'] = 'rgb'.$color;
                $data['label'] = $dataset_aux['montador'][$key];

                Foreach($value as $key2=> $qtd ){
                    $data['data'][$key2]=$qtd;
                }

                foreach ($data_index as $add_data => $vlr){
                    if(empty($data['data'][$add_data])){
                        $data['data'][$add_data] = 0;
                    }
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
            $data['datasets'] = $datasets;

            $chart = [];
            $chart['type'] = 'bar';
            $chart['data'] = $data;
            $rs_chart[$meskey] =$chart;
        }

        krsort($rs_chart);
        return $rs_chart;

    }

    public function getTotalPecasMontagemDia(){

        $rs_data = $this->montagemRepository->getTotalMontadores('data_retorno');
        $rs_data = $this->getMes($rs_data,'data_retorno');
        $cont = 0;

        foreach ($rs_data as $meskey=>$rs_value) {

            $labels = [];
            $dataset = [];
            $dataset['label'] = 'Total de Montagem Dia';
            $cont++;

            $color = empty($this->colorchar[$cont])?$this->colorchar[$cont=0]:$this->colorchar[$cont];
            $dataset['borderColor'] = 'rgb'.$color;
            $dataset['backgroundColor'] = 'rgb'.$color;

            $dataset['data'] = [];

           // $data = $this->montagemRepository->getTotalMontadores('data_retorno');

            foreach ($rs_value as $key => $value) {
                $newKey = Carbon::parse($value->data_retorno)->format('d/m/Y');
                $dataset['data'][$newKey] = (integer) $value->qtd_itens;
                $labels[$newKey] = $newKey;
            }

            $data['labels'] = array_values($labels);
            sort($data['labels']);
            $data['datasets'][] = $dataset;

            $chart = [];
            $chart['type'] = 'bar';
            $chart['data'] = $data;
            $data = [];
            $rs_chart[$meskey] =$chart;
        }

        //dd($rs_chart);
        krsort($rs_chart);
        return $rs_chart;

    }


    public function  getTotaProducaoSemana(){

        $rs_data = $data = $this->producaoRepository->getTotalProducaoSemana();
        //dd($rs_data);
        $rs_data = $this->getMes($rs_data);
        $cont = 0;
       // dd($rs_data);

        foreach ($rs_data as $meskey=>$rs_value) {

                $semana= [0=>'Segunda',1=>'Terça',2=>'Quarta',3=>'Quinta',4=>'Sexta',5=>'Sabado'];

                $datasets = [];
                $data_aux = [];


                foreach ($rs_value as $key=> $value) {

                    $datasets[(integer) $value->nr_semana_producao]['borderColor'] = 'rgb' . $this->colorchar[$key] ;
                    $datasets[(integer) $value->nr_semana_producao]['backgroundColor'] = 'rgb' . $this->colorchar[$key] ;
                    $datasets[(integer) $value->nr_semana_producao]['label'] = 'Primeira Semana';
                    $datasets[(integer) $value->nr_semana_producao]['data'][(int) $value->semana_producao ] = $value->qtd_estoque ;
                    ksort ($datasets[$value->nr_semana_producao]['data']);
                }

              $cont =1;
                //ksort($datasets);
                //dd($datasets);
                foreach ($datasets as $key=>$value){
                    foreach ($value['data'] as $key2=>$value2){
                        foreach ($semana as $key3=>$value3) {
                            if ($key2 == $key3) {
                                $datasets[$key]['data'][$value3] = $value2;
                                unset($datasets[$key]['data'][$key3]);
                            }else{
                                $datasets[$key]['data'][$value3] = empty($datasets[$key]['data'][$value3])?0:$datasets[$key]['data'][$value3];
                            }
                            //dd($key,$key2, $key3,$value2,$value3,$datasets[$key]['data'][$value3],$datasets[$key]);
                        }

                    }

                    $datasets[$key]['label'] = $cont.'º Semana';
                    $data_aux[]=$datasets[$key];
                    $cont++;
                    //
                    ksort($datasets);

                }

                $data = [];
                $data['datasets'] = $data_aux;
                $chart = [];
                $chart['type'] = 'bar';
                $chart['data'] = $data;
                $datasets = [];
                $rs_chart[$meskey] =$chart;
                $data = [];
            }

           // dd($rs_chart);
            krsort($rs_chart);
            return $rs_chart;
    }

    public function getproducaoMaquina(){

        $rs_data = $this->producaoRepository->getProducaoMaquina();
        $rs_data = $this->getMes($rs_data);

        foreach ($rs_data as $meskey=>$data) {

            $datasets = [];
            $dta_ini = false;
            $dta_fin = false;
            $qtd = 0;

            foreach ($data as $key => $value) {
                $datasets['borderColor'] = 'rgb(' . (12 + $key) . ',' . (30 + $key) . ', 192)';
                $datasets['backgroundColor'] = 'rgba( ' . (12 + $key) . ',' . (10 + $key) . ', 192,0,5)';
                $dta_ini = empty($dta_ini) ? Carbon::parse($value->data_producao)->format('d/m/Y') : $dta_ini;
                $dta_fin = Carbon::parse($value->data_producao)->format('d/m/Y');

                $qtd += (int)$value->qtd_estoque;

                if (empty($datasets['data'][$value->nome_maquina])) {
                    $datasets['data'][$value->nome_maquina] = (int)$value->qtd_estoque;
                } else {
                    $datasets['data'][$value->nome_maquina] += (int)$value->qtd_estoque;
                }
            }

           // if (!empty($datasets['data']))
            ksort($datasets['data']);

            $datasets['label'] = 'Produção ' . $dta_ini . ' até ' . $dta_fin;
            //  dd($datasets,$data);

            $data = [];
            $data['datasets'][] = $datasets;
            $chart = [];
            $chart['type'] = 'line';
            $chart['data'] = $data;
            $chart['qtd'] = number_format($qtd, 0, '.', '.');
            $rs_chart[$meskey] =$chart;
        }

        krsort($rs_chart);
        return $rs_chart;

    }


    function getMes($data,$obj=null,$dd= false){

        foreach ($data as $key=> $value) {
            if(empty($obj)) {
                if (empty($value->data_producao)) {
                    $mesKey = Carbon::parse($value->data_envio)->format('m/Y');
                } else {
                    $mesKey = Carbon::parse($value->data_producao)->format('m/Y');
                }
            }else{
                if($obj=='data_retorno'){
                    $mesKey = Carbon::parse($value->data_retorno)->format('m/Y');
                }
            }

            $rs_data[$mesKey][]=$value;
        }
        //dd($rs_data);
        return $rs_data;
    }

    public function GetData()
    {
        $dashboard = [];
        $dashboard['dashboardInfo'] = $this->getDashboardInfo();
        $dashboard['chartUserCheckin'] = $this->getChartUserCheckinInfo();
        $dashboard['TotalMontagem'] = $this->getTotalPecasMontagem();

        $dashboard['TotaProducaoSemana'] =$this->getTotaProducaoSemana();

        $dashboard['TotalMontadores'] = $this->getTotalMontadores();
        $dashboard['TotalPecasRetorno'] = $this->getTotalPecasRetorno();
        $dashboard['TotalPecasMontagemDia'] = $this->getTotalPecasMontagemDia();
        $dashboard['totalProducao'] = $this->getTotalProducao();

        // Grafico 1
        $dashboard['producaoMaquina'] = $this->getproducaoMaquina();
        $dashboard['producaoOperador'] = $this->getproducaoOperador();
        $dashboard['producaoProdutos'] = $this->getproducaoProdutos();
        $dashboard['producaoTurno'] = $this->getproducaoTurno();

        //dd($dashboard);

        return $dashboard;
    }
}
