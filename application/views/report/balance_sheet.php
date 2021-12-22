<style type="text/css">
    .table td, .table th {
    padding: 0.10rem !important;
}
</style>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
               <?php 
               //Met Sa;e
               $fixedAsset=['101001 ','101002','102001','102002','103001'];
               $this->db->select('SUM(journal_amount) AS fixed_asset');
        $this->db->where('journal_amount >', 0);
         $this->db->where_in('acc_number', $fixedAsset);
          $fixed_asset= $this->db->get('account_journal')->row_array();
          // print_r($this->db->last_query()); exit;

          //Investement Properties
    $CurrentAsset=['104001 ','104002','105001'];
               $this->db->select('SUM(journal_amount) AS current_asset');
        $this->db->where('journal_amount >', 0);
         $this->db->where_in('acc_number', $CurrentAsset);
          $current_asset= $this->db->get('account_journal')->row_array(); 



                         //Inventory Assets
               $AccountRecieble=['106001'];
               $this->db->select('SUM(journal_amount) AS acc_recievible');
        $this->db->where('journal_amount >', 0);
         $this->db->where_in('acc_number', $AccountRecieble);
          $acc_recievible= $this->db->get('account_journal')->row_array();

                         //Inventory Assets
               $AccountPayble=['201001'];
               $this->db->select('SUM(journal_amount) AS acc_payable');
        $this->db->where('journal_amount >', 0);
         $this->db->where_in('acc_number', $AccountPayble);
          $acc_payable= $this->db->get('account_journal')->row_array();  

             //Inventory Assets
               $grinPayble=['201002'];
               $this->db->select('SUM(journal_amount) AS grin_payble');
        $this->db->where('journal_amount >', 0);
         $this->db->where_in('acc_number', $grinPayble);
          $grin_payble= $this->db->get('account_journal')->row_array();

             //Inventory Assets
               $bankLoan=['202001'];
               $this->db->select('SUM(journal_amount) AS bank_loan');
        $this->db->where('journal_amount >', 0);
         $this->db->where_in('acc_number', $bankLoan);
          $bank_loan= $this->db->get('account_journal')->row_array();

           //Inventory Assets
               $accuredNum=['203001'];
               $this->db->select('SUM(journal_amount) AS accurd_num');
        $this->db->where('journal_amount >', 0);
         $this->db->where_in('acc_number', $accuredNum);
          $accurd_num= $this->db->get('account_journal')->row_array();


	  //Inventory Assets
               $capital=['301001'];
               $this->db->select('SUM(journal_amount) AS netcapital');
        $this->db->where('journal_amount >', 0);
         $this->db->where_in('acc_number', $capital);
          $netcapital= $this->db->get('account_journal')->row_array();

            //Inventory Assets
               $withdraw=['302001'];
               $this->db->select('SUM(journal_amount) AS Withdrawals');
        $this->db->where('journal_amount >', 0);
         $this->db->where_in('acc_number', $withdraw);
          $Withdrawals= $this->db->get('account_journal')->row_array();


                         //Inventory Assets
               $other_income=['701001','701002'];
               $this->db->select('SUM(journal_amount) AS otherIncome');
        $this->db->where('journal_amount >', 0);
         $this->db->where_in('acc_number', $other_income);
          $otherIncome= $this->db->get('account_journal')->row_array();

           
          // print_r($this->db->last_query()); exit;   

          //Payable Liabilities
               $accCapital=['301001','302001'];
               $this->db->select('SUM(journal_amount) AS capital');
        $this->db->where('journal_amount >', 0);
         $this->db->where_in('acc_number', $accCapital);
          $capital= $this->db->get('account_journal')->row_array();
          // print_r($this->db->last_query()); exit;   
          $netAsset=$acc_recievible['acc_recievible']+$fixed_asset['fixed_asset']+$current_asset['current_asset'];
          $netLiabilities=$acc_payable['acc_payable']+$bank_loan['bank_loan']+$accurd_num['accurd_num']+$grin_payble['grin_payble'];;
          // $yearProfit=$netSale['netSale']+$otherIncome['otherIncome'] - $SaleCost['SaleCost']-$adminExpense['adminExpense'];
                ?> 
                <h2 style="text-align: center;">Balance Sheet</h2>
                        <tr style="background: #F3F4F6 !important; font-weight: bold; font-size: 14px; border-top: 2px solid black;">
                <table class="table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    
                       
                       <tr style="background: #F3F4F6 !important; font-weight: bold; font-size: 18px;">
                            <td>Assets</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="padding-left: 25px !important;">Fixed Assets</td>
                            <td><?= number_format($fixed_asset['fixed_asset'],2);?></td>
                        </tr>
                        <tr>
                            <td style="padding-left: 25px !important;">Current Assets</td>
                            <td><?= number_format($current_asset['current_asset'],2);?></td>
                        </tr>
                        <tr>
                            <td style="padding-left: 25px !important;">Account Receivable </td>
                            <td><?= number_format($acc_recievible['acc_recievible'],2);  ?></td>
                        </tr>
                          <tr style="background: #F3F4F6 !important; font-weight: bold; font-size: 14px;">
                            <td>Total Assets</td>
                            <td><?= number_format($netAsset,2);  ?></td>
                        </tr>
                       <tr style="background: #F3F4F6 !important; font-weight: bold; font-size: 18px;">
                            <td>Liabilities</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="padding-left: 25px !important;"> Account Payable</td>
                            <td><?= number_format($acc_payable['acc_payable'],2);  ?></td>
                        </tr>
                        <tr>
                            <td style="padding-left: 25px !important;"> GRIN Payable</td>
                            <td><?= number_format($grin_payble['grin_payble'],2);  ?></td>
                        </tr>
                         <tr>
                            <td style="padding-left: 25px !important;"> Bank Loans</td>
                            <td><?= number_format($bank_loan['bank_loan'],2);  ?></td>
                        </tr>
                         <tr>
                            <td style="padding-left: 25px !important;"> Accrued Income</td>
                            <td><?= number_format($accurd_num['accurd_num'],2);  ?></td>
                        </tr>
                         <tr style="background: #F3F4F6 !important; font-weight: bold; font-size: 14px;">
                            <td>Total Liabilities</td>
                            <td><?= number_format($netLiabilities,2);  ?></td>
                        </tr>
                        <tr style="background: #F3F4F6 !important; font-weight: bold; font-size: 18px;">
                            <td>Equity</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="padding-left: 25px !important;">Capital</td>
                            <td><?= number_format($netcapital['netcapital'],2);  ?></td>
                        </tr>
                        <tr>
                            <td style="padding-left: 25px !important;">Withdrawals</td>
                            <td><?= number_format($Withdrawals['Withdrawals'],2);  ?></td>
                        </tr>


                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
    <div class="col-md-3"></div>
</div> <!-- end row -->
