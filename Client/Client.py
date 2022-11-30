# Author : Jayashanka Deshan Amarasinghe [AA1689]

import requests

# SOAP request URl
url = "http://localhost/SP/server.php?wsdl"


def money_withdrawFunction():

    print("############### Money Withdraw Section ###############\n")

    Account_Number = int(input("\nWhat Is Your Account Number ? : "))

    Money_Amount = int(input("\nMoney Amount ? : "))

    Pin_Number = input("\nWhat Is Your Pin Number ? : ")

    # structured XML
    payload = """<soapenv:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://localhost/SP/server.php">
       <soapenv:Header/>
       <soapenv:Body>
          <ser:money_withdraw soapenv:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/">
             <details xsi:type="ser:Bookcatalog.Withdraw">
                <!--You may enter the following 3 items in any order-->
                <account_number xsi:type="xsd:int">"""+str(Account_Number)+"""</account_number>
                <money_amount xsi:type="xsd:int">"""+str(Money_Amount)+"""</money_amount>
                <pin xsi:type="xsd:string">"""+str(Pin_Number)+"""</pin>
             </details>
          </ser:money_withdraw>
       </soapenv:Body>
    </soapenv:Envelope>"""

    # headers
    headers = {'Content-Type': 'text/xml; charset=utf-8'}

    # POST request
    response = requests.request("POST", url, headers=headers, data=payload)

    # prints the response
    print(response.text)

    test_str = response.text

    extract_outPut(test_str)

    option_function()


def money_deposit():
    print("############### Money Deposit Section ###############\n")

    Account_Number = int(input("\nWhat Is Your Account Number ? : "))

    Money_Amount = int(input("\nMoney Amount ? : "))

    # structured XML
    payload = """<soapenv:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://localhost/SP/server.php">
   <soapenv:Header/>
   <soapenv:Body>
      <ser:deposit_money soapenv:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/">
         <account_number xsi:type="ser:Bookcatalog.Deposit">
            <!--You may enter the following 2 items in any order-->
            <account_number xsi:type="xsd:int">"""+str(Account_Number)+"""</account_number>
            <money_amount xsi:type="xsd:int">"""+str(Money_Amount)+"""</money_amount>
         </account_number>
      </ser:deposit_money>
   </soapenv:Body>
   </soapenv:Envelope>"""

    # headers
    headers = {'Content-Type': 'text/xml; charset=utf-8'}

    # POST request
    response = requests.request("POST", url, headers=headers, data=payload)

    # prints the response
    print(response.text)

    test_str = response.text

    extract_outPut(test_str)

    option_function()


def money_transfer():

    print("############### Money Transfer Section ###############\n")

    Account_Number = int(input("\nWhat Is Your Account Number ? : "))

    Money_Amount = int(input("\nMoney Amount ? : "))

    Pin_Number = input("\nWhat Is Your Pin Number ? : ")

    Receiver_acc_Number = input("\nWhat Is Receiver Account Number ? : ")

    # structured XML
    payload = """<soapenv:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://localhost/SP/server.php">
   <soapenv:Header/>
   <soapenv:Body>
      <ser:transfer_money soapenv:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/">
         <details xsi:type="ser:Bookcatalog.Transfer">
            <!--You may enter the following 4 items in any order-->
            <account_number xsi:type="xsd:int">"""+str(Account_Number)+"""</account_number>
            <money_amount xsi:type="xsd:int">"""+str(Money_Amount)+"""</money_amount>
            <pin xsi:type="xsd:string">"""+str(Pin_Number)+"""</pin>
            <to xsi:type="xsd:int">"""+str(Receiver_acc_Number)+"""</to>
         </details>
      </ser:transfer_money>
   </soapenv:Body>
   </soapenv:Envelope>"""

    # headers
    headers = {'Content-Type': 'text/xml; charset=utf-8'}

    # POST request
    response = requests.request("POST", url, headers=headers, data=payload)

    # prints the response
    print(response.text)

    test_str = response.text

    extract_outPut(test_str)

    option_function()


def extract_outPut(input_data):

    sub1 = '<return xsi:type="xsd:string">'

    sub2 = "</return>"

    idx1 = input_data.find(sub1)

    idx2 = input_data.find(sub2)

    res = input_data[idx1 + len(sub1) + 0: idx2]

    print("Server Says[Envelope Read] : " + res)


def option_function():

    print("WelCome To Smart Transfer\n 1.Deposit Money\n "
          "2.Withdraw Money\n 3.Transfer Money To Another Account\n 4.Exit")

    option = int(input("\nWhat are You Want To Do? : "))

    if (option > 0) & (option < 5):

        if option == 1:
            money_deposit()

        elif option == 2:
            money_withdrawFunction()

        elif option == 3:
            money_transfer()

        else:
            exit(0)
    else:

        print('wrong argument')

        option_function()


option_function()