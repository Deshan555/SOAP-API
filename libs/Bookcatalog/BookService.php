<?php

namespace Bookcatalog;

class MyDB extends \SQLite3
{
    function __construct()
    {
        $this->open('bank.db');
    }
}

class BookService
{
    /**
  * @soap
  * @param Bookcatalog\Withdraw $details
  * @return string  
  */
  public function money_withdraw($details)
  {
      $acc_number = $details->account_number;

      $cash_amount = $details->money_amount;

      $pin_number = $details->pin;

      return $this->check_account($acc_number, $pin_number, $cash_amount);
  }

  /**
* @soap
* @param Bookcatalog\Deposit $account_number
* @return string  
*/
  public function deposit_money($account_number)
  {
      $acc_number = $account_number->account_number;

      $cash_amount = $account_number->money_amount;

      return $this->update_account($acc_number, $cash_amount);
  }

  /**
* @soap
* @param Bookcatalog\Transfer $details
* @return string  
*/
  public function transfer_money($details)
  {
      $acc_number = $details->account_number;

      $cash_amount = $details->money_amount;

      $pin_number = $details->pin;

      $target_account = $details->to;

      return $this->transfer($acc_number, $pin_number, $target_account, $cash_amount);
  }

  function check_account($account_number, $pin, $amount)
  {
      $sql = "SELECT * from Users WHERE Account_ID = $account_number AND Password = '$pin';";

      $database = new MyDB();

      $ret = $database->query($sql);

      while($row = $ret->fetchArray(SQLITE3_ASSOC))
      {
          $current_balance =  $row['Money_Amount'];

          if($current_balance > $amount)
          {
              $updatable_value = $current_balance - $amount;

              $update_sql = "UPDATE Users set Money_Amount = $updatable_value where Account_ID = $account_number;";

              $ret = $database->exec($update_sql);

              if(!$ret)
              {
                  return $database->lastErrorMsg();
              }
              else
              {
                  return "Money Withdraw Finished, Current Account Balance Is : ".$this->get_Balance($account_number);
              }
          }
          else
          {
              return "Insufficient Account Balance For Money Withdraw";
          }
      }

      return "Wrong Pin Number Or Account Number Please Double Check Details";
  }

  function update_account($account_number, $money_amount)
  {
      $sql = "SELECT * from Users WHERE Account_ID = $account_number;";

      $database = new MyDB();

      $ret = $database->query($sql);

      while($row = $ret->fetchArray(SQLITE3_ASSOC))
      {
          $new_amount = $this->get_Balance($account_number)+$money_amount;

          $update_sql = "UPDATE Users set Money_Amount = $new_amount where Account_ID = $account_number;";

          $ret = $database->exec($update_sql);

          if(!$ret)
          {
              return $database->lastErrorMsg();
          }
          else
          {
              return "Your Account Upto date Current Account Balance Is : ".$this->get_Balance($account_number);
          }
      }
      
       return "Wrong Account Number Detected";
      
  }

  function get_Balance($account_number)
  {
      $sql = "SELECT * from Users WHERE Account_ID = $account_number;";

      $database = new MyDB();

      $ret = $database->query($sql);

      while($row = $ret->fetchArray(SQLITE3_ASSOC))
      {
          return $row['Money_Amount'];
      }
  }

  function transfer($account_number, $pin_number, $to, $cash_amount)
  {
      $sql = "SELECT * from Users WHERE Account_ID = $account_number AND Password = '$pin_number';";

      $database = new MyDB();

      $ret = $database->query($sql);

      while($row = $ret->fetchArray(SQLITE3_ASSOC))
      {
          $sql_validation = "SELECT * from Users WHERE Account_ID = $to;";

          $database = new MyDB();

          $ret = $database->query($sql_validation);

          while($row = $ret->fetchArray(SQLITE3_ASSOC))
          {
              $current_balance =  $this->get_Balance($account_number);

              if($current_balance > $cash_amount)
              {
                  $updatable_value = $current_balance - $cash_amount;

                  $update_sql = "UPDATE Users set Money_Amount = $updatable_value where Account_ID = $account_number;";

                  $ret = $database->exec($update_sql);

                  if(!$ret)
                  {
                      return $database->lastErrorMsg();
                  }
                  else
                  {
                      $this->update_account($to, $cash_amount);

                      return "Money Transfer To Finished, Current Account Balance Is : ".$this->get_Balance($account_number);
                  }
              }
              else
              {
                  return "Insufficient Account Balance For Money Transfer";
              }
          }

          return "Receiver's Account Number Wrong Double Check";
      }

      return "Wrong Pin Number Please Double Check Pin Number";
  }
}

