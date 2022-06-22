<?php
header('Content-Type: application/json; charset=UTF-8');

$output = array();
$cal_ = $_GET["cal"];
$rate1 = $_GET["rate1"];
$rate2 = $_GET["rate2"];
$user_ratio= $_GET["user_ratio"];

// if($cal_ <= 40000000){
//     $total_payment = round($cal_ *($rate1/100));
// }else{
//     $total_payment = round((40000000 * ($rate1/100) ) + ( ($cal_ - 40000000) * ($rate2/100) ) );
// }
    
$total_payment = round( ($cal_ *($rate1/100))*($user_ratio/100) );

$flag = 0;
$cnt_while = 1;

try{
    
    while($flag < 1 ){ // 상태값이 1이 될경우 종료
        
        /*
         * 기타비용
         * */
        $etc_min = mt_rand(25,32); // 기타비용 min값 구간 25~32
        $etc_max = mt_rand(33,35); // 기타비용 max값 수간 33~35
        $rand_etc = mt_rand($etc_min,$etc_max); // 랜덤 퍼센티지 계산
        $remain_etc = $etc_max-$rand_etc; // max값 35에서 rand_etc값을 뺀값을 다음 계산으로 전달
        $won_etc = floor(ceil($total_payment * ($rand_etc/100))/100)*100; // 기타비용 원으로 계산, 100원단위 절삭
        
        
        /*
         * 소모품비
         * */
        $cons_min = mt_rand(20,25) + $remain_etc; // 소모품비 min값 구간 20~25
        $cons_max = mt_rand(26,30) + $remain_etc; // 소모품비 max값 구간 26~30
        $rand_cons = mt_rand($cons_min,$cons_max); // 랜덤 페선티지 계산
        $remain_rand = $cons_max-$rand_cons; // max값 30에서 rand_cons값을 뺀 값을 다음 계산으로 전달
        $won_cons = floor(ceil($total_payment * ($rand_cons/100))/100)*100; // 소모품비 원으로 계산, 100원단위 절삭
        
        /*
         * 접대비
         * */
        $enter_min = mt_rand(15,20) + $remain_rand;// 접대비 min값 구간 15~20
        $enter_max = mt_rand(21,25) + $remain_rand;// 접대비 max값 구간 21~25
        $rand_enter = mt_rand($enter_min,$enter_max);// 랜덤 페선티지 계산
        $remain_enter = $enter_max-$rand_enter;// max값 30에서 rand_enter 값을 뺀 값을 다음 계산으로 전달
        $won_enter = floor(ceil($total_payment * ($rand_enter/100))/100)*100;// 접대비 원으로 계산, 100원단위 절삭
        if($won_enter > 12000000)
            $won_enter = floor( mt_rand(11850000,12000000) / 10 ) * 10 ;
        
        
        /*
         * 지급수수료
         * */
        $fee_min = mt_rand(5,15) + $remain_enter;// 지급수수료 min값 구간 5~15
        $fee_max = mt_rand(16,23) + $remain_enter;// 지급수수료 max값 구간 16~23
        $rand_fee = mt_rand($fee_min,$fee_max);// 랜덤 페선티지 계산
        $won_fee = floor(ceil($total_payment * ($rand_fee/100))/100)*100;// max값 30에서 rand_fee값을 뺀 값을 다음 계산으로 전달
        $remain_trans = 100 - ($rand_etc+$rand_cons+$rand_enter+$rand_fee);// 지급수수료 원으로 계산, 100원단위 절삭
        
        
        /*
         * 여비교통비
         * */
        $won_trans = floor(ceil($total_payment * ($remain_trans/100))/100)*100; // 위에서 받은 남은값 그대로를 여비교통비로 사용
        $won_total = $won_etc+$won_cons+$won_enter+$won_fee+$won_trans; // 원으로 계산
       
        
        if($remain_trans <= 2 || $remain_trans >= 6 ){ // 여비교통비가 마이너스가 나올수도 있기때문에 여비교통비의 퍼센티지를 2~6% 구간으로 설정
            $cnt_while++;
        }else{
            
            $output['won_etc'] = $won_etc;
            $output['won_cons'] = $won_cons;
            $output['won_enter'] = $won_enter;
            $output['won_fee'] = $won_fee;
            $output['won_trans'] = $won_trans;
            $output['won_total'] = $won_total;
            $output['cnt_while'] = $cnt_while;
            $output['result_code'] = 200;
            $output['error'] = "";
            
            $flag=1;
            break;
        }
    } // while end
}
catch (Exception $e){
    //echo '{"error" : {"text" : '.$e->getMessage().'}}';
    $output['error'] = $e->getMessage();
    $output['result_code'] = 400;
}


echo json_encode($output);


?>