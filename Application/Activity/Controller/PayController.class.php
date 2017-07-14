<?php
namespace Activity\Controller;
use Think\Controller;
use Think\Log;
class PayController extends Controller
{

    public function _initialize()
    {
    }

    public function index()
    {
        $rr = require_once SDK_PATH . 'dbwxapi/sdk/Nonghang/ebusclient/PaymentRequest.php';
        
        $tRequest = new \PaymentRequest();
        $order_sn = date("YmdHis") . rand(10, 99);
        $tRequest->order['PayTypeID'] = 'ImmediatePay';
        $tRequest->order['OrderNo'] = $order_sn;
        $tRequest->order['OrderDate'] = date("Y/m/d");
        $tRequest->order['OrderTime'] = date("H:i:s");
        $tRequest->order['CurrencyCode'] = "156";
        $tRequest->order['OrderAmount'] = 0.01;
        $tRequest->order['InstallmentMark'] = 0;
        $tRequest->order['CommodityType'] = '0101';
        $tRequest->orderitems[0] = [
            'ProductName' => "一分钱"
        ];
        $tRequest->request['PaymentType'] = 'A';
        $tRequest->request['PaymentLinkType'] = "2";
        $tRequest->request['NotifyType'] = "1";
        $tRequest->request['ResultNotifyURL'] = 'http://yfq.duobakeji.com/Activity/Pay/getstatus';
        $tRequest->request['IsBreakAccount'] = "0";
        $tResponse = $tRequest->postRequest();
        if ($tResponse->isSuccess()) {
            $url = $tResponse->GetValue("PaymentURL");
            $user_info = $_SESSION['user_info'];
            M("payment_log")->add([
                "user_id" => $user_info['user_id'],
                'type_id' => $user_info['type_id'],
                "pay_money" => 1,
                "order_sn" => $order_sn,
                "add_time"=>time()
            ]);
            $return = [
                'status' => 200,
                'message' => "发送成功",
                "date" => [
                    'url' => $url
                ]
            ];
            $this->ajaxReturn($return);
            // header("Location:".$tResponse->GetValue("PaymentURL"));
        }
        $return = [
            'status' => 300,
            'message' => "跳转支付失败"
        ];
        $this->ajaxReturn($return);
        // dump($ret);
    }

    function getstatus()
    {
        Log::write("nowpay : " . var_export($_POST,true));
        require_once SDK_PATH . 'dbwxapi/sdk/Nonghang/ebusclient/Result.php';
        // 1、取得MSG参数，并利用此参数值生成验证结果对象
        $tResult = new \Result();
        $tResponse = $tResult->init($_POST['MSG']);
        if ($tResponse->isSuccess()) {
            // 2、、支付成功
            $pay_info = M("payment_log")->where([
                'order_sn' => $tResponse->getValue("OrderNo")
            ])
                ->find();
            if ($pay_info && $pay_info['status'] != 2) {
                M("payment_log")->where([
                    'order_sn' => $tResponse->getValue("OrderNo")
                ])
                    ->save([
                    'status' => 2,
                    "update_time" => time(),
                    'yh_order_sn' => $tResponse->getValue("iRspRef"),
                    'message' => json_encode($_POST)
                ]);
                M('user_day_log')->where([
                    'user_id' => $pay_info['user_id'],
                    "add_date" => date("Y-m-d")
                ])->setInc("totle_times");
                M('user_day_log')->where([
                    'user_id' => $pay_info['user_id'],
                    "add_date" => date("Y-m-d")
                ])->setInc("pay_times");
                M('user')->where([
                    'user_id' => $pay_info['user_id']
                ])->setInc("totle_pay_money");
            }
        } else {
            // 3、失败
            $pay_info = M("payment_log")->where([
                'order_sn' => $tResponse->getValue("OrderNo")
            ])
                ->find();
            if ($pay_info && $pay_info['status'] != 3) {
                M("payment_log")->where([
                    'order_sn' => $tResponse->getValue("OrderNo")
                ])
                    ->save([
                    'status' => 2,
                    "update_time" => time(),
                    'message' => json_encode($_POST)
                ]);
            }
        }
        header("Location:http://yfq.sjzdezhong.com/Activity?sub=1");
    }
}