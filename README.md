
# PHP SOAP Server

### Installation

#### Instructions Setup for Server:
- Place the Source Zip file in the htdocs/www folder on your localhost.
- Run that command in CMD after opening the SP folder

```bash
composer require php2wsdl/php2wsdl
```
- the following URL into your browser: http://localhost/SP/server.php?wsdl
- If you follow the instructions exactly, a browser will display the wsdl file.


#### Instructions for Setup Client:
- The client.python file is located in the client folder. Install the Python Request package using the following command before running client.py

```bash
pip install requests
```
### Demo
These Are the Requests and Responses from PHP-SOAP Server

#### Money Deposit:
a request for payment, I provided the account name and the amount of money as parameters for this:
```bash
  <soapenv:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://localhost/SP/server.php">
   <soapenv:Header/>
   <soapenv:Body>
      <ser:deposit_money soapenv:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/">
         <account_number xsi:type="ser:Bookcatalog.Deposit">
            <!--You may enter the following 2 items in any order-->
            <account_number xsi:type="xsd:int">1</account_number>
            <money_amount xsi:type="xsd:int">1000</money_amount>
         </account_number>
      </ser:deposit_money>
   </soapenv:Body>
</soapenv:Envelope>

```

- Expected Response from Soap Server:

```bash
<SOAP-ENV:Envelope SOAP-ENV:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ns1="http://localhost/SP/server.php" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/">
   <SOAP-ENV:Body>
      <ns1:deposit_moneyResponse>
         <return xsi:type="xsd:string">Your Account Upto date Current Account Balance Is : 49000</return>
      </ns1:deposit_moneyResponse>
   </SOAP-ENV:Body>
</SOAP-ENV:Envelope>
```

#### Money Withdraw

The system requests three parameters when a user requests to withdraw money from their user accounts.
Account number for the user Pin Number and Amount of money

- This is how a request to withdraw money from an account looks:

```bash
<soapenv:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://localhost/SP/server.php">
   <soapenv:Header/>
   <soapenv:Body>
      <ser:money_withdraw soapenv:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/">
         <details xsi:type="ser:Bookcatalog.Withdraw">
            <!--You may enter the following 3 items in any order-->
            <account_number xsi:type="xsd:int">1</account_number>
            <money_amount xsi:type="xsd:int">200000</money_amount>
            <pin xsi:type="xsd:string">12345</pin>
         </details>
      </ser:money_withdraw>
   </soapenv:Body>
</soapenv:Envelope>
```

- Response Look Like This:

```bash
<SOAP-ENV:Envelope SOAP-ENV:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ns1="http://localhost/SP/server.php" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/">
   <SOAP-ENV:Body>
      <ns1:money_withdrawResponse>
         <return xsi:type="xsd:string">Money Withdraw Finished, Current Account Balance Is : 47000</return>
      </ns1:money_withdrawResponse>
   </SOAP-ENV:Body>
</SOAP-ENV:Envelope>
```

- If User Enter Wrong User Account Number or Pin Number SOAP Server Response Like This:

```bash
<SOAP-ENV:Envelope SOAP-ENV:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ns1="http://localhost/SP/server.php" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/">
   <SOAP-ENV:Body>
      <ns1:money_withdrawResponse>
         <return xsi:type="xsd:string">Wrong Pin Number Please Double Check Pin Number</return>
      </ns1:money_withdrawResponse>
   </SOAP-ENV:Body>
</SOAP-ENV:Envelope>
```

- When user account hasn’t money you requested Server send response like this:

```bash
<SOAP-ENV:Envelope SOAP-ENV:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ns1="http://localhost/SP/server.php" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/">
   <SOAP-ENV:Body>
      <ns1:money_withdrawResponse>
         <return xsi:type="xsd:string">Insufficient Account Balance For Money Withdraw</return>
      </ns1:money_withdrawResponse>
   </SOAP-ENV:Body>
</SOAP-ENV:Envelope>
```

#### Money Transfer 

When transferring money, our server requests four parameters. This variable is Receiver Account Number User Account Number Pin Number Transfer Amount

- Money Transfer Request Look Like This:

```bash
<soapenv:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://localhost/SP/server.php">
   <soapenv:Header/>
   <soapenv:Body>
      <ser:transfer_money soapenv:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/">
         <details xsi:type="ser:Bookcatalog.Transfer">
            <!--You may enter the following 4 items in any order-->
            <account_number xsi:type="xsd:int">1</account_number>
            <money_amount xsi:type="xsd:int">20000</money_amount>
            <pin xsi:type="xsd:string">12345</pin>
            <to xsi:type="xsd:int">4</to>
         </details>
      </ser:transfer_money>
   </soapenv:Body>
</soapenv:Envelope>
```
- Request Look like this:

```bash
<SOAP-ENV:Envelope SOAP-ENV:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ns1="http://localhost/SP/server.php" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/">
   <SOAP-ENV:Body>
      <ns1:transfer_moneyResponse>
         <return xsi:type="xsd:string">Money Transfer To Finished, Current Account Balance Is : 27000</return>
      </ns1:transfer_moneyResponse>
   </SOAP-ENV:Body>
</SOAP-ENV:Envelope>
```

- Before transferring money, the server verifies three logics. The user's account number and pin must be entered correctly, and the revisionist's account number must already exist in the bank. DB. The conclusion is that the account balance cannot be insufficient.
The system's response will appear as follows when the user enters the wrong user account number and pin.

```bash
<SOAP-ENV:Envelope SOAP-ENV:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ns1="http://localhost/SP/server.php" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/">
   <SOAP-ENV:Body>
      <ns1:transfer_moneyResponse>
         <return xsi:type="xsd:string">Wrong Pin Number Please Double Check Pin Number</return>
      </ns1:transfer_moneyResponse>
   </SOAP-ENV:Body>
</SOAP-ENV:Envelope>
```
- If an account has insufficient funds, the system will respond as follows:

```bash
<SOAP-ENV:Envelope SOAP-ENV:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ns1="http://localhost/SP/server.php" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/">
   <SOAP-ENV:Body>
      <ns1:transfer_moneyResponse>
         <return xsi:type="xsd:string">Insufficient Account Balance For Money Transfer</return>
      </ns1:transfer_moneyResponse>
   </SOAP-ENV:Body>
</SOAP-ENV:Envelope>
```

Using the SOAP UI, one may check the server requests and responses.
