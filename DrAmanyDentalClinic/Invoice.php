<?php

    class Invoice
    {
        protected $PatientName;
        protected $Details;
        protected $Money;
    }
    class BaseInvoice extends Invoice
    {
        function __construct($Details, $Money) {
            $this->Details = $Details;
            $this->Money = $Money;
        }
        
        function getPatientName() {
            return $this->PatientName;
        }

        function getDetails() {
            return $this->Details;
        }

        function getMoney() {
            return $this->Money;
        }
    }

    class InvoiceDecorator extends Invoice
    {
        public function __construct(Invoice $invoice_in) {
            $this->invoice = $invoice_in;
            $this->resetDetailsMoney();
        }

        function resetDetailsMoney() {
            $this->Details = $this->invoice->getDetails();
            $this->Money = $this->invoice->getMoney();
        }

        function showDetails() {
            return $this->Details;
        }

        function showMoney() {
            return $this->Money;
        }
    }
    

    class Syringe extends InvoiceDecorator 
    {
        private $invoiceDecorator;
        public function __construct(invoiceDecorator $invoiceDecorator_in) {
            $this->invoiceDecorator = $invoiceDecorator_in;
        }

        function AddSyringe() {
            $this->invoiceDecorator->Money += 10;
            $this->invoiceDecorator->Details .= "Syring Used: 10 <br>";
            echo $this->invoiceDecorator->Details;
            echo "<br>";
            echo "Totla Money: ";
            echo $this->invoiceDecorator->Money;
            echo "<br>";
            
        }
    }

    class Cotton extends invoiceDecorator
    {
        private $invoiceDecorator;
        public function __construct(invoiceDecorator $invoiceDecorator_in) {
            $this->invoiceDecorator = $invoiceDecorator_in;
        }

        function AddCotton(){
            $this->invoiceDecorator->Money += 5;
            $this->invoiceDecorator->Details .= "Cotton Used: 5 <br>";
            echo $this->invoiceDecorator->Details;
            echo "<br>";
            echo "Totla Money: ";
            echo $this->invoiceDecorator->Money;
            echo "<br>";
        }
    }

?>