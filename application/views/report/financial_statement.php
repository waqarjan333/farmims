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
               //Fiexed Account Assets
               $fixedAssetAccNo=['101001','101002','102001','102002','1003001'];
               $this->db->select('SUM(journal_amount) AS fixedAsset');
        $this->db->where('journal_amount >', 0);
         $this->db->where_in('acc_number', $fixedAssetAccNo);
          $fixedAsset= $this->db->get('account_journal')->row_array();

          //Investement Properties
    $InvestAccNo=['101001','101002'];
               $this->db->select('SUM(journal_amount) AS InvestAsset');
        $this->db->where('journal_amount >', 0);
         $this->db->where_in('acc_number', $InvestAccNo);
          $InvestAsset= $this->db->get('account_journal')->row_array(); 



                         //Inventory Assets
               $inventory_asset=['105001'];
               $this->db->select('SUM(journal_amount) AS inventoryAsset');
        $this->db->where('journal_amount >', 0);
         $this->db->where_in('acc_number', $inventory_asset);
          $inventoryAsset= $this->db->get('account_journal')->row_array();


                         //Inventory Assets
               $tradeRec_asset=['106001'];
               $this->db->select('SUM(journal_amount) AS tradeAsset');
        $this->db->where('journal_amount >', 0);
         $this->db->where_in('acc_number', $tradeRec_asset);
          $tradeAsset= $this->db->get('account_journal')->row_array();

                         //Cash Eqevilent Assets
               $cash_asset=['104001','104002'];
               $this->db->select('SUM(journal_amount) AS cashAsset');
        $this->db->where('journal_amount >', 0);
         $this->db->where_in('acc_number', $cash_asset);
          $cashAsset= $this->db->get('account_journal')->row_array();

          $totalAssets=$inventoryAsset['inventoryAsset']+$tradeAsset['tradeAsset']+$cashAsset['cashAsset'];
          $NetAssets=$totalAssets+$fixedAsset['fixedAsset'];

          //Bank Borrowing Liabilities
               $bank_borrowing=['202001'];
               $this->db->select('SUM(journal_amount) AS bankBorrowing');
        $this->db->where('journal_amount >', 0);
         $this->db->where_in('acc_number', $bank_borrowing);
          $bankBorrowing= $this->db->get('account_journal')->row_array();


          //Payable Liabilities
               $acc_payable=['201001','201002','203001'];
               $this->db->select('SUM(journal_amount) AS accPayble');
        $this->db->where('journal_amount >', 0);
         $this->db->where_in('acc_number', $acc_payable);
          $accPayble= $this->db->get('account_journal')->row_array();

          // print_r($this->db->last_query()); exit;   

          //Payable Liabilities
               $accCapital=['301001','302001'];
               $this->db->select('SUM(journal_amount) AS capital');
        $this->db->where('journal_amount >', 0);
         $this->db->where_in('acc_number', $accCapital);
          $capital= $this->db->get('account_journal')->row_array();

          // print_r($this->db->last_query()); exit;   
                ?> 
                <h2 style="text-align: center;">Financial Statement Position</h2>
                        <tr style="background: #F3F4F6 !important; font-weight: bold; font-size: 14px; border-top: 2px solid black;">
                <table class="table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    
                        <tr style="background: #F3F4F6 !important; font-weight: bold; font-size: 18px;">
                            <td>Assets</td>
                            <td></td>
                        </tr>
                            <td> Non-Current Assets</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="padding-left: 25px !important;">Fixed Assets</td>
                            <td><?= number_format($fixedAsset['fixedAsset'],2);  ?></td>
                        </tr>
                        <tr>
                            <td style="padding-left: 25px !important;">Right of Use of Assets</td>
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td style="padding-left: 25px !important;">Intangible Assets</td>
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td style="padding-left: 25px !important;">Investment properties</td>
                            <td><?= number_format($InvestAsset['InvestAsset'],2);  ?></td>
                        </tr>
                        <tr style="background: #F3F4F6 !important; font-weight: bold; font-size: 14px;">
                            <td>&nbsp;</td>
                            <td><?= number_format($fixedAsset['fixedAsset'],2);  ?></td>
                        </tr>

                        <tr style="background: #F3F4F6 !important; font-weight: bold; font-size: 14px; border-top: 2px solid black;">
                            <td> Current Assets</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="padding-left: 25px !important;"> Inventory</td>
                            <td><?= number_format($inventoryAsset['inventoryAsset'],2);  ?></td>
                        </tr>
                        <tr>
                            <td style="padding-left: 25px !important;"> Trade and other receivables</td>
                            <td><?= number_format($tradeAsset['tradeAsset'],2);  ?></td>
                        </tr>
                        <tr>
                            <td style="padding-left: 25px !important;"> Due from related parties</td>
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td style="padding-left: 25px !important;"> Cash in hand and at bank</td>
                            <td><?= number_format($cashAsset['cashAsset'],2);  ?></td>
                        </tr>
                        <tr style="background: #F3F4F6 !important; font-weight: bold; font-size: 14px;">
                            <td>&nbsp;</td>
                            <td><?= number_format($totalAssets,2);  ?></td>
                        </tr>


                        <tr style="background: #F3F4F6 !important; font-weight: bold; font-size: 14px;">
                            <td>Total Assets</td>
                            <td><?= number_format($NetAssets,2);  ?></td>
                        </tr>
                        
                         <tr style="background: #F3F4F6 !important; font-weight: bold; font-size: 18px;border-top: 2px solid black;">
                            <td>LIABILITIES & SHAREHOLDERS EQUITY</td>
                            <td></td>
                        </tr>
                        <tr style="background: #F3F4F6 !important; font-weight: bold; font-size: 14px; ">
                            <td> Liabilities</td>
                            <td></td>
                        </tr>
                         <tr style="background: #F3F4F6 !important; font-weight: bold; font-size: 14px; ">
                            <td> Current liabilitie</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="padding-left: 25px !important;"> Current portion of bank borrowings</td>
                            <td><?= number_format($bankBorrowing['bankBorrowing'],2);  ?></td>
                        </tr>
                        <tr>
                            <td style="padding-left: 25px !important;"> Current portion of Lease Liabilities</td>
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td style="padding-left: 25px !important;"> Trade and other payables</td>
                            <td><?= number_format($accPayble['accPayble'],2);  ?></td>
                        </tr>
                        <tr>
                            <td style="padding-left: 25px !important;"> Due to related parties</td>
                            <td>0.00</td>
                        </tr>
                        <tr style="background: #F3F4F6 !important; font-weight: bold; font-size: 14px;">
                            <td>&nbsp;</td>
                            <td><?php echo number_format($bankBorrowing['bankBorrowing']+$accPayble['accPayble'],2) ?></td>
                        </tr>


                        <tr style="background: #F3F4F6 !important; font-weight: bold; font-size: 14px;">
                            <td>Total Liabilities</td>
                            <td><?php echo number_format($bankBorrowing['bankBorrowing']+$accPayble['accPayble'],2) ?></td>
                        </tr>
                        <tr style="background: #F3F4F6 !important; font-weight: bold; font-size: 18px;border-top: 2px solid black;">
                            <td> SHAREHOLDERS' EQUITY</td>
                            <td></td>
                            
                        </tr>
                         <tr>
                            <td style="padding-left: 25px !important;"> Capital</td>
                            <td><?= number_format($capital['capital'],2);  ?></td>
                        </tr>
                         <tr>
                            <td style="padding-left: 25px !important;"> Legal Reverse</td>
                            <td>0.00</td>
                        </tr>
                         <tr>
                            <td style="padding-left: 25px !important;"> Revaluation Reserve</td>
                            <td>0.00</td>
                        </tr>
                         <tr>
                            <td style="padding-left: 25px !important;"> Retained Earnings</td>
                            <td>0.00</td>
                        </tr>
                        <tr style="background: #F3F4F6 !important; font-weight: bold; font-size: 14px;">
                            <td>Total Shareholders' Equity</td>
                            <td><?= number_format($capital['capital'],2);  ?></td>
                        </tr>
                          <tr style="background: #F3F4F6 !important; font-weight: bold; font-size: 14px;">
                            <td>Total Liabilities & Shareholders' Equity</td>
                            <td><?= number_format($capital['capital'],2);  ?></td>
                        </tr>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
    <div class="col-md-3"></div>
</div> <!-- end row -->
