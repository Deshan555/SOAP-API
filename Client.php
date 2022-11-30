<?php
// Request Model
class deposit
{
    public $account_number;

    public $money_amount;
}

class withdraw
{
    public $account_number;

    public $money_amount;

    public $pin;
}

class transfer
{
    public $account_number;

    public $money_amount;

    public $pin;

    public $to;
}


class Client{

    public $instance = NULL;


    public function __construct()
    {
        $params = array(
            'location'=>'http://localhost/SP/Server.php?wsdl',
            'uri' =>  'urn://localhost/SP/Server.php?wsdl',
            'trace'=>1,'cache_wsdl'=>WSDL_CACHE_NONE    );
        $this->instance =  new SoapClient(NULL, $params);
    }

    public function getDeposit($deposit_info)
    {
        return $this->instance->__soapCall('deposit_money', [$deposit_info]);
    }

    public function getMoney($withdraw_info)
    {
        return $this->instance->__soapCall('money_withdraw', [$withdraw_info]);
    }

    public function getTransfer($transfer_info)
    {
        return $this->instance->__soapCall('transfer_money', [$transfer_info]);
    }
}

$client = new Client;

$deposit_info = new deposit();
$deposit_info->account_number = 1;
$deposit_info->money_amount = 4000;

$withdraw_info = new withdraw();
$withdraw_info->account_number = 1;
$withdraw_info->money_amount =  4000;
$withdraw_info->pin = '12345';

$transfer_info = new transfer();
$transfer_info->account_number = 1;
$transfer_info->to = 4;
$transfer_info->money_amount =  1000;
$transfer_info->pin = '12345';

try{
        
    echo "Do Deposits\t: " ,$client->getDeposit($deposit_info),"\n";
    
    echo "Money Withdraw\t: " ,$client->getMoney($withdraw_info),"\n";
    
    echo "Money Transfer\t: " ,$client->getTransfer($transfer_info),"\n";
    
    echo "Operation Finished\n";
}
catch (Exception $e)
{
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
?>
