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
               $net_sale=['401001 ','401002','401003','401004','401005','401006','402001','403001','404001'];
               $this->db->select('SUM(journal_amount) AS netSale');
        $this->db->where('journal_amount >', 0);
         $this->db->where_in('acc_number', $net_sale);
          $netSale= $this->db->get('account_journal')->row_array();
          // print_r($this->db->last_query()); exit;

          //Investement Properties
    $sale_cost=['501001','502001'];
               $this->db->select('SUM(journal_amount) AS SaleCost');
        $this->db->where('journal_amount >', 0);
         $this->db->where_in('acc_number', $sale_cost);
          $SaleCost= $this->db->get('account_journal')->row_array(); 



                         //Inventory Assets
               $AdministrativeExp=['601001','602001','603001','604001','605001'];
               $this->db->select('SUM(journal_amount) AS adminExpense');
        $this->db->where('journal_amount >', 0);
         $this->db->where_in('acc_number', $AdministrativeExp);
          $adminExpense= $this->db->get('account_journal')->row_array();


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

          $yearProfit=$netSale['netSale']+$otherIncome['otherIncome'] - $SaleCost['SaleCost']-$adminExpense['adminExpense'];
                ?> 
                <h2 style="text-align: center;">Income Statement Report</h2>
                        <tr style="background: #F3F4F6 !important; font-weight: bold; font-size: 14px; border-top: 2px solid black;">
                <table class="table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    
                       
                        <tr>
                            <td style="padding-left: 25px !important;">Sales</td>
                            <td><?= number_format($netSale['netSale'],2);  ?></td>
                        </tr>
                        <tr>
                            <td style="padding-left: 25px !important;">Cost Of Sales</td>
                            <td><?= number_format($SaleCost['SaleCost'],2);?></td>
                        </tr>
                        <tr>
                            <td style="padding-left: 25px !important;">Gross Profit</td>
                            <td><?= number_format($netSale['netSale']-$SaleCost['SaleCost'],2);?></td>
                        </tr>
                        <tr>
                            <td style="padding-left: 25px !important;">General & Administrative Expenses </td>
                            <td><?= number_format($adminExpense['adminExpense'],2);  ?></td>
                        </tr>
                       

                        <tr >
                            <td style="padding-left: 25px !important;"> Provision for bad and doubtful debts</td>
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td style="padding-left: 25px !important;"> Other Income</td>
                            <td><?= number_format($otherIncome['otherIncome'],2);  ?></td>
                        </tr>
                        <tr>
                            <td style="padding-left: 25px !important;"> Finance Cost</td>
                            <td><?= number_format(0,2);  ?></td>
                        </tr>
                        <tr style="background: #F3F4F6 !important; font-weight: bold; font-size: 18px;">
                            <td > Profit Of the Year</td>
                            <td><?php echo number_format($yearProfit,2) ?></td>
                        </tr>
                        <tr>

                            <td style="padding-left: 25px !important;"> Other comprehensinve income</td>
                            <td><?= number_format(0,2);  ?></td>
                        </tr>
                        <tr style="background: #F3F4F6 !important; font-weight: bold; font-size: 18px;">
                            <td > Total Comprehensive income for the year</td>
                            <td>0.00</td>
                        </tr>


                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
    <div class="col-md-3"></div>
</div> <!-- end row -->
